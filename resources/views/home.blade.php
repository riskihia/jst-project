<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home | Hebb Model</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full">
        <div class="lg:w-8/12 lg:mx-auto mx-2 mt-2">
            <span class="text-green-500 italic">
                Welcome : {{$username}}
            </span>
            <form action="/logout" method="POST">
                @csrf
                <button class="text-red-500 italic" type="submit">logout...</button>
            </form>

            {{-- create model --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Model</h1>
                @if ($model_exists)
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 my-4" role="alert">
                        <p class="font-bold">Model already exists -> <span class="text-green-600 uppercase cursor-pointer">{{$model_name}}</span></p>
                    </div>

                    <a href="/model" class="bg-blue-600 py-2 px-4 my-8 text-xl text-white rounded-md">Model Configuration</a>
                @else
                    <form action="/model" method="POST">
                        @csrf
                        <div class="flex flex-col">
                            <label class="font-medium text-xl" for="model-name">Nama model : </label>
                            
                            <input class="rounded-md my-2" required type="text" name="model_name" id="model-name">
                        </div>
                        
                        <button class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Create model</button>
                    </form>
                @endif
            </div>

            {{-- prediksi --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Prediksi</h1>
                <form action="/prediksi" method="POST">
                    @csrf
                    <div class="w-[250px] h-[250px] bg-gray-200 grid grid-cols-3 gap-2 p-2 mx-auto">
                        @for($i = 1; $i <= 9; $i++)
                            <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                                <input type="checkbox" class="cell-checkbox opacity-0" name="box{{ $i }}">
                            </div>
                        @endfor
                    </div>

                    <button type="submit" class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Prediksi Pola</button>
                </form>
            </div>

            {{-- hasil --}}
            <div class="container border border-dashed border-blue-400 p-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Hasil</h1>
                @if(session()->has('hasil_prediksi'))
                    <p class=" font-medium text-white border bg-green-500 text-center w-1/2 py-4 mx-auto rounded-md">
                        {{ session('hasil_prediksi') }}
                    </p>
                @endif
                @if(session()->has('error_tabel'))
                    <p class=" font-medium text-white border bg-red-500 text-center w-1/2 py-4 mx-auto rounded-md">
                        {{ session('error_tabel') }}
                    </p>
                @endif
            </div>
        </div>
    </body>
</html>
