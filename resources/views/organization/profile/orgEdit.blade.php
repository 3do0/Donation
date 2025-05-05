@extends('layouts.Organization_Dashboard.app')


@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.orgpartials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.orgpartials.update-password-form')
                </div>
            </div>

                    @include('profile.orgpartials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
