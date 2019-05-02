<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a class="nav-link active" href="#"><i class="fas fa-tachometer-alt"></i> Escritorio</a>
            </li>
            <li class="nav-title">
                Mantenimiento
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-address-book"></i> Gestión de Clientes</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user-tag"></i> Clientes</a>
                    </li>
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-map-marked"></i> Direcciones</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-cogs"></i> Gestión de Vehiculos</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-car-side"></i> Vehiculos</a>
                    </li>
                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="fab fa-buffer"></i> Ordenes</a>
                    </li>
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar"></i> Cotizaciones</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-store"></i> Artículos</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=6" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-boxes"></i> Stock</a>
                    </li>
                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-basket"></i> Compras</a>
                    </li>
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-tags"></i> Precios</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-chart-pie"></i> Reportes</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=9" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-chart-bar"></i> Reporte Ordenes</a>
                    </li>
                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-chart-area"></i> Reporte Ventas</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-user-check"></i> Acceso</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-users"></i> Usuarios</a>
                    </li>
                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-users-cog"></i> Roles</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-life-ring"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> Acerca de...<span class="badge badge-info">IT</span></a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
