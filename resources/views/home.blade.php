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
            {{-- create model --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Model</h1>
                <form action="/model" method="GET">
                    <div class="flex flex-col">
                        <label class="font-medium text-xl" for="model-name">Nama model : </label>
                        
                        <input class="rounded-md my-2" type="text" name="model-name" id="model-name">
                    </div>
                    
                    <button class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Create model</button>
                </form>
            </div>

            {{-- prediksi --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Prediksi</h1>
                <form action="#" method="post">
                    <div class="w-[250px] h-[250px] bg-gray-200 grid grid-cols-3 gap-2 p-2 mx-auto">
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="01">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="02">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="03">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="04">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="05">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="06">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="07">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="08">
                        </div>
                        <div class="sell-tabel bg-gray-50 cursor-pointer hover:bg-blue-300">
                            <input type="checkbox" class="cell-checkbox opacity-0" value="09">
                        </div>
                    </div>
                
                    <button class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Prediksi Pola</button>
                </form>
            </div>

            {{-- hasil --}}
            <div class="container border border-dashed border-blue-400 p-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Hasil</h1>
                <p class=" font-medium text-white border bg-green-500 text-center w-1/2 py-4 mx-auto rounded-md">Hasil prediksi => Huruf U</p>
            </div>
        </div>
    </body>
</html>
