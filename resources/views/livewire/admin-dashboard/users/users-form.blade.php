@section('title')
    أضافة مدير
@endsection

<div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
    <div class="statbox widget box box-shadow border rounded shadow-lg">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h3 class="c-grey-900 text-warning m-4">تسجيل المستخدمين </h3>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
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

            <form wire:submit.prevent="register" class="mx-3">
              <div class="mb-3">
                  <label class="form-label" for="inputname">أسم المستخدم</label>
                  <div class="input-group">
                      <span class="input-group-text bg-warning"><i class="bi bi-person icon-custom"></i></span>
                      <input type="text" class="form-control" id="inputname" name="name" wire:model.live="name" :value="old('name')" required autofocus autocomplete="name">
                  </div>
                  @error('name') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
          
              <div class="row">
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="inputEmail4">عنوان البريد الالكتروني</label>
                      <div class="input-group">
                          <span class="input-group-text bg-warning"><i class="bi bi-envelope icon-custom"></i></span>
                          <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" wire:model="email" :value="old('email')" required autocomplete="username">
                      </div>
                      @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
          
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="inputPassword4">كلمة المرور</label>
                      <div class="input-group">
                          <span class="input-group-text bg-warning"><i class="bi bi-lock icon-custom"></i></span>
                          <input type="text" class="form-control" id="inputPassword4" placeholder="Password" name="password" wire:model="password" required autocomplete="new-password">
                      </div>
                      @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
              </div>
          
              <div class="row">
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="inputPhone">رقم الهاتف</label>
                      <div class="input-group">
                          <span class="input-group-text bg-warning"><i class="bi bi-telephone icon-custom"></i></span>
                          <input type="text" class="form-control" id="inputPhone" placeholder="+967" name="phone" wire:model="phone" :value="old('phone')" required>
                      </div>
                      @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
          
                  <div class="mb-3 col-md-4">
                      <label class="form-label" for="activity_type">الجنس</label>
                      <div class="input-group">
                          <span class="input-group-text bg-warning"><i class="bi bi-gender-ambiguous icon-custom"></i></span>
                          <select class="form-control" id="activity_type" wire:model="gender">
                            <option value="male">ذكــر</option>
                            <option value="female">أنثى</option>
                        </select>
                      </div>
                      @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
              </div>
          
              <div class="mb-3">
                  <label class="form-label" for="inputPhoto">الصورة الشخصية</label>
                  <div class="input-group">
                      <span class="input-group-text bg-warning"><i class="bi bi-image icon-custom"></i></span>
                      <input type="file" id="inputPhoto" class="form-control" wire:model="photo">
                  </div>
                  @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
          
              <button type="submit" class="btn btn-warning btn-color">أضافة</button>
          </form>
          
          
        </div>
    </div>
</div>
