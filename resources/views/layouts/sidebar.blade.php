<div class="sidebar-wrapper sidebar-theme">

    <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>

    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('Main') }}">
                    <img src="{{ asset('assets/img/tim.png') }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="#" class="nav-link"> تـكـافـل </a>
            </li>
        </ul>

        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu {{ request()->routeIs('Main') ? 'active' : '' }}">
                <a href="{{ route('Main') }}"
                    {{ request()->routeIs('Main') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle" wire:navigate>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span> الصفحة الرئيسية</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span>مستخدمي النظام</span>
                </div>
            </li>

            <li>
                <a href="#"  aria-expanded="true" class="d-hidden"></a>
            </li>

            <li class="menu {{ request()->routeIs('users') ? 'active' : '' }}">
                <a href="{{ route('users') }}" wire:navigate
                    {{ request()->routeIs('users') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>مشرفي النظام</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('org') ? 'active' : '' }}">
                <a href="{{ route('org') }}" wire:navigate 
                    {{ request()->routeIs('org') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7"></path>
                            <path d="M9 22V12h6v10"></path>
                        </svg>
                        <span>المؤسسات الخيرية</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('donors') ? 'active' : '' }}">
                <a href="{{ route('donors') }}" wire:navigate
                    {{ request()->routeIs('donors') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>المتبرعين</span>
                    </div>
                </a>
            </li>


            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span>عمليات المنظمة</span>
                </div>
            </li>


            <li class="menu {{ request()->routeIs('donations') ? 'active' : '' }}">
                <a href="{{ route('donations') }}" wire:navigate data-toggle="collapse"
                    {{ request()->routeIs('donations') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>التبرعات</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="#submenu" data-toggle="collapse" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-user-plus">
                            <path d="M16 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M7 21v-2a4 4 0 0 1 3-3.87"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <line x1="19" y1="8" x2="19" y2="14"></line>
                            <line x1="16" y1="11" x2="22" y2="11"></line>
                        </svg>
                        <span>الحالات الخيرية</span>
                    </div>
                    
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="submenu" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('cases-request')}}" wire:navigate> الطلبات المعلقة </a>
                    </li>
                    <li>
                        <a href="{{route('refined-case')}}" wire:navigate> الطلبات المرفوضة</a>
                    </li>
                    <li>
                        <a href="{{route('accepted_case')}}" wire:navigate> الحالات المقبولة </a>
                    </li>
                    <li>
                        <a href="{{route('accepted-case-card')}}" wire:navigate> الحالات المفعلة </a>
                    </li>
                    <li>
                        <a href="{{route('completed_case')}}" wire:navigate> الحالات المكتملة </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#projects-submenu" data-toggle="collapse" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-package">
                            <path d="M16.5 9.4L7.5 4.21"></path>
                            <path d="M21 16V8a2 2 0 0 0-1-1.73L13 2.27a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z"></path>
                            <path d="M3.27 6.96L12 12.01l8.73-5.05"></path>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span>مشاريع المنظمات</span>
                    </div>
                    
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="projects-submenu" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('projects-request')}}" wire:navigate> الطلبات المعلقة </a>
                    </li>
                    <li>
                        <a href="{{route('refined-project')}}" wire:navigate> الطلبات المرفوضة</a>
                    </li>
                    <li>
                        <a href="{{route('accepted-project')}}" wire:navigate> المشاريع المقبولة </a>
                    </li>
                    <li>
                        <a href="{{route('accepted-project-card')}}" wire:navigate> المشاريع المفعلة </a>
                    </li>
                    <li>
                        <a href="{{route('completed_project')}}" wire:navigate> المشاريع المنتهية </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ request()->routeIs('donors') ? 'active' : '' }}">
                <a href="{{ route('donors') }}" wire:navigate
                    {{ request()->routeIs('donors') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span>الإشعارات</span>
                    </div>
                    
                </a>
            </li>

            <li class="menu">
                <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-file">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        <span> Menu 3</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="submenu2" data-parent="#accordionExample">
                    <li>
                        <a href="javascript:void(0);"> Submenu 1 </a>
                    </li>
                    <li>
                        <a href="#sm2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            Submenu 2 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="sm2" data-parent="#submenu2">
                            <li>
                                <a href="javascript:void(0);"> Sub-Submenu 1 </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"> Sub-Submenu 2 </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"> Sub-Submenu 3 </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

</div>
