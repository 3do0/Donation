<div>
    <div class="col-12 mt-5">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0 bg-dark">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="font-weight-semibold mb-0 text-white">طلبات المشاريع المعلقة</h4>
                        <p class="text-sm text-light">قائمة بطلبات المشاريع المعلقة</p>
                    </div>
                    <div class=" d-flex gap-2">
                        <a type="button"
                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center  border border-white"
                            href="" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                            <span class="btn-inner--icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="10" fill="#e9ecef"/>
                                    <path d="M12 8V16M8 12H16" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                  </svg>
                                  
                            </span>
                            <span class="btn-inner--text ">أضافة طلب</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0 mt-4" style="overflow: hidden;">
                    @livewire('Tables.ProjectRequestsTable')
                </div>
            </div>
        </div>
    </div>
    <livewire:components.modal-component />
    <livewire:organization-dashboard.projects.request.request-edit :organizationUserId="auth('organization')->user()->id"/>
    <livewire:organization-dashboard.projects.request.request-form :organizationUserId="auth('organization')->user()->id" />
</div>
