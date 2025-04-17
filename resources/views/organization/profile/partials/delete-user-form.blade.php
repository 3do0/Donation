<!-- زر الحذف -->
<div class="account-settings-footer">
    <div class="as-footer-container">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-account">حذف حسابي</button>
    </div>
</div>

<!-- مودال تأكيد الحذف -->
<div id="delete-account" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('organization.profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountLabel">حذف الحساب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">...</button>
                </div>

                <div class="modal-body">
                    <p>هل أنت متأكد أنك تريد حذف حسابك؟ بمجرد الحذف، سيتم فقدان جميع البيانات بشكل دائم.</p>

                    <div class="form-group">
                        <label for="password">كلمة المرور:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="أدخل كلمة المرور">

                        @if ($errors->userDeletion->has('password'))
                            <div class="text-danger mt-2">{{ $errors->userDeletion->first('password') }}</div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">تأكيد حذف الحساب</button>
                </div>
            </form>
        </div>
    </div>
</div>
