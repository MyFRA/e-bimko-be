<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-menu-line"></i></div>
                    <div class="hover-circle"><i class="ri-close-fill"></i></div>
                </div>
                <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                    <a href="index.html" class="header-logo">
                        <img src="/assets/images/logo.png" class="img-fluid rounded" alt="">
                        <span>FinDash</span>
                    </a>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item nav-icon dropdown">
                        <a href="/panel/dashboard" class="search-toggle iq-waves-effect bg-primary rounded">
                            <i class="las la-home"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-list">
                <li class="line-height">
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <img src="/assets/images/no-profile.webp" class="img-fluid rounded mr-3" alt="user">
                        <div class="caption">
                            <h6 class="mb-0 line-height">{{ Auth::user()->name }}</h6>
                            <p class="mb-0">Administrator</p>
                        </div>
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Halo {{ Auth::user()->name }}</h5>
                                </div>
                                <form method="POST" action="/panel/auth/logout" class="d-inline-block w-100 text-center p-3">
                                    @csrf
                                    <button class="bg-primary iq-sign-btn" role="button" type="submit">Sign out<i class="ri-login-box-line ml-2"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- TOP Nav Bar END -->
