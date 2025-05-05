<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm expand-header">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-item flex-row ml-auto">

            <li class="nav-item align-self-center search-animated">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                    </div>
                </form>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link me-5 ms-5" style="width:24px ;height: 24px;" id="fullscreen-btn" onclick="toggleFullscreen()">
                    <i class="bi bi-arrows-fullscreen text-lg" id="fullscreen-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('theme.toggle') }}" id="theme-toggle-form">
                    @csrf
                    <a href="javascript:;" onclick="document.getElementById('theme-toggle-form').submit();"
                       class="nav-link me-5 ms-5"
                       style="width:24px; height:24px; margin-right: 10px;">
                        @if($theme == 'light')
                            <i class="bi bi-moon text-lg"></i>
                        @else
                            <i class="bi bi-sun text-lg text-white"></i>
                        @endif
                    </a>
                </form>
            </li>
            

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                </a>
                <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">                            
                        <div class="media mx-auto overflow-hidden">
                            @if (auth('admin')->user())
                            <img src="{{ asset('storage/'.auth('admin')->user()->photo) }}" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5 >{{auth('admin')->user()->name}}</h5>
                                <p class="text-muted">{{auth('admin')->user()->email}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('profile.edit') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>الملف الشخصي</span>
                        </a>
                    </div>
                    <div class="dropdown-item text-danger bg-danger border-danger rounded">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span class="text-white">تسجيل الخروج</span>
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </li>

        </ul>

    </header>
</div>