<?php 

namespace App\Http\Controllers;

use App\Mail\MantencionEmail;
// El mailableuse App\Mail\EliminarReservaMarkdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class CorreosController extends Controller
{
    public function enviarCorreoPrueba()   
     {        
        $correo = new MantencionEmail();
         // Crea una instancia del Mailable        
         Mail::to('luisvidalcontreras2003@gmail.com')->send($correo);        
         return "Correo enviado correctamente a luisvidalcontreras2003@gmail.com";    
    }

}