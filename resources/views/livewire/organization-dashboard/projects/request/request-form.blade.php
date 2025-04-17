<div class="mt-5 bg-white p-2 border rounded shadow-lg">
    <div class="row">
        <div class="p-4">
            <h6 class="mb-4 text-warning font-weight-semibold" style="font-size: 35px; font-weight:500;">
                طلب إضافة مشروع 
            </h6>

            <form wire:submit.prevent="AddRequest">

                {{-- اسم المشروع --}}
                <div class="mb-3">
                    <label class="form-label" for="inputProjectName">اسم المشروع</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                        <input type="text" class="form-control" id="inputProjectName" wire:model="project_name">
                    </div>
                    @error('project_name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- الموقع وعدد المستفيدين --}}
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputLocation">الموقع</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" class="form-control" id="inputLocation" wire:model="location">
                        </div>
                        @error('location') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputBeneficiariesCount">عدد المستفيدين</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                            <input type="number" class="form-control" id="inputBeneficiariesCount"
                                wire:model="beneficiaries_count">
                        </div>
                        @error('beneficiaries_count') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- رقم التواصل والواتساب --}}
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputContactNumber">رقم التواصل</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control" id="inputContactNumber" wire:model="contact_number">
                        </div>
                        @error('contact_number') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputWhatsappNumber">رقم الواتساب</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                            <input type="text" class="form-control" id="inputWhatsappNumber" wire:model="whatsapp_number">
                        </div>
                        @error('whatsapp_number') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- الوصف --}}
                <div class="mb-3">
                    <label class="form-label" for="inputDescription">الوصف</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-chat-left-text"></i></span>
                        <textarea class="form-control" id="inputDescription" wire:model="description"></textarea>
                    </div>
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- صورة المشروع --}}
                <div class="mb-3">
                    <label class="form-label" for="inputProjectPhoto">صورة المشروع</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                        <input type="file" class="form-control" id="inputProjectPhoto" wire:model="project_photo">
                    </div>
                    @error('project_photo') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- ملف المشروع --}}
                <div class="mb-3">
                    <label class="form-label" for="inputProjectFile">ملف المشروع</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-file-earmark-pdf"></i></span>
                        <input type="file" class="form-control" id="inputProjectFile" wire:model="project_file">
                    </div>
                    @error('project_file') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- تنبيه --}}
                <div class="alert alert-info my-4">
                    <strong>ملاحظة:</strong> سيتم مراجعة الطلب من قبل الإدارة قبل الموافقة عليه.
                </div>

                {{-- زر الإرسال --}}
                <button type="submit" class="btn btn-warning btn-block">إرسال الطلب</button>
            </form>
        </div>
    </div>
</div>
