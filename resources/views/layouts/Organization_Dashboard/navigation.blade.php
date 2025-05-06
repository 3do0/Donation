<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-end rotate-caret"
    id="sidenav-main" style="overflow: hidden ; width: 100%;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href="{{ route('organization.Main')}}" wire:navigate>
            <span class="font-weight-bold mx-4" style="font-size: 30px;">تــكــافـل</span>
        </a>
    </div>
    <div class="collapse navbar-collapse mt-2" style="overflow-y: scroll; overflow-x: hidden; height: 100%;">
        <ul class="navbar-nav" >
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('organization.Main') ? 'active' : '' }}" href="{{ route('organization.Main') }}" >
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="bi bi-house-door-fill icon-custom"></i>
                    </div>
                    <span class="nav-link-text me-1">لوحة القيادة</span>
                </a>
            </li>
            
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('organization.users') || request()->routeIs('organization.users-form') ? 'active' : '' }}"
                    href="{{ route('organization.users') }}" wire:navigate>
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-lines-fill icon-custom"></i>
                    </div>
                    <span class="nav-link-text me-1">المستخدمين</span>
                </a>
            </li> --}}
            
            
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('organization.cases-requests') || request()->routeIs('organization.case-refined')  ? '' : 'collapsed' }}"
                   data-bs-toggle="collapse"
                   href="#sidebarRequestsCases"
                   role="button"
                   aria-expanded="{{ request()->routeIs('organization.cases-requests') || request()->routeIs('organization.case-refined')  ? 'true' : 'false' }}"
                   aria-controls="sidebarRequestsCases">
            
                    <div class="d-flex align-items-center">
                        <div
                    class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                    <i class="bi bi-folder-fill icon-custom"></i>
                    </div>
                        <span class="nav-link-text me-2">طلبات الحالات</span>
                    </div>
            
                    <i class="bi bi-chevron-down small mx-4"></i>
                </a>
            
                <div class="collapse {{ request()->routeIs('organization.cases-requests') || request()->routeIs('organization.case-refined')  ? 'show' : '' }}"
                     id="sidebarRequestsCases">
                    <ul class="nav flex-column ">
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 {{ request()->routeIs('organization.cases-requests') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.cases-requests') }}" >
                                <span>الطلبات المعلقة</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 {{ request()->routeIs('organization.case-refined') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.case-refined') }}" wire:navigate>
                                <span>الطلبات المرفوضة</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{  request()->routeIs('organization.completed-case-table') || request()->routeIs('organization.completed-case-card') ||  request()->routeIs('organization.case-accpected') ? '' : 'collapsed' }}"
                   data-bs-toggle="collapse"
                   href="#sidebarCases"
                   role="button"
                   aria-expanded="{{request()->routeIs('organization.completed-case-table') || request()->routeIs('organization.completed-case-card') ||  request()->routeIs('organization.case-accpected') ? 'true' : 'false' }}"
                   aria-controls="sidebarCases">
            
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="bi bi-heart-fill icon-custom"></i>
                        </div>
                        <span class="nav-link-text me-2">الحالات</span>
                    </div>
            
                    <i class="bi bi-chevron-down small mx-4"></i>
                </a>
            
                <div class="collapse {{  request()->routeIs('organization.completed-case-table') || request()->routeIs('organization.completed-case-card')  ||  request()->routeIs('organization.case-accpected') ? 'show' : '' }}"
                     id="sidebarCases">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 {{ request()->routeIs('organization.case-accpected') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.case-accpected') }}" wire:navigate>
                                <span>الحالات المعتمدة</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 menu-dot-right {{ request()->routeIs('organization.completed-case-table') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.completed-case-table') }}" wire:navigate>
                                <span>الحالات المكتملة</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 menu-dot-right {{ request()->routeIs('organization.completed-case-card') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.completed-case-card') }}" wire:navigate>
                                <span>تفاصيل الحالات</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('organization.projects-requests') || request()->routeIs('organization.project-refined')  ? '' : 'collapsed' }}"
                   data-bs-toggle="collapse"
                   href="#sidebarRequestsProjects"
                   role="button"
                   aria-expanded="{{ request()->routeIs('organization.projects-requests') || request()->routeIs('organization.project-refined') ? 'true' : 'false' }}"
                   aria-controls="sidebarRequestsProjects">
            
                    <div class="d-flex align-items-center">
                        <div
                    class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                    <i class="bi bi-folder-fill icon-custom"></i>
                    </div>
                        <span class="nav-link-text me-2">طلبات المشاريع</span>
                    </div>
            
                    <i class="bi bi-chevron-down small mx-4"></i>
                </a>
            
                <div class="collapse {{ request()->routeIs('organization.projects-requests') || request()->routeIs('organization.project-refined')  ? 'show' : '' }}"
                     id="sidebarRequestsProjects">
                    <ul class="nav flex-column ">
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 {{ request()->routeIs('organization.projects-requests') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.projects-requests') }}">
                                <span>الطلبات المعلقة</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 {{ request()->routeIs('organization.project-refined') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.project-refined') }}" >
                                <span>الطلبات المرفوضة</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{  request()->routeIs('organization.completed-project-table') || request()->routeIs('organization.completed-project-card') || request()->routeIs('organization.project-accpected')  ? '' : 'collapsed' }}"
                   data-bs-toggle="collapse"
                   href="#sidebarProjects"
                   role="button"
                   aria-expanded="{{ request()->routeIs('organization.completed-project-table') || request()->routeIs('organization.completed-project-card') || request()->routeIs('organization.project-accpected')  ? 'true' : 'false' }}"
                   aria-controls="sidebarProjects">
            
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="bi bi-kanban-fill icon-custom"></i>
                        </div>
                        <span class="nav-link-text me-2">المشاريع</span>
                    </div>
            
                    <i class="bi bi-chevron-down small mx-4"></i>
                </a>
            
                <div class="collapse {{ request()->routeIs('organization.completed-project-table') || request()->routeIs('organization.completed-project-card') || request()->routeIs('organization.project-accpected') ? 'show' : '' }}"
                     id="sidebarProjects">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 {{ request()->routeIs('organization.project-accpected') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.project-accpected') }}" wire:navigate>
                                <span>المشاريع المعتمدة</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 menu-dot-right {{ request()->routeIs('organization.completed-project-table') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.completed-project-table') }}" wire:navigate>
                                <span>المشاريع المنتهية</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold d-flex align-items-center mb-2 menu-dot-right {{ request()->routeIs('organization.completed-project-card') ? 'active text-warning' : 'text-light' }}"
                               href="{{ route('organization.completed-project-card') }}" >
                                <span>تفاصيل المشاريع</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('organization.donations')  ? 'active' : '' }}"
                    href="{{ route('organization.donations') }}" wire:navigate>
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar icon-custom"></i>
                    </div>
                    <span class="nav-link-text me-1">التبرعات</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
