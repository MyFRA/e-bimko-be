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
                <li class="{{ str_contains(Request::url(), '/panel/articles') || str_contains(Request::url(), '/panel/article-categories') ? 'active' : '' }}">
                    <a href="#article-dropdown" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
                        <span class="ripple rippleEffect" style="width: 230px; height: 230px; top: -94px; left: 18px;"></span>
                        <i class="las la-newspaper iq-arrow-left"></i>
                        <span>Artikel</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                    </a>
                    <ul id="article-dropdown" class="iq-submenu collapse {{ str_contains(Request::url(), '/panel/articles') || str_contains(Request::url(), '/panel/article-categories') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle" style="">
                        <li class="{{ str_contains(Request::url(), '/panel/article-categories') ? 'active' : '' }}"><a href="/panel/article-categories"><i class="las la-digital-tachograph"></i>Kategori</a></li>
                        <li class="{{ str_contains(Request::url(), '/panel/articles') ? 'active' : '' }}"><a href="/panel/articles"><i class="las la-newspaper"></i>Artikel</a></li>
                    </ul>
                </li>
                <li class="{{ str_contains(Request::url(), '/panel/teachers') ? 'active' : '' }}">
                    <a href="/panel/teachers" class="iq-waves-effect">
                        <span class="ripple rippleEffect"></span>
                        <i class="las la-chalkboard-teacher iq-arrow-left"></i>
                        <span>Guru</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
