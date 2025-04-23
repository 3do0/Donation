<div>
    @if ($isOpen)
        <div wire:ignore.self class="modal fade show d-block" id="editProjectModal" tabindex="-1"
            aria-labelledby="editUserModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark d-flex justify-content-between">
                        <h5 class="modal-title text-white flex-grow-1">تعديل بيانات المشروع</h5>
                        <button type="button" class="btn-close btn-close-white" aria-label="Close"
                            wire:click="closeModal"></button>
                    </div>

                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                        <form wire:submit.prevent="UpdateRequest">

                            {{-- اسم المشروع --}}
                            <div class="mb-3">
                                <label class="form-label" for="inputProjectName">اسم المشروع</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                    <input type="text" class="form-control" id="inputProjectName"
                                        wire:model="project_name">
                                </div>
                                @error('project_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- الموقع وعدد المستفيدين --}}

                            <div class="mb-3 ">
                                <label class="form-label" for="inputLocation">الموقع</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" class="form-control" id="inputLocation" wire:model="location">
                                </div>
                                @error('location')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputBeneficiariesCount">عدد المستفيدين</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-people"></i></span>
                                        <input type="number" class="form-control" id="inputBeneficiariesCount"
                                            wire:model="beneficiaries_count">
                                    </div>
                                    @error('beneficiaries_count')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- صورة المشروع --}}
                                <div class="mb-3  col-md-6">
                                    <label class="form-label" for="inputProjectPhoto">صورة المشروع</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                                        <input type="file" class="form-control" id="inputProjectPhoto"
                                            wire:model="project_photo" accept="image/*">
                                    </div>
                                    @error('project_photo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- رقم التواصل والواتساب --}}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputContactNumber">رقم التواصل</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control" id="inputContactNumber"
                                            wire:model="contact_number">
                                    </div>
                                    @error('contact_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputWhatsappNumber">رقم الواتساب</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                                        <input type="text" class="form-control" id="inputWhatsappNumber"
                                            wire:model="whatsapp_number">
                                    </div>
                                    @error('whatsapp_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- الوصف --}}
                            <div class="mb-3">
                                <label class="form-label" for="inputDescription">الوصف</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-chat-left-text"></i></span>
                                    <textarea class="form-control" id="inputDescription" wire:model="description"></textarea>
                                </div>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            {{-- ملف المشروع --}}
                            <div class="mb-3">
                                <label class="form-label" for="inputProjectFile">ملف المشروع</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-file-earmark-pdf"></i></span>
                                    <input type="file" class="form-control" id="inputProjectFile"
                                        wire:model="project_file" accept=".pdf">
                                </div>
                                @error('project_file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- تنبيه --}}
                            <div class="alert alert-info my-4">
                                <strong>ملاحظة:</strong> سيتم مراجعة الطلب من قبل الإدارة قبل الموافقة عليه.
                            </div>

                            {{-- زر الإرسال --}}
                            <button type="submit" class="btn btn-dark btn-color" wire:loading.attr="disabled"
                                wire:target="project_file,project_photo">
                                <div class="spinner-grow text-white mr-2 align-self-center loader-sm" wire:loading
                                    wire:target="project_file,project_photo"></div>
                                حفظ التعديلات
                            </button>
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">إلغاء</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- خلفية المودال -->
        <div class="modal-backdrop fade show" id="backdrop" wire:ignore></div>
    @endif
</div>

<script>
    document.addEventListener('closeEditProjectModal', () => {
        document.getElementById('editProjectModal').classList.remove('show', 'd-block');
        document.getElementById('backdrop')?.remove();
    });
</script>
