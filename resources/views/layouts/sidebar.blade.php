<div class="sidebar-wrapper sidebar-theme">

    <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>
    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('Main') }}">
                    <img src="{{ asset('assets/img/logo1.png') }}" class="navbar-logo" alt="logo">
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
                    class="dropdown-toggle">
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span>مستخدمي النظام</span>
                </div>
            </li>

            <li>
                <a href="#" aria-expanded="true" class="d-hidden"></a>
            </li>

            {{-- <li class="menu {{ request()->routeIs('users') ? 'active' : '' }}">
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
            </li> --}}

            <li class="menu">
                <a href="#organization" data-toggle="collapse" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7"></path>
                            <path d="M9 22V12h6v10"></path>
                        </svg>
                        <span>المؤسسات الخيرية</span>
                    </div>

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled " id="organization" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('org') }}" > المؤسسات الفعالة </a>
                    </li>

                    <li>
                        <a href="{{ route('join-requests') }}" >طلبات الانضمام
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ request()->routeIs('donors') ? 'active' : '' }}">
                <a href="{{ route('donors') }}" 
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span>عمليات المنظمة</span>
                </div>
            </li>


            <li class="menu {{ request()->routeIs('donations') ? 'active' : '' }}">
                <a href="{{ route('donations') }}"
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-heart me-2">
                            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1
                                    a5.5 5.5 0 0 0-7.8 7.8l1 1 7.8 7.8
                                    7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.8z"></path>
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

                <ul class="collapse submenu list-unstyled" id="submenu"
                    data-parent="#accordionExample">
                    <li class="{{ request()->routeIs('cases-request') ? 'active' : '' }}">
                        <a href="{{ route('cases-request') }}">
                            الطلبات المعلقة 
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('refined-case') ? 'active' : '' }}">
                        <a href="{{ route('refined-case') }}" wire:navigate> الطلبات المرفوضة</a>
                    </li>
                    <li class="{{ request()->routeIs('accepted_case') ? 'active' : '' }}">
                        <a href="{{ route('accepted_case') }}" > الحالات المقبولة </a>
                    </li>
                    <li class="{{ request()->routeIs('accepted-case-card') ? 'active' : '' }}">
                        <a href="{{ route('accepted-case-card') }}" > الحالات المفعلة </a>
                    </li>
                    <li class="{{ request()->routeIs('completed_case') ? 'active' : '' }}">
                        <a href="{{ route('completed_case') }}" > الحالات المكتملة </a>
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
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73L13 2.27a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z">
                            </path>
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
                        <a href="{{ route('projects-request') }}">
                            الطلبات المعلقة
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('refined-project') }}" wire:navigate> الطلبات المرفوضة</a>
                    </li>
                    <li>
                        <a href="{{ route('accepted-project') }}" > المشاريع المقبولة </a>
                    </li>
                    <li>
                        <a href="{{ route('accepted-project-card') }}" > المشاريع المفعلة </a>
                    </li>
                    <li>
                        <a href="{{ route('completed_project') }}" > المشاريع المنتهية </a>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span>تقارير عامة</span>
                </div>
            </li>

            <li class="menu {{ request()->routeIs('donations-report') ? 'active' : '' }}">
                <a href="{{ route('donations-report') }}" wire:navigate
                    {{ request()->routeIs('donations-report') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-file-text me-2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <line x1="10" y1="9" x2="8" y2="9" />
                        </svg>
                        <span>تقارير التبرعات</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('case-donations') ? 'active' : '' }}">
                <a href="{{ route('case-donations') }}" wire:navigate
                    {{ request()->routeIs('case-donations') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-layers me-2" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        <span>تقارير الحالات</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('org-donations-report') ? 'active' : '' }}">
                <a href="{{ route('org-donations-report') }}" wire:navigate
                    {{ request()->routeIs('org-donations-report') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bar-chart-2">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>

                        <span>تقارير المنظمات</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span>إضافي</span>
                </div>
            </li>
            <li class="menu {{ request()->routeIs('platform-donations') ? 'active' : '' }}">
                <a href="{{ route('platform-donations') }}"
                    {{ request()->routeIs('platform-donations') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>دعم المنصة</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{ route('notification') }}" class="dropdown-toggle">
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

            <li class="menu {{ request()->routeIs('partners') ? 'active' : '' }}">
                <a href="{{ route('partners') }}" 
                    {{ request()->routeIs('partners') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-briefcase me-2" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 3h-8v4h8V3z"></path>
                        </svg>
                        <span>الشركاء</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('currncies-list') ? 'active' : '' }}">
                <a href="{{ route('currncies-list') }}" wire:navigate data-toggle="collapse"
                    {{ request()->routeIs('currncies-list') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>العملات</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('logs') ? 'active' : '' }}">
                <a href="{{ route('logs') }}"
                    {{ request()->routeIs('logs') ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-monitor">
                            <rect x="3" y="4" width="18" height="12" rx="2" ry="2" />
                            <line x1="8" y1="21" x2="16" y2="21" />
                            <line x1="12" y1="17" x2="12" y2="21" />
                        </svg>
                        <span>احداث النظام</span>
                    </div>
                </a>
            </li>

        </ul>
    </nav>

</div>
