<div>
    <div class="col-12 mt-5">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0 bg-dark">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="font-weight-semibold mb-0 text-white">طلبات الحالات المعلقة</h4>
                        <p class="text-sm text-light">قائمة بطلبات الحالات المعلقة</p>
                    </div>
                    <div class=" d-flex gap-2">
                        <a type="button"
                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center  border border-white"
                            href="" data-bs-toggle="modal" data-bs-target="#createCaseModal">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                    <path
                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                    </path>
                                </svg>
                            </span>
                            <span class="btn-inner--text ">أضافة طلب</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0 mt-4" style="overflow: hidden;">
                    @livewire('Tables.CaseRequestsTable')
                </div>
            </div>
        </div>
    </div>
    <livewire:components.modal-component />
    <livewire:organization-dashboard.cases.request.request-edit :organizationUserId="auth('organization')->user()->id" />
    <livewire:organization-dashboard.cases.request.reqeust-form :organizationUserId="auth('organization')->user()->id" />
</div>
