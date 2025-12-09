<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mantenimiento;
use App\Models\Arriendo;
use App\Models\Elementos;
use App\Mail\MantencionEmail;
use App\Mail\ArriendoEmail;
use App\Mail\EntregaEmail;
use App\Mail\ElementoEmail;
use App\Mail\ReajusteEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RevisarFechasEnvio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mantenciones:revisar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa las fechas de envío de las mantenciones y envía los correos si corresponde';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->handleMantenciones(); // Renombrado para claridad
        $this->handleArriendo(); 
        $this->handleEntrega();     
        $this->elementos();     
        $this->reajusteipc();     

    }


    public function handleMantenciones()
    {
        // Obtener todas las mantenciones junto con los detalles de las propiedades
        $mantenciones = Mantenimiento::with('propiedad')->get();
    
        foreach ($mantenciones as $mante) {
            $fechaEnvioCorreo = Carbon::parse($mante->envio_correo); // Ajusta según el nombre del campo en tu modelo
            $hoy = Carbon::now();

    
            // Verificar si la fecha de envío de correo es igual a la fecha actual
            if ($hoy->isSameDay($fechaEnvioCorreo)) {
                // Obtener detalles de la propiedad
                $propiedad = $mante->propiedad;

                // Crear el correo con los detalles de la propiedad
                $email = new MantencionEmail(
                    $mante->nombre,
                    $mante->descripcion,
                    $mante->fecha_mantencion,
                    $mante->meses,
                    $mante->fecha_prox_man,
                    $propiedad->condominio ?? 'Sin Condominio',
                    $propiedad->direccion ?? 'Sin Direccion',
                    $propiedad->torre ?? 'Sin Torre',
                    $propiedad->num_torre ?? 'Sin Numero de torre',
                    $propiedad->tipo_vivienda ?? 'Sin Vivienda',
                    $propiedad->ciudad ?? 'Sin Ciudad'
                );

                // Enviar el correo
                Mail::to('homeinmoviliariamails@gmail.com')->send($email);

                // Mensaje de confirmación
                // $this->info("Correo enviado exitosamente para la mantención: {$mante->nombre}");
            }
        }
    }
    
    public function handleArriendo()
    {
        // Obtener todos los registros de Arriendo con el estado de pago 2
        $arriendopago = Arriendo::with('propiedad')->where('id_estadopagos', 2)->get();
    
        foreach ($arriendopago as $pago) {
    
            // Obtener la fecha de pago y sumarle un día
            $fechaEnvioCorreo = Carbon::parse($pago->fecha_pago)->addDay();
            $hoy = Carbon::now();
            $propiedad = $pago->propiedad;
    
            // Calcular los días de atraso
            $diasAtraso = $hoy->diffInDays(Carbon::parse($pago->fecha_pago)); // `false` para considerar atrasos negativos
    
            // Verificar si la fecha actual es igual o posterior a la fecha de envío
            if ($hoy->isSameDay($fechaEnvioCorreo)) {
                // Crear el correo con los detalles del arriendo y días de atraso
                $email = new ArriendoEmail(
                    $pago->valor_real,
                    $pago->fecha_pago,
                    $propiedad->condominio ?? 'Sin Condominio',
                    $propiedad->direccion ?? 'Sin Dirección',
                    $propiedad->torre ?? 'Sin Torre',
                    $propiedad->num_torre ?? 'Sin Número de Torre',
                    $propiedad->tipo_vivienda ?? 'Sin Vivienda',
                    $propiedad->ciudad ?? 'Sin Ciudad',
                    $diasAtraso // Asegurarse de no incluir días negativos
                );
    
                // Enviar el correo y manejar errores
                Mail::to($pago->arrendatario->correo)->send($email);
            }
        }
    }
    

    public function handleEntrega(){
        // Obtener todos los registros de Arriendo con su relación propiedad
        $arriendos = Arriendo::with('propiedad')->get();
        
        foreach ($arriendos as $arriendo) {
            // Obtener la fecha de entrega y restarle dos días
            $fechaEnvioCorreo = Carbon::parse($arriendo->fecha_entrega)->subDays(2);
            $hoy = Carbon::now();

            // Verificar si la fecha actual es igual a la fecha de envío
            if ($hoy->isSameDay($fechaEnvioCorreo)) {
                // Asegurarte de que la relación propiedad está cargada
                $propiedad = $arriendo->propiedad;

                // Crear el correo con los detalles del arriendo
                $email = new EntregaEmail(
                    $arriendo->fecha_entrega,
                    $propiedad->condominio ?? 'Sin Condominio', // Verifica si condominio existe
                    $propiedad->direccion ?? 'Sin Direccion',
                    $propiedad->torre ?? 'Sin Torre',
                    $propiedad->num_torre ?? 'Sin Numero de torre',
                    $propiedad->tipo_vivienda ?? 'Sin Vivienda',
                    $propiedad->ciudad ?? 'Sin Ciudad'
                );

                // Enviar el correo
                Mail::to($arriendo->arrendatario->correo)->send($email);
            }
        }
    }

    public function elementos()
    {
        // Obtener todos los registros de Elementos
        $elementos = Elementos::all();
    
        foreach ($elementos as $elemento) {
            // Calcular la fecha de un mes antes de que se cumpla un año del created_at
            $fechaEnvioCorreo = Carbon::parse($elemento->created_at)->addYear()->subMonth();
            // Calcular la fecha con un año más desde su creación
            $fechaConUnAnoMas = Carbon::parse($elemento->created_at)->addYear();
            $hoy = Carbon::now();
            
            // Formatear las fechas (sin horas)
            $fechaConUnAnoMasFormateada = $fechaConUnAnoMas->format('Y-m-d');
            $createdAtFormateada = Carbon::parse($elemento->created_at)->format('Y-m-d');
    
            // Verificar si el día y mes de la fecha actual coinciden con la fecha de envío
            if ($hoy->isSameDay($fechaEnvioCorreo)) {
                // Crear el correo con los detalles del elemento
                $email = new ElementoEmail(
                    $elemento->nombre ?? 'Sin Nombre', // Verifica si nombre existe
                    $createdAtFormateada,
                    $fechaConUnAnoMas
                );
    
                // Enviar el correo
                Mail::to('homeinmoviliariamails@gmail.com')->send($email);
            }
        }
    }

    public function reajusteipc()
    {
        // Obtener todos los registros de Elementos
        $Reajuste = Arriendo::all();
    
        foreach ($Reajuste as $Reajusteipc) {
            // Calcular la fecha de dos meses antes de que se cumpla un año del inicio del arriendo
            $fechaEnvioCorreo = Carbon::parse($Reajusteipc->fecha_entrega)->addYear()->subMonths(2);
            // Calcular la fecha con un año más desde el inicio del arriendo
            $fechaConUnAnoMas = Carbon::parse($Reajusteipc->fecha_entrega)->addYear();
            $hoy = Carbon::now();
    
            // Formatear las fechas (sin horas)
            $fechaConUnAnoMasFormateada = $fechaConUnAnoMas->format('Y-m-d');
            $inicioArriendoFormateada = Carbon::parse($Reajusteipc->fecha_entrega)->format('Y-m-d');
    
            // Verificar si el día y mes de la fecha actual coinciden con la fecha de envío
            if ($hoy->isSameDay($fechaEnvioCorreo)) {
                // Crear el correo con los detalles del elemento
                $email = new ReajusteEmail(
                    $inicioArriendoFormateada,
                    $fechaConUnAnoMasFormateada
                );
    
                // Enviar el correo
                Mail::to($Reajusteipc->arrendatario->correo)->send($email);
            }
        }
    }
    
    
    
}
