<div class="col-lg-2 bg-light shadow-lg pla-sidebar-col" style="padding:0;">
    <!-- Logo -->
    <div class="text-center py-3">
        <a href="#" class="d-inline-flex align-items-center text-decoration-none">
            <img src="{{ asset('img/HOMEpng.png') }}" alt="Logo" class="img-fluid" style="max-width: 250px;">
        </a>
    </div>

    <!-- Navigation -->
    <aside class="bg-white shadow-lg rounded-4" id="menuContainer">
        <nav class="nav flex-column py-4 px-1" style="font-size: 16px;">

            <!-- Botón móvil -->
            <div class="d-flex justify-content-center d-lg-none mb-4">
                <button class="btn btn-warning" type="button" data-bs-toggle="collapse"
                        data-bs-target="#responsiveMenu" aria-expanded="false" aria-controls="responsiveMenu">
                    Menú
                </button>
            </div>

            <!-- Menú -->
            <div class="collapse d-lg-block" id="responsiveMenu">

                <li class="nav-item mb-3">
                    <a href="/plantilla" class="nav-link d-flex align-items-center">
                        <span>Plantilla de Empresa</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a href="/propietarios" class="nav-link d-flex align-items-center">
                        <span>Propietarios</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center"
                       data-bs-toggle="collapse" href="#propiedades" role="button"
                       aria-expanded="false" aria-controls="propiedades">
                        <span>Propiedades Disponibles</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse rounded" id="propiedades">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item">
                                <a href="/propiedades" class="nav-link">Pro. Marzo a Dic.</a>
                            </li>
                            <li class="nav-item">
                                <a href="/proanocorrido" class="nav-link">Pro. Año Corrido</a>
                            </li>
                            <li class="nav-item">
                                <a href="/propiedadesVenta" class="nav-link">Pro. en Venta</a>
                            </li>
                            <li class="nav-item">
                                <a href="/verano" class="nav-link">Pro. de Verano</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-3">
                    <a href="/graficos" class="nav-link d-flex align-items-center">
                        <span>Gráficos de Empresa</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center"
                       data-bs-toggle="collapse" href="#arriendos" role="button"
                       aria-expanded="false" aria-controls="arriendos">
                        <span>Arriendo Temporal</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse" id="arriendos">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="/arriendos" class="nav-link">Arriendos</a></li>
                            <li class="nav-item"><a href="/elementos" class="nav-link">Elementos</a></li>
                            <li class="nav-item"><a href="/comision" class="nav-link">Comisión</a></li>
                            <li class="nav-item"><a href="/pagos" class="nav-link">Pagos</a></li>
                            <li class="nav-item"><a href="/contratos" class="nav-link">Contratos</a></li>
                            <li class="nav-item"><a href="/inventario" class="nav-link">Inventario</a></li>
                        </ul>
                    </div>
                </li>

                <!-- ── RRHH ── -->
                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center"
                       data-bs-toggle="collapse" href="#rrhh" role="button"
                       aria-expanded="{{ request()->is('rrhh/*') ? 'true' : 'false' }}"
                       aria-controls="rrhh">
                        <span>RRHH</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse {{ request()->is('rrhh/*') ? 'show' : '' }}" id="rrhh">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item">
                                <a href="/rrhh/equipo" class="nav-link {{ request()->is('rrhh/equipo') ? 'active-link' : '' }}">
                                    Equipo de trabajo
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </div>
        </nav>
    </aside>

    <!-- Cerrar Sesión -->
    <div class="mt-3 px-2 pb-3">
        <a class="btn btn-danger rounded-pill w-100 text-white d-flex align-items-center justify-content-center"
           href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Cerrar Sesión') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</div>

<style>
/* ─── SIDEBAR STICKY ─────────────────────────────────────────────────── */
.pla-sidebar-col {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    flex-shrink: 0;
    scrollbar-width: thin;
    scrollbar-color: rgba(0,0,0,.15) transparent;
}
.pla-sidebar-col::-webkit-scrollbar { width: 4px; }
.pla-sidebar-col::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,.15);
    border-radius: 4px;
}

#menuContainer {
    max-height: none;
    overflow-y: visible;
}

/* ─── Hover y activo ─────────────────────────────────────────────────── */
.nav-link {
    color: rgb(0,0,0) !important;
}
.nav-link:hover {
    background-color: #E67E22;
    color: rgb(255,255,255) !important;
    border-radius: 0.375rem;
    transition: background-color .3s ease, color .3s ease;
}
.nav-link:hover i,
.nav-link:hover span {
    color: rgb(255,255,255) !important;
}
/* Link activo (página actual) */
.nav-link.active-link {
    background-color: #E67E22;
    color: #fff !important;
    border-radius: 0.375rem;
    font-weight: 700;
}
.nav-link.active-link i {
    color: #fff !important;
}
</style>