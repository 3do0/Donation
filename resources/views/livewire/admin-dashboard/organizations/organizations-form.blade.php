<div class="bg-white p-5 mt-5 border rounded shadow-lg">
    <h6 class="c-grey-900 mb-4 text-warning text-lg">تسجيل المؤسسات الخيريـة</h6>

    @if (session()->has('message'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check text-success me-3"></i>
            <div>{{ session('message') }}</div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent='register'>
        <div class="mb-3">
            <label class="form-label" for="inputName">اسم الشريك</label>
            <input type="text" class="form-control" id="inputName" wire:model='name'>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputEmail">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" wire:model='email'>
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

            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputCity">المدينة</label>
                <select id="inputCity" class="form-control" wire:model='city'>
                    @foreach (App\Enums\Cities::cases() as $case)
                        <option value="{{ $case->value }}">{{ $case->value }}</option>
                    @endforeach
                </select>
                @error('city') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputRegistrationNumber">رقم التسجيل</label>
                <input type="text" class="form-control" id="inputRegistrationNumber" wire:model='registration_number'>
                @error('registration_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputWebUrl">رابط الموقع الإلكتروني</label>
                <input type="text" class="form-control" id="inputWebUrl" placeholder="www.website.com" wire:model='web_url'>
                @error('web_url') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputBankName">اسم البنك</label>
                <input type="text" class="form-control" id="inputBankName" wire:model='bank_name'>
                @error('bank_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputBankAccount">رقم الحساب البنكي</label>
                <input type="text" class="form-control" id="inputBankAccount" wire:model='bank_account_number'>
                @error('bank_account_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3 col-md-6">
            <label class="form-label" for="inputActivityType">نوع النشاط الخيري</label>
            <select id="inputActivityType" class="form-control" wire:model='activity_type' multiple>
                @foreach (App\Enums\OrganizationType::cases() as $case)
                    <option value="{{ $case->name }}">{{ $case->value }}</option>
                @endforeach
            </select>
            @error('activity_type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputLicense">ترخيص المؤسسة</label>
                <input type="file" class="form-control" id="inputLicense" wire:model='license'>
                @error('license') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputLogo">شعار المؤسسـة</label>
                <input type="file" class="form-control" id="inputLogo" wire:model='logo'>
                @error('logo') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                <input type="checkbox" id="inputStatus" class="peer" wire:model='status'>
                <label for="inputStatus" class="form-label peers peer-greed js-sb ai-c">
                    <span class="peer peer-greed"> تفعيل المؤسسـة الخيرية الآن </span>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-warning btn-block">إضافة الشريك</button>
    </form>
</div>
