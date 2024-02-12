<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/home">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>
                {{-- Profile --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Profile
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/categories">Categories</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Buy Premium</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Features</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Budgets
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/b">Daily budget</a>
                        <a class="nav-link" href="/g/b">Group Budget</a>
                    </nav>
                </div>

                <!--Transactions -->
                <a class="nav-link" href="/t">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Transactions
                </a>
                <!--Payment -->
                <a class="nav-link" href="/p">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-check-dollar"></i></div>
                    Payments
                </a> <!--About Page -->
                <a class="nav-link" href="/a">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info"></i></div>
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

{{--






  --}}
