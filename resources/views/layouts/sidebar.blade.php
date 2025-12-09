
<div class="col-lg-2 bg-light shadow-lg">
    <!-- Logo -->
    <div class="text-center py-3 ">
        <a href="#" class="d-inline-flex align-items-center text-decoration-none">
            <img src="img/HOMEpng.png" alt="Logo" class="img-fluid" style="max-width: 250px;">
        </a>
    </div>

    <!-- Divider -->
    <!-- <hr class="m-0"> -->

    <!-- Navigation -->
    <aside class="bg-white shadow-lg rounded-4"  id="menuContainer" style="min-height: 70vh;">
        <nav class="nav flex-column py-4 px-1" style="font-size: 16px;">

            <!-- Botón móvil -->
            <div class="d-flex justify-content-center d-lg-none mb-4">
                <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#responsiveMenu" aria-expanded="false" aria-controls="responsiveMenu">
                    <i class="fa-solid fa-bars fa-lg text-white"></i>
                </button>
            </div>

            <!-- Menú -->
            <div class="collapse d-lg-block" id="responsiveMenu">

                <!-- Inicio -->
                <li class="nav-item mb-3">
                    <a href="/dashboard" class="nav-link d-flex align-items-center ">
                        <i class="fa-solid fa-chart-line me-2 text-warning"></i>
                        <span>Inicio</span>
                    </a>
                </li>

                <!-- Propietarios -->
                <li class="nav-item mb-3">
                    <a href="/propietarios" class="nav-link d-flex align-items-center ">
                        <i class="fa-solid fa-user-tie me-2 text-warning"></i>
                        <span>Propietarios</span>
                    </a>
                </li>

                <!-- Adm. de Propiedades -->
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center " data-bs-toggle="collapse" href="#propiedades" role="button" aria-expanded="false" aria-controls="propiedades">
                        <span><i class="fa-solid fa-building me-2 text-warning"></i> Adm. de Propiedades</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse rounded" id="propiedades">
                        <ul class="nav flex-column ms-3 mt-2 " >
                            <li class="nav-item">
                                <a href="/propiedades" class="nav-link"><i class="fa-solid fa-building me-2 text-warning"></i> Pro. Marzo a Dic.</a>
                            </li>
                            <li class="nav-item">
                                <a href="/proanocorrido" class="nav-link "><i class="fa-solid fa-building me-2 text-warning"></i> Pro. Año Corrido</a>
                            </li>
                            <li class="nav-item">
                                <a href="/propiedadesVenta" class="nav-link "><i class="fa-solid fa-building me-2 text-warning"></i> Pro. en Venta</a>
                            </li>
                            <li class="nav-item">
                                <a href="/verano" class="nav-link "><i class="fa-solid fa-sun me-2 text-warning"></i> Pro. de Verano</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Gestión de Arriendos -->
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center " data-bs-toggle="collapse" href="#arriendos" role="button" aria-expanded="false" aria-controls="arriendos">
                        <span><i class="fa-solid fa-key me-2 text-warning"></i> Gestión de Arriendos</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse" id="arriendos">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="/arriendos" class="nav-link "><i class="fa-solid fa-key me-2 text-warning"></i> Arriendos</a></li>
                            <li class="nav-item"><a href="/elementos" class="nav-link "><i class="fa-solid fa-boxes me-2 text-warning"></i> Elementos</a></li>
                            <li class="nav-item"><a href="/comision" class="nav-link "><i class="fa-solid fa-percent me-2 text-warning"></i> Comisión</a></li>
                            <li class="nav-item"><a href="/pagos" class="nav-link "><i class="fa-solid fa-money-bill-wave me-2 text-warning"></i> Pagos</a></li>
                            <li class="nav-item"><a href="/contratos" class="nav-link "><i class="fa-solid fa-file-contract me-2 text-warning"></i> Contratos</a></li>
                            <li class="nav-item"><a href="/servicios" class="nav-link "><i class="fa-solid fa-truck me-2 text-warning"></i> Servicios</a></li>
                            <li class="nav-item"><a href="/inventario" class="nav-link "><i class="fa-solid fa-cart-flatbed me-2 text-warning"></i> Inventario</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Administración de Usuarios -->
                <li class="nav-item mb-4">
                    <a class="nav-link d-flex justify-content-between align-items-center " data-bs-toggle="collapse" href="#usuarios" role="button" aria-expanded="false" aria-controls="usuarios">
                        <span><i class="fa-solid fa-briefcase me-2 text-warning"></i> Adm. de Usuarios</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse" id="usuarios">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="/cargos" class="nav-link "><i class="fa-solid fa-briefcase me-2 text-warning"></i> Cargos</a></li>
                            <li class="nav-item"><a href="/usuarios" class="nav-link "><i class="fa-solid fa-user me-2 text-warning"></i> Usuarios</a></li>
                            <li class="nav-item"><a href="/sueldos" class="nav-link "><i class="fa-solid fa-user me-2 text-warning"></i> Sueldos de Usuarios</a></li>
                        </ul>
                    </div>
                </li>

                
            </div>
        </nav>
    </aside>
    <!-- Cerrar Sesión -->
    <div class="mt-3">
        <a class="btn btn-danger rounded-pill w-100 text-white d-flex align-items-center justify-content-center" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> {{ __('Cerrar Sesión') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</div>
     
<style>
    #menuContainer {
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: thin; /* Firefox */
    }

    /* Opcional: Scroll personalizado para WebKit (Chrome, Edge, Safari) */
    #menuContainer::-webkit-scrollbar {
        width: 6px;
    }
    #menuContainer::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }
    .nav-link:hover {
        background-color: #E67E22; /* Gris claro */
        color:rgb(255, 255, 255) !important; /* Naranja (como tu ícono) */
        border-radius: 0.375rem; /* Opcional: bordes redondeados */
        transition: background-color 0.3s ease, color 0.3s ease;
    }


    .nav-link:hover i {
        color:rgb(255, 255, 255) !important; /* Cambia también el color del ícono */
    }
    .nav-link{
        color:rgb(0, 0, 0) !important; /* Cambia también el color del ícono */
    }
    .nav-link:hover span {
        color:rgb(255, 255, 255) !important; /* Cambia también el color del ícono */
    }
  
</style>

<!-- <style>
    .menu-link {
        transition: background-color 0.3s, color 0.3s;
    }

    .menu-link:hover {
        background-color: #e9ecef;
        color: #000;
    }

    .submenu-link {
        transition: background-color 0.3s, color 0.3s;
    }

    .submenu-link:hover {
        background-color: #e9ecef;
        color: #000;
    }
</style> -->

