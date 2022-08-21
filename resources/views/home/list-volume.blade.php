<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Volume | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.output.css')
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="assets/init-alpine.js"></script>
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
                <form action="cari-list-volume" method="get" class="relative flex items-cente4r">
                  <input
                    id="input-volume"
                    name="cari"
                    class="w-full pl-4 pr-2 text-sm placeholder-gray-600 bg-gray-100 focus:outline-none focus:shadow-outline-green border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-primary-normal  form-input"
                    type="text"
                    placeholder="Cari"
                    aria-label="Search"
                  />
                  <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:shadow-outline-green dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                  </button>
                </form>
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
                <button
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleTheme"
                  aria-label="Toggle color mode"
                >
                  <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="#707275"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="#707275"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
              <!-- Notifications menu -->
              <li class="relative">
                <button
                  class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleNotificationsMenu"
                  @keydown.escape="closeNotificationsMenu"
                  aria-label="Notifications"
                  aria-haspopup="true"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="#707275"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                    ></path>
                  </svg>
                  <!-- Notification badge -->
                  <span
                    aria-hidden="true"
                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-primary-font border-2 border-white rounded-full dark:border-gray-800"
                  ></span>
                </button>
                <template x-if="isNotificationsMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeNotificationsMenu"
                    @keydown.escape="closeNotificationsMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="http://localhost/scm/views/pages/lihat_notifikasi.php"
                      >
                        <span>Pending Order</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                        6
                        </span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="http://localhost/scm/views/pages/dashboard.php"
                      >
                        <span>Sales</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                        5
                        </span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none flex items-center"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-6 h-6 rounded-full"
                    src="{{asset('images/user-logo.png')}}"
                    alt=""
                    aria-hidden="true"
                  />
                  <div class="text-primary-font flex-col ml-2">
                    <div class="text-middle">{{Session::get('nama_editor')}}</div>
                    <div class="text-small mt-1">{{Session::get('email_editor')}}
                    <span class="bg-primary-hover text-primary-white px-0.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{Session::get('role')}}</span></div>
</div>
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    
                    <li class="flex">
                      <a href="/logout"
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Keluar</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
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
                    List Volume
                    </h4>
                    <div class="mb-4">
                    <a href="/tambah-volume">
                      <button class="items-center justify-between px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg active:bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-purple">
                        Tambah Volume
                        <span class="ml-2" aria-hidden="true">+</span>
                      </button>
                      @if(\Session::has('alert-success'))              
                        <div class="flex mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Info</span>
                          <div>
                            <span class="font-medium">{{Session::get('alert-success')}}</span>
                          </div>
                        </div>
                      @endif
                    </a>
                    </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap" id="table-bank">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Nama Bank</th>
                      <th class="px-4 py-3">Tahun Volume</th>
                      <th class="px-4 py-3">No Volume</th>
                      <th class="px-4 py-3">Harga</th>
                      <th class="px-4 py-3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($volumes as $volume)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <div>
                            <p><b>{{$volume->nama_bank}}</b> - {{$volume->no_rek}}</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                      {{$volume->tahun}}
                      </td>
                      <td class="px-4 py-3 text-xs">
                      {{$volume->no_volume}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                      {{$volume->harga}}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <a href="edit-volume/{{$volume->id_volume}}">
                          <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                            <svg class="w-5 h-5" aria-hidden="true" fill="#9AAB89" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>
                          </a>
                        @if($volume->status!=1)
                          <a href="{{url('hapus-volume/'.$volume->id_volume)}}">
                          <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                            <svg class="w-5 h-5" aria-hidden="true" fill="#9AAB89" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                          </a>
                        @endif
                        </div>
                      </td>
                      <td class="px-4 py-3">
                        <label for="{{$volume->id_volume}}" class="relative cursor-pointer">
                            <input type="checkbox" {{$volume->status==true ? 'checked' : ''}} data-id_volume="{{$volume->id_volume}}" id="{{$volume->id_volume}}" class="sr-only peer toggle-class">
                            <div class="w-9 h-5 bg-primary-opacity peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-hover dark:peer-focus:ring-primary-normal rounded-full peer dark:bg- peer-checked:after:translate-x-full peer-checked:after:border-black after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-primary-white after:border-primary-hover after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-primary-normal peer-checked:bg-primary-hover"></div>
                            </label>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <script type="text/javascript">
                  $(function(){
                    $('.toggle-class').change(function(){
                      var status = $(this).prop('checked') == true ? 1 : 0;
                      var id_volume = $(this).data('id_volume');
                          $.ajax({
                            type: 'get',
                            dataType: 'json',
                            url: '{{ route('change-status-volume')}}',
                            data: {'status': status, 'id_volume': id_volume},
                            success: function(data){
                              console.log('Success')
                            }
                          });
                      window.setTimeout( function() {window.location.reload();}, 50);
                    });

                    $('#input-volume').on('keyup change', function(e){
                      var search = $(this).val();
                      var input_value = document.getElementById('input-volume').value;
                      if(e.which == 13){
                        $.ajax({
                            type: 'get',
                            dataType: 'json',
                            url: '{{ route('cari-list-volume.show')}}',
                            data: {'cari': input_value},
                            success: function(data){
                              console.log('Success')
                            }
                        });
                        window.setTimeout( function() {window.location.replace('http://127.0.0.1:8000/cari-list-volume?cari='+input_value);}, 50);
                      }
                      
                    });
                  });
                </script>
            </div>
            </div>
              <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                <span class="flex items-center col-span-3">
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      @if(($volumes->currentPage())!=1)
                        <li>
                      <a href="{{$volumes->previousPageUrl()}}">
                        <button
                          class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none"
                          aria-label="Previous"
                        >
                          <svg
                            class="w-4 h-4 fill-current"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                        </a>
                      </li>
                      <li>
                        <a href="http://127.0.0.1:8000/list-volume?page=1">
                        <button class="px-3 py-1 rounded-md focus:outline-none hover:text-primary-normal">
                          Pertama
                        </button>
                        </a>
                      </li>
                      <li>
                      @endif
                      
                      <li>
                        <button disabled class="px-3 py-1 text-white transition-colors duration-150 bg-primary-normal border border-r-0 border-primary-hover rounded-md focus:outline-none focus:shadow-outline-purple">
                        {{$volumes->currentPage()}}
                        </button>
                      </li>

                      @if(($volumes->currentPage())!=($volumes->lastPage()) and ($volumes->lastPage() > 1))
                      <li>
                        <a href="list-volume?page={{$volumes->lastPage()}}">
                        <button class="px-3 py-1 rounded-md focus:outline-none hover:text-primary-normal">
                       Terakhir
                        </button>
                        </a>
                      </li>
                        <li>
                      <a href="{{$volumes->nextPageUrl()}}">
                        <button
                          class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none"
                          aria-label="Previous"
                        >
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                          </svg>
                        </button>
                        </a>
                      </li>
                      @else
                      <li disabled class="invisible">
                        <a href="list-volume?page={{$volumes->lastPage()}}">
                        <button class="px-3 py-1 rounded-md focus:outline-none hover:text-primary-normal">
                       Terakhir
                        </button>
                        </a>
                      </li>
                        <li disabled class="invisible">
                      <a href="{{$volumes->nextPageUrl()}}">
                        <button
                          class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none"
                          aria-label="Previous"
                        >
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                          </svg>
                        </button>
                        </a>
                      </li>                      
                      @endif
                    </ul>
                  </nav>
                </span>
              </div>
            </div>
@endsection