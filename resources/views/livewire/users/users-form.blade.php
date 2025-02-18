
  <div class="mt-5 bg-white p-2 border rounded shadow-lg">
  <div class="row">
    <div class=" p-4  w-60">
      <h3 class="c-grey-900 mb-4 text-warning">تسجيل المستخدمين </h3>
      <div class="mt-30">
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

    <form wire:submit.prevent="register">
        <div class="mb-3">
          <label class="form-label" for="inputname">أسم المستخدم</label>
          <input type="text" class="form-control" id="inputname" name="name" wire:model.live="name" :value="old('name')" required autofocus autocomplete="name">
          @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

          <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label" for="inputEmail4">عنوان البريد الالكتروني</label>
              <input type="email" class="form-control" id="inputEmail4" placeholder="Email"  name="email" wire:model="email" :value="old('email')" required autocomplete="username">
              @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="inputPassword4">Password</label>
              <input type="text" class="form-control" id="inputPassword4" placeholder="Password" name="password" wire:model="password" required autocomplete="new-password">
              @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label" for="inputPhone">رقم الهاتف</label>
            <input type="text" class="form-control" id="inputPhone" placeholder="+967" name="phone" wire:model="phone" :value="old('phone')" required>
            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3 col-md-4">
            <label class="form-label" for="activity_type">الجنس</label>
            <select class="form-select pe-5" id="activity_type" wire:model="gender">
                <option value="male">ذكــر</option>
                <option value="female">أنثى</option>
            </select>
            @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="inputPhoto">الصورة الشخصية</label>
            <input type="file" id="inputPhoto" class="form-control" wire:model="photo">
            @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 col-md-5">
          <label class="form-label" for="activity_type">نوع المستخدم</label>
          <select class="form-select pe-5" id="activity_type" wire:model.live="role">
            @foreach (\Spatie\Permission\Models\Role::all() as $role)
            <option value="{{$role->name}}">{{$role->name}}</option>
            @endforeach
             
          </select>
          @error('role') <div class="text-danger">{{ $message }}</div> @enderror
      </div>


          <button type="submit" class="btn btn-warning btn-color">أضافة</button>
        </form>
      
        </div>
      </div>
      <div class="col-md-4 mt-5 me-6">
        <div class="card profile-card-3 ">
           <div class="background-block">
              <img src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="profile-sample1" class="background" />
           </div>
           <div class="profile-thumb-block">
            @if ($photo)
              <img src="{{ $photo->temporaryUrl() }}" alt="profile-image" class="profile" />
            @else
            <img src="{{asset('assets/img/id.jpg')}}" class="profile" alt="profile">
            @endif
          
          @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
           </div>
           <div class="card-content">
              <h2>{{$name}}<small>{{$role->name}}</small></h3>
                 <div class="icon-block"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"> <i class="fa fa-twitter"></i></a><a href="#"> <i class="fa fa-google-plus"></i></a>
                 </div>
           </div>
        </div>
      </div>
     </div>
  </div>
