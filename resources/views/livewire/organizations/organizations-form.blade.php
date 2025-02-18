<div class="bg-white p-4 bd mt-5 border rounded shadow-lg ">
    <h6 class="c-grey-900 mb-4 text-warning text-lg">تسجيل المؤسسات الخيريـة</h6>
    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            <div class="d-flex gap-4">
                <span><i class="fa-solid fa-circle-check icon-success"></i></span>
                <div>
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form wire:submit.prevent='register'>
        <div class="mb-3">
            <label class="form-label" for="inputName">اسم المؤسسة </label>
            <input type="text" class="form-control" id="inputName" wire:model='name'>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputEmail4">عنوان البريد الالكتروني</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" wire:model='email'>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputPhone">رقم الهاتف</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="+967" wire:model='phone'>
                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputAddress">العنوان</label>
                <input type="text" class="form-control" id="inputAddress" wire:model='address'>
                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label" for="inputType">المدينة</label>
                <select id="inputType" class="form-control" wire:model='city'>
                    @foreach (App\Enums\Cities::cases() as $case)
                        <option selected value="{{ $case->value }}">{{ $case->value }}</option>
                    @endforeach
                </select>
                @error('city') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>


        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="input_no_reg">رقم التسجيل للمؤسسة</label>
                <input type="text" class="form-control" id="input_no_reg" wire:model='registration_number'>
                @error('registration_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label" for="input_url">رابط صفحة المؤسسـة</label>
                <input type="text" class="form-control" placeholder="www.website.com" id="input_url" wire:model='web_url'>
                @error('web_url') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputBankName">أسم البنك الذي تتعامل معه المؤسسة</label>
                <input type="text" class="form-control" id="inputBankName" wire:model='bank_name'>
                @error('bank_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputBankNo">رقم الحساب البنكي</label>
                <input type="text" class="form-control" id="inpuBankNo" wire:model='bank_account_number'>
                @error('bank_account_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="inputType"> نوع النشاط الخيري</label>
            <select id="inputType" class="form-control" wire:model='activity_type' multiple>
                @foreach (App\Enums\OrganizationType::cases() as $case)
                    <option selected value="{{ $case->name }}">{{ $case->value }}</option>
                @endforeach
            </select>
            @error('activity_type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 col-md-9">
            <label class="form-label" for="inputlicense">ترخيص المؤسسة</label>
            <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                wire:model='license'>
                @error('license') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3 col-md-9">
            <label class="form-label" for="inputlogo">شعار المؤسسة (Logo) </label>
            <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                wire:model='logo'>
                @error('logo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                <input type="checkbox" id="inputCall2" name="inputCheckboxesCall" class="peer" wire:model='status'>
                <label for="inputCall2" class="form-label peers peer-greed js-sb ai-c">
                    <span class="peer peer-greed"> الموافقة على تفعيل المؤسسة الان </span>
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-warning btn-color">أضافة</button>
    </form>
</div>
