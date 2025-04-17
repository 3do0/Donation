<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>
        {{ auth('organization')->user()->name }}
        {{ auth('organization')->user()->organization()->first()->name }}

        <form method="POST" action="{{ route('organization.logout') }}">
            @csrf

            <x-dropdown-link :href="route('organization.logout')"
                onclick="event.preventDefault();
                                    this.closest('form').submit();">
                
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>تسجيل الخروج</span>
            </x-dropdown-link>
        </form>
    </h1>
</body>
</html>