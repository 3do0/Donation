<div class="mt-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-pencil primary font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>278</h3>
                                <span>New Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-speech warning font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>156</h3>
                                <span>New Comments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 mt-5">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0 bg-dark">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="font-weight-semibold mb-0 text-white">قائمة الجمعيات الخيريـة</h4>
                        <p class="text-sm text-light">معرفة حميع المعلومات عن الجمعيات الخيرية المسجله لدى المنصة</p>
                    </div>
                    <div class=" d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-white ">
                            عرض الكل
                        </button>
                        <a type="button"
                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center  border border-white"
                            href="{{ route('org-form') }}" wire:navigate>
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                    <path
                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                    </path>
                                </svg>
                            </span>
                            <span class="btn-inner--text ">أضافة جمعية جديدة</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable1"
                            autocomplete="off" checked="">
                        <label class="btn btn-white px-3 mb-0" for="btnradiotable1">الكل</label>
                        <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable2"
                            autocomplete="off">
                        <label class="btn btn-white px-3 mb-0" for="btnradiotable2">النشطين</label>
                        <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable3"
                            autocomplete="off">
                        <label class="btn btn-white px-3 mb-0" for="btnradiotable3">غير النشطين</label>
                    </div>
                    <!-- مربع البحث في أقصى اليسار -->
                    <div class="input-group w-sm-25">
                        <span class="input-group-text text-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </span>
                        <input type="text" class="form-control" placeholder="بحث">
                    </div>
                </div>

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">#</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">الشعار
                                </th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">أسم
                                    المؤسسـة</th>
                                <th class="text center text-secondary text-xs font-weight-semibold opacity-9">بيانات
                                    التواصل</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">نوع النشاط
                                </th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">موقع
                                    المؤسسـة</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9"> رقم
                                    التسجيل</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">البنك الذي
                                    تتعامل معة</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">رقم حساب
                                    البنك</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">ملف
                                    التصاريح</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">رابط
                                    المؤسسـة</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">الحالــة
                                </th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-9">تاريخ
                                    الانشاء</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-9">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organizations as $org)
                                <tr>
                                    <td class="text-center">{{ $org->id }}</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center">
                                            @if ($org->logo)
                                                <img src="{{ asset('storage/' . $org->logo) }}" class="rounded-3 w-100"
                                                    alt="user1">
                                            @else
                                                <img src="../assets/img/id.jpg"
                                                    class="avatar img-fluid rounded-circle ms-2" alt="user1">
                                            @endif
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-sm text-dark font-weight-semibold mb-0">{{ $org->name }}</p>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $org->email }}</h6>
                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $org->phone }}</h6>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        @php
                                            $activities = explode(',', $org->activity_type);
                                        @endphp
                                        <div class="d-grid gap-2 text-center"
                                            style="grid-template-columns: repeat(3, 1fr); max-width: 300px; margin: auto;">
                                            @foreach ($activities as $activity)
                                                <span
                                                    class="badge badge-sm border border-info text-info bg-info">{{ $activity }}</span>
                                            @endforeach
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-secondary">المـحـافـظـة :
                                                <span class="text-dark font-weight-semibold">{{ $org->city }}</span>
                                            </h6>
                                            <h6 class="mb-0 text-sm text-secondary">الـحـي :
                                                <span class="text-dark font-weight-semibold">{{ $org->address }}</span>
                                            </h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                            {{ $org->registration_number }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-sm text-dark font-weight-semibold mb-0">{{ $org->bank_name }}
                                        </p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                            {{ $org->bank_account_number }}</p>
                                    </td>

                                    <td class="align-middle text-center">
                                      @if ($org->license)
                                          <a href="{{ asset('storage/' . $org->license) }}" target="_blank"
                                              class="btn btn-sm btn-info">
                                              عرض الملف
                                          </a>
                                      @else
                                          لا يوجد ملف
                                      @endif
                                  </td>

                                  <td class="text-center">
                                    <a href="{{ $org->web_url }}" class="btn btn-link text-info text-decoration-underline" target="_blank">
                                        {{ $org->web_url }}</a>
                                </td>

                                <td class="align-middle text-center text-sm">
                                  <div class="form-check form-switch ms-3">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                    id="{{ $org->id }}"
                                    wire:click="toggleStatus({{ $org->id }})"
                                    {{ $org->status ? 'checked' : '' }} />
                                  </div>
                                </td>
                                
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-sm font-weight-normal">{{ $org->created_at->format('Y-m-d') }}</span>
                                </td>
                                    <td class="align-middle">

                                        <button class="btn btn-warning text-white p-2 me-2">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger text-white p-2 me-2"
                                            wire:click="confirmDelete({{ $org->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-top py-3 px-3 d-flex align-items-center">
                    <p class="font-weight-semibold mb-0 text-dark text-sm">Page 1 of 10</p>
                    <div class="ms-auto">
                        <button class="btn btn-sm btn-white mb-0">Previous</button>
                        <button class="btn btn-sm btn-white mb-0">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
