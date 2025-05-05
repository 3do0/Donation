<div>
    <div wire:ignore class="modal fade" id="sendNotificationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-white">FCMارسال اشعار</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"  >
                       <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                        <form wire:submit.prevent="sendNotification" class="modal-content" wire:ignore>
                 
                            <div class="modal-body">
            
                                <div class="mb-3">
                                    <label for="title" class="form-label">عنوان الإشعار</label>
                                    <input type="text" wire:model="title" id="title" class="form-control" >
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
            
                                <div class="mb-3">
                                    <label for="body" class="form-label">محتوى الإشعار</label>
                                    <textarea wire:model="body" id="body" class="form-control" rows="3"  ></textarea>
                                    @error('body') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">إرسال</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">إلغاء</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
        </div>
        {{-- <div class="modal-backdrop fade show" id="backdrop" wire:ignore></div> --}}
 
</div>

@push('scripts')
<script>
    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}',
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true,
    });

    window.Echo.channel('case-updates')
        .listen('.CaseCreated', (e) => {
            console.log('📢 استقبلنا الحدث العام CaseCreated:', e);
            Livewire.dispatch('CaseCreated'); 
        });

        window.Echo.channel('reject-project')
        .listen('.ProjectRejection', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('ProjectRejection'); 
        });

        window.Echo.channel('new-donation')
        .listen('.NewDonation', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('NewDonation'); 
        });
</script>

<script>
    
    document.addEventListener('send-out', () => {
        document.getElementById('sendNotificationModal').classList.remove('show', 'd-block');
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());

    });
</script>

@endpush
