<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Features</div>
                <!-- Budgets -->
                <a class="nav-link" href="/set/budget">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-chart-area"></i>
                    </div>
                    Budgets
                </a>
                <!--Transactions -->
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Transactions
                </a>
                <!--Transactions -->
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    About App
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
