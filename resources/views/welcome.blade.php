<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite('resources/css/app.css')
    </head>
    <body class="h-full">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="login-h1">Silahkan login terlebih dahulu</h2>
            {{-- <h2 class="bg-violet-800">Silahkan login terlebih dahulu</h2> --}}
            </div>
        
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                {{-- field name --}}
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Usernama : </label>
                    <div class="mt-2">
                        <input id="username" username="username" type="username" autocomplete="username" required class="input-style">
                    </div>
                </div>
        
                {{-- button login --}}
                <div>
                    <button type="submit" class="button-style">Sign in</button>
                </div>
            </form>
            </div>
        </div>
    </body>
</html>
