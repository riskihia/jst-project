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

                    @if(session()->has('message'))
                        <p class=" font-medium text-white border bg-green-500 text-center w-1/2 py-4 mx-auto rounded-md">
                            {{ session('message') }}
                        </p>
                    @endif
                
                    <div class="flex flex-col">
                        <label class="font-medium text-xl" for="target">Target : </label>
                        
                        <input required class="rounded-md my-2 lg:w-1/2" type="text" name="target" id="target">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-xl" for="bias">Bias : </label>
                        
                        <input required class="rounded-md my-2 lg:w-1/2" type="text" name="bias" id="bias">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-xl" for="nama-pola">Nama pola : </label>
                        
                        <input required class="rounded-md my-2 lg:w-1/2" type="text" name="nama_pola" id="nama-pola">
                    </div>

                    <button type="submit" class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Insert Pola</button>
                </form>
            </div>

            {{-- train --}}  
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Train</h1>
                @if ($user->jst_model->tabel()->exists())
                    <form action="/train" method="POST">
                        @csrf

                        @foreach ($user->jst_model->tabel->polas()->get() as $key => $pola)
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input id="pola{{$key}}" name="pola[{{$key}}]" type="checkbox" value="{{$pola->id}}" class="checkbox-input-style">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="pola{{$key}}" class="font-medium text-base text-gray-900">Pola {{$key + 1}}: {{$pola->name}}</label>
                                </div>
                            </div>
                        @endforeach

                        @if(session()->has('error'))
                            <p class="text-base font-medium text-red-500">{{session('error')}}</p>
                        @endif
                        
                        <button type="submit" class="bg-blue-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Train Pola</button>
                    </form>
                @else
                    <div class="flex h-6 items-center">
                        <input type="checkbox" class="checkbox-input-style">
                        <div class="text-sm leading-6">
                            <label class="font-medium text-base text-gray-900 ml-4">Silahkan buat pola terlebih dahulu</label>
                        </div>
                    </div>
                    <button disabled type="submit" class="bg-red-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Train Pola</button>
                @endif
            </div>
            
            {{-- hasil train --}}
            <div class="container border border-dashed border-blue-400 p-4 mb-4">
                <h1 class="text-4xl text-center text-blue-600 font-bold mb-4">Hasil Train</h1>
                
                @if(session()->has('success'))
                    <div class="text-green-500 italic font-medium">
                        {{ session('success') }}
                    </div>
                @endif


                <ul class="list-disc pl-4">
                    @if(session()->has('final_result'))
                        @foreach(session('final_result') as $result)
                            <li class="text-base font-medium">{{$result}}</li>
                        @endforeach
                    @endif
                </ul>

                {{-- @dump(!$is_valid_model) --}}
                @if($is_valid_model)
                    <p class="text-base font-medium text-green-300">Data valid. Dapat disimpan</p>         
                    <form action="/save-model" method="POST">
                        @csrf
                        @forelse($locked_pola_id as $id)
                            <input type="hidden" name="pola_ids[]" value="{{ $id }}">
                        @empty
                            <!-- Jika array kosong -->
                        @endforelse
                        <button class="bg-green-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Simpan model</button>
                    </form>           
                @else
                    <button disabled class="bg-red-600 px-8 py-2 mt-4 text-xl text-white rounded-md">Simpan model</button>
                @endif

            </div>

            {{-- perhitungan --}}
            @isset($detail_hitung)    
                <div class="container border border-dashed border-blue-400 p-4 mb-4">
                    <div class="overflow-x-auto border-collapse">
                        <table>
                            <thead>
                                <tr class="bg-slate-400">
                                    @foreach (['x1', 'x2', 'x3', 'x4', 'x5', 'x6', 'x7', 'x8', 'x9', 'bias', 'target', 'del w1', 'del w2', 'del w3', 'del w4', 'del w5', 'del w6', 'del w7', 'del w8', 'del w9', 'del bias', 'W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'B', 'NET', 'f(n)', 'is Valid'] as $header)
                                        <td class="b-style">{{ $header }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($delta); $i++)
                                    <tr>
                                        @foreach ($collect_input[$i] as $item)
                                            <td class="b-style">{{$item}}</td>
                                        @endforeach
                                        <td class="b-style">{{end($delta[$i])}}</td>
                                        <td class="b-style">{{$target_array[$i]}}</td>
                                        
                                        @foreach ($delta[$i] as $item)
                                            <td class="b-style">{{$item}}</td>
                                        @endforeach

                                        @foreach ($weight[$i] as $item)
                                            <td class="b-style">{{$item}}</td>
                                        @endforeach
                                        <td class="b-style">{{$net[$i]}}</td>
                                        <td class="b-style">{{$net_result[$i]}}</td>
                                        <td class="b-style">{{$final_result[$i]}}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            @endisset
        </div>
    </body>
</html>
