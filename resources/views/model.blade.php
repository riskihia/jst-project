<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full">
        
        
        <div class="lg:w-8/12 lg:mx-auto mx-2 mt-2">
            {{-- back --}}
            <a href="/home" class="bg-blue-600 py-2 px-4 mb-4 inline-block text-xl text-white rounded-md">Back to home</a>
            
            {{-- create tabel --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Tabel</h1>
                @if ($tabel_exists)
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 my-4" role="alert">
                        <p class="font-bold">Tabel already exists -> <span class="text-green-600 uppercase cursor-pointer">{{$tabel_name}}</span></p>
                    </div>
                @else
                    <form action="/tabel" method="POST">
                        @csrf
                        <div class="flex flex-col">
                            <label class="font-medium text-xl" for="tabel-name">Nama tabel : </label>
                            
                            <input class="rounded-md my-2 lg:w-1/2" type="text" name="tabel_name" id="tabel-name">
                        </div>

                        <button type="submit" class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Create tabel</button>
                    </form>
                @endif
            </div>

            {{-- pola --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Pola</h1>
                <form action="/pola" method="POST">
                    @csrf
                    <div class="w-[250px] h-[250px] bg-gray-200 grid grid-cols-3 gap-2 p-2 mx-auto">
                        @for($i = 1; $i <= 9; $i++)
                            <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                                <input type="checkbox" class="cell-checkbox opacity-0" name="box{{ $i }}">
                            </div>
                        @endfor
                    </div>
                
                    <div class="flex flex-col">
                        <label class="font-medium text-xl" for="target">Target : </label>
                        
                        <input class="rounded-md my-2 lg:w-1/2" type="text" name="target" id="target">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-xl" for="bias">Bias : </label>
                        
                        <input class="rounded-md my-2 lg:w-1/2" type="text" name="bias" id="bias">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-xl" for="nama-pola">Nama pola : </label>
                        
                        <input class="rounded-md my-2 lg:w-1/2" type="text" name="nama_pola" id="nama-pola">
                    </div>

                    <button type="submit" class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Insert Pola</button>
                </form>
            </div>

            {{-- train --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Train</h1>

                <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                      <input id="offers" name="offers" type="checkbox" class="checkbox-input-style">
                    </div>
                    <div class="text-sm leading-6">
                      <label for="offers" class="font-medium text-base text-gray-900">Pola 1</label>
                    </div>
                </div>
                <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                      <input id="offers" name="offers" type="checkbox" class="checkbox-input-style">
                    </div>
                    <div class="text-sm leading-6">
                      <label for="offers" class="font-medium text-base text-gray-900">Pola 1</label>
                    </div>
                </div>
                <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                      <input id="offers" name="offers" type="checkbox" class="checkbox-input-style">
                    </div>
                    <div class="text-sm leading-6">
                      <label for="offers" class="font-medium text-base text-gray-900">Pola 1</label>
                    </div>
                </div>

                <button class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Train Pola</button>
            </div>
            
            
            {{-- hasil train --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Hasil Train</h1>

                <ul class="list-disc pl-4">
                    <li class="text-base font-medium">Pola 1 :: berhasil</li>
                    <li class="text-base font-medium">Pola 1 :: berhasil</li>
                    <li class="text-base font-medium">Pola 1 :: berhasil</li>
                    <li class="text-base font-medium">...</li>
                </ul>

                <button class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Simpan model</button>
            </div>
        </div>
    </body>
</html>
