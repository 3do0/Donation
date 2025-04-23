<div>
    <div class="col-12 mt-5">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0 bg-dark">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="font-weight-semibold mb-0 text-white">تبرعات المنظمة</h4>
                        <p class="text-sm text-light">قائمة بتفاصيل التبرعات للحالات الخاصة بالمنظمة</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0 mt-4" style="overflow: hidden;">
                    @livewire('Tables.OrganizationDonationTable')
                </div>
            </div>
        </div>
    </div>
    <livewire:components.modal-component />
</div>
