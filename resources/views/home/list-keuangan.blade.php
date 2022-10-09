<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Keuangan | Emin</title>
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
                class="w-full max-w-xl mx-auto focus-within:text-primary-font"
              >
                <form action="/cari-keuangan" method="get" class="relative flex items-cente4r">
                  <input
                    id="input-keuangan"
                    name="cari"
                    class="w-full pl-4 pr-2 text-sm placeholder-gray-600 bg-gray-100 focus:outline-none focus:shadow-outline-green border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-primary-normal  form-input"
                    type="text"
                    placeholder="Cari keuangan"
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
                    <div class="bg-primary-normal w-60 h-8 shadow-md rounded-r-3xl"><span class="ml-4 text-primary-white">List Keuangan</span></div>
                    </h4>
                    <div class="mb-4">
                    <div class="flex items-center">
                    <a href="/tambah-keuangan">
                      <button class="items-center justify-between px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg active:bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">
                        Tambah Keuangan
                        <span class="ml-2" aria-hidden="true">+</span>
                      </button>
                    </a>
                    <div>
                          <select id="filter_volume" name="filter_volume" class="p-2 ml-2 w-32 text-sm font-medium text-primary-normal rounded-lg border-2 border-primary-normal focus:ring-primary-hover focus:border-primary-hover">
                          <option selected>Pilih volume</option>  
                          @foreach($volumes as $volume)
                          <option value="{{$volume->no_volume}}">{{$volume->no_volume}}</option>
                          @endforeach
                          </select>
                          </div>
                    <a href="/excel-keuangan">
                          <button type="submit" class="p-2 ml-4 bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-primary-hover focus:ring-4 focus:outline-none focus:shadow-outline-green">
                            <img src="{{asset('/images/excel.png')}}" width="15"/>
                          </button>
                          </a>
                          <a href="/csv-keuangan">
                          <button type="submit" class="p-2 ml-2 bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-primary-hover focus:ring-4 focus:outline-none focus:shadow-outline-green">
                            <img src="{{asset('/images/csv.png')}}" width="15"/>
                          </button>
                          </a>
                      @if(\Session::has('alert-success'))              
                        <div class="flex mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Info</span>
                          <div>
                            <span class="font-medium">{{Session::get('alert-success')}}</span>
                          </div>
                        </div>
                      @elseif(\Session::has('alert'))              
                        <div class="flex mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Info</span>
                          <div>
                            <span class="font-medium">{{Session::get('alert')}}</span>
                          </div>
                        </div>
                      @endif
                    </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2 xl:grid-cols-4">
                      <!-- Card -->
                      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                          <img src="{{asset('images/balance.png')}}" class="w-5 h-5"/>
                        </div>
                        <div>
                          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Sisa uang
                          </p>
                          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            @if($uangKeluar[0]->nominal == NULL)
                            Rp {{number_format(sprintf( preg_replace("/[^0-9.]/", "", $uangMasuk[0]->nominal)), 0)}}
                            @elseif($uangMasuk[0]->nominal == NULL)
                            Rp {{number_format(sprintf( preg_replace("/[^0-9.]/", "", $uangKeluar[0]->nominal)), 0)}}
                            @else
                            @php($total = ($uangMasuk[0]->nominal)-($uangKeluar[0]->nominal))
                            Rp {{number_format(sprintf( preg_replace("/[^0-9.]/", "", $total)), 0)}}
                            @endif
                          </p>
                        </div>
                      </div>
                      <!-- Card -->
                      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-green-100 dark:bg-green-500">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                        <div>
                          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Uang keluar
                          </p>
                          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            @if($uangKeluar[0]->nominal == NULL)
                            Rp 0
                            @else
                            Rp {{number_format(sprintf( preg_replace("/[^0-9.]/", "", $uangKeluar[0]->nominal)), 0)}}
                            @endif
                          </p>
                        </div>
                      </div>
                      <!-- Card -->
                      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                        <div>
                          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Uang masuk
                          </p>
                          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            @if($uangMasuk[0]->nominal == NULL)
                            Rp 0
                            @else
                            Rp {{number_format(sprintf( preg_replace("/[^0-9.]/", "", $uangMasuk[0]->nominal)), 0)}}
                            @endif
                          </p>
                        </div>
                      </div>
                    </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="scrollbar w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap" id="table-bank">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Deskripsi</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Foto Kwitansi</th>
                      <th class="px-4 py-3">Nominal</th>
                      <th class="px-4 py-3">Tanggal Keuangan</th>
                      <th class="px-4 py-3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($keuangans as $keuangan)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                      {{$keuangan->deskripsi}}
                      </td>
                      <td class="px-4 py-3 text-sm  justify-between">
                      <p class="truncate">{{$keuangan->status}}</p>
                      </td>
                      <td class="px-4 py-3 text-sm">
                      <div class="flex items-center space-x-4 text-sm">
                        @if($keuangan->status == 'Uang masuk')
                        <a href="{{asset('images/bukti_bayar/'.$keuangan->foto_kwitansi)}}" target="_blank">
                            <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Insert">
                            <img src="/images/image.png" width="15px">
                            </button>
                        </a>
                        @else
                        <a href="{{asset('/images/keuangan/'.$keuangan->foto_kwitansi)}}" target="_blank">
                              <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Insert">
                                <img src="/images/image.png" width="15px">
                              </button>
                            </a>
                            @endif
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                      Rp{{number_format(sprintf( preg_replace("/[^0-9.]/", "", $keuangan->nominal)), 0)}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                      {{$keuangan->tgl_keuangan}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        @if($keuangan->status == 'Uang keluar')
                        <div class="flex items-center space-x-4 text-sm">
                          <a href="{{url('/edit-keuangan/'.$keuangan->id_keuangan)}}">
                          <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                            <svg class="w-5 h-5" aria-hidden="true" fill="#9AAB89" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>
                          </a>
                          <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" data-modal-toggle="popup-modal{{$keuangan->id_keuangan}}" aria-label="Delete">
                            <svg class="w-5 h-5" aria-hidden="true" fill="#9AAB89" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                          <div id="popup-modal{{$keuangan->id_keuangan}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal{{$keuangan->id_keuangan}}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-6 text-center">
                                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin menghapus?</h3>
                                        <a href="{{url('/hapus-keuangan/'.$keuangan->id_keuangan)}}">
                                        <button data-modal-toggle="popup-modal{{$keuangan->id_keuangan}}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, tentu
                                        </button>
                                        </a>
                                        <button data-modal-toggle="popup-modal{{$keuangan->id_keuangan}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, batal</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <script type="text/javascript">
                  $(function(){
                    $(document).on("keypress", function(e) {
                      if(e.which == 47){
                        $("#input-keuangan").focus();
                      }
                    });
                  });

                  $(document).ready(function(){
                    $('#filter_volume').change(function(){
                      var kode_status = $(this).val();
                      console.log(kode_status);
                      window.location.assign('/filter-keuangan/'+kode_status);
                    });
                   });
              </script>
            </div>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 sm:grid-cols-9"
              >
                  <!-- Help text -->
                  <span class="flex items-center col-span-3">
                    Showing {{$keuangans->firstItem()}} - {{$keuangans->lastItem()}} of {{$keuangans->total()}} results
                  </span>
                  <span class="col-span-2"></span>
                  <div class="flex col-span-4 sm:mt-auto sm:justify-end mt-2">
                    <!-- Buttons -->
                    <a href="{{$keuangans->previousPageUrl()}}">
                    <button class="inline-flex items-center py-2 px-4 text-sm font-medium  leading-5 text-white  duration-150 bg-primary-normal rounded-l  hover:bg-primary-hover focus:outline-none focus:shadow-outline-green ">
                        <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                        Prev
                    </button>
                    </a>
                    <a href="{{$keuangans->nextPageUrl()}}">
                    <button class="inline-flex items-center py-2 px-4 text-sm font-medium text-white  bg-primary-normal rounded-r hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">
                        Next
                        <svg aria-hidden="true" class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    </a>
                  </div>
              </div>
            </div>
            <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
@endsection