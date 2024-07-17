<div class="iq-sidebar">
    <div class="iq-navbar-logo d-flex justify-content-between">
        <a href="index.html" class="header-logo">
            <img src="/assets/images/logo.png" class="img-fluid rounded" alt="">
            <span>E-Bimko</span>
        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-menu-line"></i></div>
                <div class="hover-circle"><i class="ri-close-fill"></i></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ Request::is('panel/dashboard') ? 'active' : '' }}">
                    <a href="/panel/dashboard" class="iq-waves-effect">
                        <span class="ripple rippleEffect"></span>
                        <i class="las la-home iq-arrow-left"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ str_contains(Request::url(), '/panel/diagnostics') ? 'active' : '' }}">
                    <a href="/panel/diagnostics" class="iq-waves-effect">
                        <span class="ripple rippleEffect"></span>
                        <i class="las la-pen-alt iq-arrow-left"></i>
                        <span>Diagnostik</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
