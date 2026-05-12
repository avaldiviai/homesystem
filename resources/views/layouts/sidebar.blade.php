<div class="col-lg-2 bg-light shadow-lg pla-sidebar-col" style="padding:0;">
    <!-- Logo -->
    <div class="text-center py-3">
        <a href="#" class="d-inline-flex align-items-center text-decoration-none">
            <img src="img/HOMEpng.png" alt="Logo" class="img-fluid" style="max-width: 250px;">
        </a>
    </div>

    <!-- Navigation -->
    <aside class="bg-white shadow-lg rounded-4" id="menuContainer">
        <nav class="nav flex-column py-4 px-1" style="font-size: 16px;">

            <!-- Botón móvil -->
            <div class="d-flex justify-content-center d-lg-none mb-4">
                <button class="btn btn-warning" type="button" data-bs-toggle="collapse"
                        data-bs-target="#responsiveMenu" aria-expanded="false" aria-controls="responsiveMenu">
                    <i class="fa-solid fa-bars fa-lg text-white"></i>
                </button>
            </div>

            <!-- Menú -->
            <div class="collapse d-lg-block" id="responsiveMenu">

                <!-- Inicio -->
                <li class="nav-item mb-3">
                    <a href="/dashboard" class="nav-link d-flex align-items-center">
                        <i class="fa-solid fa-chart-line me-2 text-warning"></i>
                        <span>Inicio</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a href="/plantilla" class="nav-link d-flex align-items-center">
                        <i class="fa-solid fa-file-lines me-2 text-warning"></i>
                        <span>Plantilla de Empresa</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a href="/propietarios" class="nav-link d-flex align-items-center">
                        <i class="fa-solid fa-user-tie me-2 text-warning"></i>
                        <span>Propietarios</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center"
                       data-bs-toggle="collapse" href="#propiedades" role="button"
                       aria-expanded="false" aria-controls="propiedades">
                        <span><i class="fa-solid fa-building me-2 text-warning"></i> Propiedades Disponibles</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse rounded" id="propiedades">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item">
                                <a href="/propiedades" class="nav-link">
                                    <i class="fa-solid fa-building me-2 text-warning"></i> Pro. Marzo a Dic.
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/proanocorrido" class="nav-link">
                                    <i class="fa-solid fa-building me-2 text-warning"></i> Pro. Año Corrido
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/propiedadesVenta" class="nav-link">
                                    <i class="fa-solid fa-building me-2 text-warning"></i> Pro. en Venta
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/verano" class="nav-link">
                                    <i class="fa-solid fa-sun me-2 text-warning"></i> Pro. de Verano
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-3">
                    <a href="/graficos" class="nav-link d-flex align-items-center">
                        <i class="fa-solid fa-chart-line me-2 text-warning"></i>
                        <span>Gráficos de Empresa</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center"
                       data-bs-toggle="collapse" href="#arriendos" role="button"
                       aria-expanded="false" aria-controls="arriendos">
                        <span><i class="fa-solid fa-key me-2 text-warning"></i> Arriendo Temporal</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse" id="arriendos">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="/arriendos" class="nav-link"><i class="fa-solid fa-key me-2 text-warning"></i> Arriendos</a></li>
                            <li class="nav-item"><a href="/elementos" class="nav-link"><i class="fa-solid fa-boxes me-2 text-warning"></i> Elementos</a></li>
                            <li class="nav-item"><a href="/comision" class="nav-link"><i class="fa-solid fa-percent me-2 text-warning"></i> Comisión</a></li>
                            <li class="nav-item"><a href="/pagos" class="nav-link"><i class="fa-solid fa-money-bill-wave me-2 text-warning"></i> Pagos</a></li>
                            <li class="nav-item"><a href="/contratos" class="nav-link"><i class="fa-solid fa-file-contract me-2 text-warning"></i> Contratos</a></li>
                            <li class="nav-item"><a href="/inventario" class="nav-link"><i class="fa-solid fa-cart-flatbed me-2 text-warning"></i> Inventario</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link d-flex justify-content-between align-items-center"
                       data-bs-toggle="collapse" href="#rrhh" role="button"
                       aria-expanded="false" aria-controls="rrhh">
                        <span><i class="fa-solid fa-users-gear me-2 text-warning"></i> RRHH</span>
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </a>
                    <div class="collapse" id="rrhh">
                        <ul class="nav flex-column ms-3 mt-2">
                            <li class="nav-item"><a href="/cargos" class="nav-link"><i class="fa-solid fa-briefcase me-2 text-warning"></i> Cargos</a></li>
                            <li class="nav-item"><a href="/usuarios" class="nav-link"><i class="fa-solid fa-user me-2 text-warning"></i> Usuarios</a></li>
                            <li class="nav-item"><a href="/sueldos" class="nav-link"><i class="fa-solid fa-money-check-dollar me-2 text-warning"></i> Sueldos de Usuarios</a></li>
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
            <i class="fas fa-sign-out-alt me-2"></i> {{ __('Cerrar Sesión') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</div>

<style>
/* ─── SIDEBAR STICKY ─────────────────────────────────────────────────── */
/*
 * La clave: el padre .row NO debe tener overflow-auto ni overflow-hidden.
 * El scroll lo hace únicamente la columna del contenido principal (.pla-main-col).
 * Esta columna del sidebar usa position:sticky + height:100vh para quedarse fija.
 */
.pla-sidebar-col {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    flex-shrink: 0;
    /* Scroll interno suave para el menú si es largo */
    scrollbar-width: thin;
    scrollbar-color: rgba(0,0,0,.15) transparent;
}
.pla-sidebar-col::-webkit-scrollbar { width: 4px; }
.pla-sidebar-col::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,.15);
    border-radius: 4px;
}

/* #menuContainer ya no necesita max-height fijo — el sidebar entero scrollea */
#menuContainer {
    max-height: none;
    overflow-y: visible;
}

/* ─── Hover de links ─────────────────────────────────────────────────── */
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
</style>