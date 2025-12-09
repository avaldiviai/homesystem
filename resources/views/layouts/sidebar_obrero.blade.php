
<div class="col-lg-2 bg-light shadow-lg">
    <!-- Logo -->
    <div class="text-center py-3 ">
        <a href="#" class="d-inline-flex align-items-center text-decoration-none">
            <img src="{{ asset('img/HOMEpng.png') }}" alt="Logo" class="img-fluid" style="max-width: 250px;">
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
                <!-- Adm. de Propiedades -->
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#propiedades" role="button" aria-expanded="true" aria-controls="propiedades">
                        <span><i class="fa-solid fa-building me-2 text-warning"></i> Adm. de Propiedades</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse rounded show" id="propiedades">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item">
                                <a href="/obrero/propiedades" class="nav-link"><i class="fa-solid fa-building me-2 text-warning"></i> Pro. Marzo a Dic.</a>
                            </li>
                            <li class="nav-item">
                                <a href="/obrero/proanocorrido" class="nav-link"><i class="fa-solid fa-building me-2 text-warning"></i> Pro. Año Corrido</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a href="/obrero/servicios" class="nav-link "><i class="fa-solid fa-truck me-2 text-warning"></i> Servicios</a></li>
                <li class="nav-item"><a href="/obrero/inventario" class="nav-link "><i class="fa-solid fa-cart-flatbed me-2 text-warning"></i> Inventario</a></li>
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

