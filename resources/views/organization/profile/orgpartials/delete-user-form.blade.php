<div class="account-settings-footer">
    <div class="as-footer-container text-center">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-account">
            حذف حسابي
        </button>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="delete-account" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountLabel">حذف الحساب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p>هل أنت متأكد أنك تريد حذف حسابك؟ بمجرد الحذف، سيتم فقدان جميع البيانات بشكل دائم.</p>

                <form method="POST" action="{{ route('Orgprofile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="أدخل كلمة المرور">
                        
                        @if ($errors->userDeletion->has('password'))
                            <div class="text-danger mt-2">{{ $errors->userDeletion->first('password') }}</div>
                        @endif
                    </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-danger">تأكيد حذف الحساب</button>
            </div>

                </form>
        </div>
    </div>
</div>
