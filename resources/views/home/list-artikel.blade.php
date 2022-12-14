<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Artikel | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{asset('assets/scrollbar.css')}}" />
    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.output.css')
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('assets/init-alpine.js')}}"></script>
    <script src="{{asset('assets/focus-trap.js')}}"></script>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
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
                <form action="/cari-artikel" method="get" class="relative">
                  <div class="flex items-center">
                  <input
                    id="input-artikel"
                    name="cari"
                    class="w-full pl-4 pr-2 text-sm placeholder-gray-600 bg-gray-100 focus:outline-none focus:shadow-outline-green border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-primary-normal  form-input"
                    type="text"
                    tabindex="99"
                    placeholder="Cari artikel"
                    aria-label="Search"
                  />
                  <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-primary-hover focus:ring-4 focus:outline-none focus:shadow-outline-green dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                  </button>
                  </div>
                </form>
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
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
                    <div class="bg-primary-normal w-60 h-8 shadow-md rounded-r-3xl"><span class="ml-4 text-primary-white">List Artikel</span></div>
                    </h4>
                    <div class="mb-4">
                    <div class="flex items-center">
                      <a href="/tambah-artikel">
                          <button class="items-center justify-between px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg active:bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">
                            Tambah Artikel
                            <span class="ml-2" aria-hidden="true">+</span>
                          </button>
                          </a>
                          <div>
                          <select id="filter_status" name="filter_status" class="p-2 ml-2 w-full text-sm font-medium text-primary-normal rounded-lg border-2 border-primary-normal focus:ring-primary-hover focus:border-primary-hover">
                          <option selected>Pilih status</option>  
                          @foreach($statuss as $status)
                          <option value="{{$status->kode_status}}">{{$status->keterangan_status}}</option>
                          @endforeach
                          </select>
                          </div>
                          <div>
                          <select id="filter_volume" name="filter_volume" class="p-2 ml-4 w-32 text-sm font-medium text-primary-normal rounded-lg border-2 border-primary-normal focus:ring-primary-hover focus:border-primary-hover">
                          <option selected>Pilih volume</option>  
                          @foreach($volumes as $volume)
                          <option value="{{$volume->no_volume}}">{{$volume->no_volume}}</option>
                          @endforeach
                          </select>
                          </div>
                          <a href="/excel-artikel">
                          <button type="submit" class="p-2 ml-4 bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-primary-hover focus:ring-4 focus:outline-none focus:shadow-outline-green">
                            <img src="{{asset('images/excel.png')}}" width="15"/>
                          </button>
                          </a>
                          <a href="/csv-artikel">
                          <button type="submit" class="p-2 ml-2 bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-primary-hover focus:ring-4 focus:outline-none focus:shadow-outline-green">
                            <img src="{{asset('images/csv.png')}}" width="15"/>
                          </button>
                          </a>
                      </div>
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
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="scrollbar w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap" id="table-bank">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Detail Artikel</th>
                      <th class="px-4 py-3">Volume</th>
                      <th class="px-4 py-3">Nama Penulis</th>
                      <th class="px-4 py-3">Judul Artikel</th>
                      <th class="px-4 py-3">Aksi</th>
                      <th class="px-4 py-3">Hasil Review</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Next</th>
                      <th class="px-4 py-3">File</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($artikels as $artikel)
                    <tr class="text-gray-700 dark:text-gray-400">
                      
                      <td class="px-4 py-3">
                        <div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
                        <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-hover hover:bg-primary-hover focus:outline-none focus:shadow-outline-green" type="button" data-modal-toggle="extralarge-modal{{$artikel->id_artikel}}">
                          <img src="{{asset('images/direct.png')}}" width="15px">
                        </button>
                        </div>
                        <div id="extralarge-modal{{$artikel->id_artikel}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                          <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
                              <!-- Modal content -->
                              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                  <!-- Modal header -->
                                  <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                                      <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                          Detail Artikel
                                      </h3>
                                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="extralarge-modal{{$artikel->id_artikel}}">
                                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                          <span class="sr-only">Close modal</span>
                                      </button>
                                  </div>
                                  <!-- Modal body -->
                                  <div class="p-6 space-y-6">
                                  <div class="min-w-0 p-4 border-primary-normal  rounded-lg shadow-xs dark:bg-gray-800">
                                    Id Artikel       </br><span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$artikel->id_artikel}}</span></br>
                                    Judul Artikel    </br><span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$artikel->judul_artikel}}</span></br>
                                    Nama Penulis     </br><span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$artikel->nama_penulis}}</span></br>
                                    Email Penulis    </br><span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$artikel->email_penulis}}</span></br>
                                    Volume           </br><span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$artikel->no_volume}}, {{$artikel->tahun}}</span></br>
                                    Asal Instansi    </br><span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$artikel->instansi}}</span>
                                  </div>
                                  </div>
                                  <!-- Modal footer -->
                                  <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                      <button data-modal-toggle="extralarge-modal{{$artikel->id_artikel}}" type="button" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-primary-hover hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">Tutup</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                      <p style="width:110px;" class="truncate">{{$artikel->no_volume}}, {{$artikel->tahun}}</p>
                      </td>
                      <td class="px-4 py-3 text-sm">
                      <p style="width:120px;" class="truncate">{{$artikel->nama_penulis}}</p>
                      </td>
                      <td class="px-4 py-3 text-sm  justify-between">
                      <p style="width:280px;" class="truncate">{{$artikel->judul_artikel}}</p>
                      </td>

                      @php($data=FALSE)
                          @foreach($checkWPS as $checkWP)
                          @if($checkWP != NULL)
                            @if($artikel->id_artikel==$checkWP->id_artikel)
                              @php($data=TRUE)
                            @endif
                            @endif
                          @endforeach
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          @if($data==TRUE)
                          <a style="pointer-events: none" href="{{url('/edit-artikel/'.$artikel->id_artikel)}}">
                          <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal/20 border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Edit">
                            <svg style="width:15px; height:15px;" class="" aria-hidden="true" fill="#ffffff" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>
                          </a>

                          <a style="pointer-events: none" href="{{url('/hapus-artikel/'.$artikel->id_artikel)}}">
                          <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal/20 border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Delete">
                            <svg style="width:15px; height:15px;" aria-hidden="true" fill="#ffffff" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                          </a>
                          @else
                          <a href="{{url('/edit-artikel/'.$artikel->id_artikel)}}">
                          <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Edit">
                            <svg style="width:15px; height:15px;" class="" aria-hidden="true" fill="#ffffff" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>
                          </a>

                          <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" data-modal-toggle="popup-modal{{$artikel->id_artikel}}" aria-label="Delete">
                            <svg style="width:15px; height:15px;" aria-hidden="true" fill="#ffffff" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                          </button>

                          <div id="popup-modal{{$artikel->id_artikel}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal{{$artikel->id_artikel}}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-6 text-center">
                                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin menghapus?</h3>
                                        <a href="{{url('/hapus-artikel/'.$artikel->id_artikel)}}">
                                        <button data-modal-toggle="popup-modal{{$artikel->id_artikel}}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, tentu
                                        </button>
                                        </a>
                                        <button data-modal-toggle="popup-modal{{$artikel->id_artikel}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, batal</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                          @endif
                        </div>
                      </td>
                      @php($accept=0)
                          @foreach($checkReviews as $checkReview)
                            @if($artikel->id_artikel==$checkReview->id_artikel)
                              @php($accept=$checkReview->jumlah)
                            @endif
                          @endforeach
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          @if($accept==2 or $accept==1)
                            <a style="pointer-events: none" href="{{url('/tambah-review/'.$artikel->id_artikel)}}">
                              <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal/20 border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Insert">
                                <img src="{{asset('images/insert.png')}}" width="15px">
                              </button>
                            </a>

                            <a class="ml-4" href="{{url('/list-review/'.$artikel->id_artikel)}}">
                              <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Overview">
                                <img src="{{asset('images/overview.png')}}" width="15px">
                              </button>
                            </a>
                          @else
                            <a href="{{url('/tambah-review/'.$artikel->id_artikel)}}">
                            <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Insert">
                            <img src="{{asset('images/insert.png')}}" width="15px">
                            </button>
                            </a>

                            <a style="pointer-events: none" class="ml-4" href="{{url('/list-review/'.$artikel->id_artikel)}}">
                              <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal/20 border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="Overview">
                                <img src="{{asset('images/overview.png')}}" width="15px">
                              </button>
                            </a>
                          @endif                          
                        </div>
                      </td>
                      @foreach($kode_statuss as $kode_status)
                        @if($artikel->id_artikel==$kode_status->id_artikel)
                      <td class="px-4 py-3">
                        <div class="block items-center text-sm">
                          @if($kode_status->kode_status != 'p')
                        <span class="bg-primary-purple/10 text-primary-purple tracking-wider text-06rem font-bold px-2.5 py-0.5 rounded-lg dark:bg-green-200 dark:text-green-900">
                          {{$kode_status->keterangan_status}}
                        </span>
                        <div class="flex mt-2">
                          <a href="{{url('/tambah-artstatus/'.$artikel->id_artikel)}}">
                              <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="InsertStatus">
                              <img src="{{asset('images/insert.png')}}" width="15px">
                              </button>
                              </a>
                          
                              <a class="" href="{{url('/list-artstatus/'.$artikel->id_artikel)}}">
                              <button class="ml-4 px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="OverviewStatus">
                                <img src="{{asset('images/overview.png')}}" width="15px">
                              </button>
                            </a>
                          </div>
                          @else
                        <span class="bg-primary-success/10 text-primary-success/70 text-06rem font-bold px-2.5 py-0.5 rounded-lg dark:bg-green-200 dark:text-green-900">
                          {{$kode_status->keterangan_status}}
                        </span>
                        <div class="flex mt-2">
                          <a style="pointer-events: none" href="{{url('/tambah-artstatus/'.$artikel->id_artikel)}}">
                              <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal/20 border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="InsertStatus">
                              <img src="{{asset('images/insert.png')}}" width="15px">
                              </button>
                              </a>
                          
                              <a class="" href="{{url('/list-artstatus/'.$artikel->id_artikel)}}">
                              <button class="ml-4 px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-md active:bg-primary-normal/70 hover:bg-primary-normal/70 focus:outline-none focus:shadow-outline-green" aria-label="OverviewStatus">
                                <img src="{{asset('images/overview.png')}}" width="15px">
                              </button>
                            </a>
                          </div>
                          @endif
                        </div>
                      </td>
                      <td class="px-4 py-3">
                        <div class="block items-center text-xs">
                          @if($kode_status->kode_status=='wr')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Section Editor set reviewer
                          </span>
                          @elseif($kode_status->kode_status=='ir')
                          <ul class="list-disc marker:text-primary-pink">
                          <li>
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Jika ada revisi, kembalikan ke author
                          </span>
                          </li>
                          <li class="mt-1">
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Jika tidak revision done
                          </span>
                          </li>
                          </ul>
                          @elseif($kode_status->kode_status=='sa')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Menunggu revisi dari author
                          </span>
                          @elseif($kode_status->kode_status=='rd')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Check plagiarisme
                          </span>
                          @elseif($kode_status->kode_status=='pd')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Copy editor send author(need revision)
                          </span>
                          @elseif($kode_status->kode_status=='wpr')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Copy editor proses
                          </span>
                          @elseif($kode_status->kode_status=='pac')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Copy editor done
                          </span>
                          @elseif($kode_status->kode_status=='ced')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Bendahara issue invoice
                          </span>
                          @elseif($kode_status->kode_status=='ii')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Waiting payment
                          </span>
                          @elseif($kode_status->kode_status=='wp')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Bendahara approve payment
                          </span>
                          @elseif($kode_status->kode_status=='plri')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Layout editor publish
                          </span>
                          @elseif($kode_status->kode_status=='p')
                          <span class="bg-primary-pink/10 text-primary-pink tracking-wider text-06rem font-bold mr-2 px-2.5 py-0.5 mb-2 rounded-lg dark:bg-green-200 dark:text-green-900">
                                Tidak ada
                          </span>
                          @endif
                        </div>
                      </td>
                      <td class="px-4 py-3 text-xs">
                      @foreach($files as $file)
                      @if($artikel->id_artikel == $file->id_artikel)
                      @if($kode_status->kode_status == 'ii')
                      <a class="text-primary-normal font-semibold underline" href="{{asset('download-invoice/'.$file->id_invoice)}}">Invoice</a>
                      @elseif($kode_status->kode_status == 'plri')
                      <a target="e_blank" class="text-primary-normal font-semibold underline" href="{{asset('download-loa/'.$file->id_loa)}}">LOA</a>
                      <a target="e_blank" class="text-primary-normal font-semibold underline" href="{{asset('download-kwitansi/'.$file->id_kwitansi)}}">Kwitansi</a>
                      <a target="e_blank" class="text-primary-normal font-semibold underline" href="{{asset('images/bukti_bayar/'.$file->bukti_bayar)}}">Bukti Bayar</a>
                      @else
                      <span class="mr-10">---</span>
                      @endif
                      @endif
                      @endforeach
                      </td>
                      @endif
                      @endforeach

                    </tr>
                    @endforeach
                  </tbody>
                </table>
                
                <script type="text/javascript">
                   $(document).ready(function(){
                    $('#filter_status').change(function(){
                      var kode_status = $(this).val();
                      console.log(kode_status);
                      window.location.assign('/filter-artikel/'+kode_status);
                    });
                   });

                   $(document).ready(function(){
                    $('#filter_volume').change(function(){
                      var kode_status = $(this).val();
                      console.log(kode_status);
                      window.location.assign('/filter-artikel/'+kode_status);
                    });
                   });

                  $(function(){
                    $(document).on("keypress", function(e) {
                      if(e.which == 47){
                        $("#input-artikel").focus();
                      }
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
                      Showing {{$artikels->firstItem()}} - {{$artikels->lastItem()}} of {{$artikels->total()}} results
                    </span>
                    <span class="col-span-2"></span>
                    <div class="flex col-span-4 sm:mt-auto sm:justify-end mt-2">
                      <!-- Buttons -->
                      <a href="{{$artikels->previousPageUrl()}}">
                      <button class="inline-flex items-center py-2 px-4 text-sm font-medium  leading-5 text-white  duration-150 bg-primary-normal rounded-l  hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">
                          <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                          Prev
                      </button>
                      </a>
                      <a href="{{$artikels->nextPageUrl()}}">
                      <button class="inline-flex items-center py-2 px-4 text-sm font-medium text-white  bg-primary-normal rounded-r hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">
                          Next
                          <svg aria-hidden="true" class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      </button>
                      </a>
                    </div>
                </div>
            </div>
@endsection