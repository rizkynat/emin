<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Review | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
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
                <form action="/cari-artikel" method="get" class="relative flex items-cente4r">
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
        <main class="h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >

            <!--main-->
            <h4
                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
                    >
                    <div class="bg-primary-normal w-60 h-8 shadow-md rounded-r-3xl"><span class="ml-4 text-primary-white">List Review</span></div>
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
                    <div class="w-full px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Judul Artikel  :</span> <span class="bg-green-100 text-green-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"> {{$reviews[0]->judul_artikel}}</span></br>
                        </p>
                        <p class="text-sm text-gray-600 mt-2 dark:text-gray-400">
                            <span class="font-semibold">Nama Penulis:</span> <span class="bg-green-100 text-green-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{$reviews[0]->nama_penulis}}</span>
                        </p>
                    </div>
            <div class="w-full overflow-hidden mt-4 rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap" id="table-bank">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Nama Reviewer</th>
                      <th class="px-4 py-3">Catatan</th>
                      <th class="px-4 py-3">Tanggal Review</th>
                      <th class="px-4 py-3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($reviews as $review)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                      {{$review->nama_reviewer}}
                      </td>
                      <td class="px-4 py-3 text-xs">
                    @php($accepted = FALSE)
                        @if($review->catatan=='Revisi')
                          <span class="rounded-xl py-1 px-3 text-primary-warning font-medium" style="background-color:rgba(254, 62, 65, 0.2);">{{$review->catatan}}</span>
                        @elseif($review->catatan=='Re-Submit For Review')
                          <span class="rounded-xl py-1 px-3 text-primary-insert font-medium" style="background-color:rgba(255, 90, 31, 0.2);">{{$review->catatan}}</span>
                        @else
                          @php($accepted=TRUE)
                          <span class="rounded-xl py-1 px-3 text-primary-success font-medium" style="background-color:rgba(62, 196, 122, 0.2);">{{$review->catatan}}</span>
                        @endif
                      </td>
                      <td class="px-4 py-3 text-sm  justify-between">
                      <p class="truncate">{{$review->tanggal}}</p>
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          @if($accepted==TRUE)
                          <a style="pointer-events: none" href="{{url('edit-review/'.$review->id_review.'/'.$review->id_artikel)}}">
                          <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-insert/20 border border-transparent rounded-md active:bg-primary-insert/70 hover:bg-primary-insert/70 focus:outline-none focus:shadow-outline-green" aria-label="Edit">
                            <svg style="width:15px; height:15px;" class="" aria-hidden="true" fill="#ffffff" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>
                          </a>
                          @else
                          <a href="{{url('edit-review/'.$review->id_review.'/'.$review->id_artikel)}}">
                          <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-insert border border-transparent rounded-md active:bg-primary-insert/70 hover:bg-primary-insert/70 focus:outline-none focus:shadow-outline-green" aria-label="Edit">
                            <svg style="width:15px; height:15px;" class="" aria-hidden="true" fill="#ffffff" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>
                          </a>
                          @endif
                          <button class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-overview border border-transparent rounded-md active:bg-primary-overview/70 hover:bg-primary-overview/70 focus:outline-none focus:shadow-outline-green" aria-label="History" data-modal-toggle="extralarge-modal{{$review->id_review}}">
                            <img src="{{asset('images/info.png')}}" width="15px">
                          </button>
                          <div id="extralarge-modal{{$review->id_review}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                          <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
                              <!-- Modal content -->
                              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                  <!-- Modal header -->
                                  <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                                      <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                          Log History Review
                                      </h3>
                                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="extralarge-modal{{$review->id_review}}">
                                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                          <span class="sr-only">Close modal</span>
                                      </button>
                                  </div>
                                  <!-- Modal body -->
                                  <div class="p-6 space-y-6">
                                  <div class="min-w-0 p-4 border-primary-normal  rounded-lg shadow-xs dark:bg-gray-800">
                                  <table class="w-full whitespace-no-wrap">
                                    <thead>
                                      <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Log History</th>
                                        <th class="px-4 py-3">Tanggal</th>
                                      </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">                                      
                                    @foreach($historys_review as $history_review)
                                    @if($review->id_review == $history_review->id_review)
                                      <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                          <div class="flex items-center text-sm">
                                          @if($history_review->isi_history == 'Re-Submit For Review')
                                          <span class="rounded-xl py-1 px-3 text-primary-insert font-medium" style="background-color:rgba(255, 90, 31, 0.2);">Re-Submit For Review</span>
                                          @elseif($history_review->isi_history == 'Revisi')
                                          <span class="rounded-xl py-1 px-3 text-primary-warning font-medium" style="background-color:rgba(254, 62, 65, 0.2);">Revisi</span>
                                          @elseif($history_review->isi_history == 'Accepted')
                                          <span class="rounded-xl py-1 px-3 text-primary-success font-medium" style="background-color:rgba(62, 196, 122, 0.2);">Accepted</span>
                                          @endif
                                          </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{$history_review->tgl_history}}
                                        </td>    
                                    @endif
                                    @endforeach
                                      </tr>
                                    </tbody>
                                  </table>
                                  </div>
                                  </div>
                                  <!-- Modal footer -->
                                  <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                      <button data-modal-toggle="extralarge-modal{{$review->id_review}}" type="button" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-primary-hover hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">Tutup</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                        </div>
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