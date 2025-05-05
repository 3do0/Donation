<nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded " id="navbarBlur">
    <div class="container-fluid py-1 px-2">
      <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group">
            <span class="input-group-text text-body bg-white  border-start-0 ">
              <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
              </svg>
            </span>
            <input type="text" class="form-control pe-0" placeholder="أكتب هنا...">
          </div>
        </div>
        <ul class="navbar-nav me-auto ms-0 justify-content-end">
          <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="fullscreen-btn" onclick="toggleFullscreen()">
              <i class="bi bi-arrows-fullscreen" id="fullscreen-icon"></i>
            </a>
          </li>
        
          <li class="nav-item ps-2 dropdown d-flex align-items-center mx-2">
            <a href="javascript:;" class="nav-link text-body p-0"  id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="d-flex align-items-center justify-content-center border rounded-circle" style="width: 32px; height: 32px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" height="16" width="16">
                  <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.866 0-7 3.134-7 7a1 1 0 001 1h12a1 1 0 001-1c0-3.866-3.134-7-7-7z"/>
                </svg>
              </div>
              
            </a>
            <ul class="dropdown-menu px-2 py-3 me-sm-n4" aria-labelledby="dropdownUser">
              @if (auth('organization')->user())
                  <li class="mb-2">
                      <a href="{{ route('Orgprofile.edit') }}" class="dropdown-item border-radius-md">
                          <div class="d-flex py-1">
                              <div class="my-auto">
                                  <img src="{{ asset('storage/' . auth('organization')->user()->photo) }}" class="avatar avatar-sm border-radius-sm ms-3" alt="صورة المستخدم">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                  <h6 class="text-sm font-weight-bold mb-1">
                                      {{ auth('organization')->user()->name }}
                                  </h6>
                                  <p class="text-xs text-secondary mb-0">
                                      {{ auth('organization')->user()->email }}
                                  </p>
                              </div>
                          </div>
                      </a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('organization.logout') }}">
                        @csrf
                        <button class="dropdown-item border-radius-md text-white bg-danger bg-opacity-20 w-100 text-center" onclick="event.preventDefault(); this.closest('form').submit();">
                            <div class="d-flex py-1 justify-content-center">
                                <div class="my-auto">
                                  <i class="bi bi-box-arrow-right text-white ms-2"></i>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-sm font-weight-normal mb-0 text-white">
                                        تسجيل الخروج
                                    </h6>
                                </div>
                            </div>
                        </button>
                    </form>
                </li>                
              @endif
          </ul>
          
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4 px-5">
    <div class="row">
      <div class="col-md-12">
        <div class="d-md-flex align-items-center mb-3">
          <div class="mb-md-0 mb-3">
            @if(auth('organization')->check())
            <h3 class="font-weight-bold mb-0">
              مرحبًا,
              <span class="font-weight-bold mb-0 text-warning">
                {{ auth('organization')->user()->name }}
              </span>
            </h3>
            @endif
            <p class="mb-0 mt-3"> أنت تتفاعل الأن باسم منظمة <span class="text-secondary">{{auth('organization')->user()->organization->name}}</span></p>
          </div>
        </div>
      </div>
    </div>
    <hr class="my-0" />