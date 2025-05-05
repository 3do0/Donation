<x-org-app-layout>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-300 rounded shadow  sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.orgpartials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-300 rounded shadow sm:rounded-lg mt-5">
                <div class="max-w-xl">
                    @include('profile.orgpartials.update-password-form')
                </div>
            {{-- </div>

                    @include('profile.orgpartials.delete-user-form')
            </div> --}}
        </div>
    </div>
</x-org-app-layout>
