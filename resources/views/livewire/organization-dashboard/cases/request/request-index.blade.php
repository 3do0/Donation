<div>
    <livewire:components.modal-component />
    <livewire:organization-dashboard.cases.request.reqeusts-list />
    <livewire:organization-dashboard.cases.request.request-edit :organizationUserId="auth('organization')->user()->id" />
    <livewire:organization-dashboard.cases.request.reqeust-form :organizationUserId="auth('organization')->user()->id" />
</div>
