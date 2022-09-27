<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Status Artikel  | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{asset('assets/scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/flowbite.min.css')}}" />
    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.output.css')
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('assets/init-alpine.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  </head>
  <body>
  @extends('layouts.admin-master')

  @section('content')
  <!--header-->
  <div class="flex justify-center flex-1 lg:mr-32">
  <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
              <form action="/cari-artikel" method="get" class="flex items-cente4r">
                  <input
                    id="input-artikel"
                    name="cari"
                    class="w-full pl-4 pr-2 text-sm placeholder-gray-600 bg-gray-100 focus:outline-none focus:shadow-outline-green border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-primary-normal  form-input"
                    type="text"
                    placeholder="Cari artikel"
                    aria-label="Search"
                  />
                  <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-primary-hover focus:ring-4 focus:outline-none focus:shadow-outline-green dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                  </button>
                </form>
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              @include('layouts.notifikasi')
            </ul>
          </div>
        </header>
        <main class="scrollbar h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >

            <!--main-->
            <h4
                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
                    >
                    <div class="bg-primary-normal w-60 h-8 shadow-md rounded-r-3xl"><span class="ml-4 text-primary-white">List Status Artikel</span></div>
                    </h4>
                    <div class="mb-4">
                      @if(\Session::has('alert-success'))              
                        <div class="flex mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Info</span>
                          <div>
                            <span class="font-medium">{{Session::get('alert-success')}}</span>
                          </div>
                        </div>
                      @endif
                    </div>
                    <div class="w-full px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Judul Artikel  :</span> <span class="bg-green-100 text-green-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"> {{$artstatuss[0]->judul_artikel}}</span></br>
                        </p>
                        <p class="text-sm text-gray-600 mt-2 dark:text-gray-400">
                            <span class="font-semibold">Nama Penulis:</span> <span class="bg-green-100 text-green-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$artstatuss[0]->nama_penulis}}</span>
                        </p>
                    </div>
            <div class="w-full overflow-hidden mt-4 rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap" id="table-bank">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Keterangan Status</th>
                      <th class="px-4 py-3">Tanggal</th>
                      <th class="px-4 py-3">File</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($artstatuss as $artstatus)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                      {{$artstatus->keterangan_status}}
                      </td>
                      <td class="px-4 py-3 text-sm  justify-between">
                      <p class="truncate">{{$artstatus->tanggal}}</p>
                      </td>
                     
                      <td class="px-4 py-3 text-sm  justify-between">
                      <p class="truncate">
                      @if($checkInvoices[0]->jumlah != 1)
                      ---
                      @else
                      @if( $artstatus->kode_status == 'ii')
                        <a class="text-primary-normal underline" href="{{asset('download-invoice/'.$invoice[0]->id_invoice)}}">Invoice</a>
                      @elseif($artstatus->kode_status == 'plri')
                      <a target="e_blank" class="text-primary-normal underline" href="{{asset('download-loa/'.$files[0]->id_loa)}}">LOA</a>
                      <a target="e_blank" class="text-primary-normal underline" href="{{asset('download-kwitansi/'.$files[0]->id_kwitansi)}}">Kwitansi</a>
                      <a target="e_blank" class="text-primary-normal underline" href="{{asset('images/bukti_bayar/'.$files[0]->bukti_bayar)}}">Bukti Bayar</a>
                      @else
                        ---
                      @endif
                      @endif
                      </p>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            </div>
             
            </div>
            <script type="text/javascript">
                  $(function(){
                    $(document).on("keypress", function(e) {
                      if(e.which == 47){
                        $("#input-artikel").focus();
                      }
                    });
                  });
              </script>
            <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
@endsection