<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Review | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.output.css')
    <script src="{{asset('assets/alpine.min.js')}}" defer></script>
    <script src="{{asset('assets/init-alpine.js')}}"></script>
    <script src="{{asset('assets/datepicker.js')}}"></script>
  </head>
  <body>
@extends('layouts.admin-master')

@section('content')

  <!--header-->
  <div class="flex justify-center flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute inset-y-0 flex items-center pl-2">
                  <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="#707275"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input
                  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text"
                  placeholder="Cari"
                  aria-label="Search"
                />
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
                Edit Review
        </h4>
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              @if(\Session::has('alert'))              
              <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">{{Session::get('alert')}}</span>
                </div>
              </div>
              @endif

              
                    @if($reviews[0]->kategori=='Internal')
                    <form action="{{url('edit-review/'.$reviews[0]->id_artikel.'/'.$reviews[0]->id_review).'/Internal'}}" method="post">
                    @csrf
                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Id Review</span>
                        <input readonly type="text" value="{{$reviews[0]->id_review}}" name="id_review" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary-hover focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Vol. 7 No.1">
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Reviewer Internal</span>
                        <select name="id_reviewer_internal" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" multiple="">
                          @foreach ($data_reviews_internal as $data_review_internal)
                              @if($reviews[0]->id_reviewer==$data_review_internal->id_reviewer)
                              <option selected value="{{$reviews[0]->id_reviewer}}">{{$reviews[0]->nama_reviewer}}</option>
                              @else
                              <option value="{{$data_review_internal->id_reviewer}}">{{$data_review_internal->nama_reviewer}}</option>
                              @endif
                          @endforeach
                        </select>
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Catatan Internal</span>
                        <select name="catatan_internal" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" multiple="">
                            @if($reviews[0]->catatan=='Re-Submit For Review')
                            <option selected value="Re-Submit For Review">Re-Submit For Review</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Accepted">Accepted</option>
                            @elseif($reviews[0]->catatan=='Revisi')
                            <option value="Re-Submit For Review">Re-Submit For Review</option>
                            <option selected value="Revisi">Revisi</option>
                            <option value="Accepted">Accepted</option>
                            @else
                            <option value="Re-Submit For Review">Re-Submit For Review</option>
                            <option value="Revisi">Revisi</option>
                            <option selected value="Accepted">Accepted</option>
                            @endif
                        </select>
                    </label>

                    @elseif($reviews[0]->kategori=='Eksternal')
                    <form action="{{url('edit-review/'.$reviews[0]->id_artikel.'/'.$reviews[0]->id_review.'/Eksternal')}}" method="post">
                    @csrf
                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Id Review</span>
                        <input readonly type="text" value="{{$reviews[0]->id_review}}" name="id_review" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary-hover focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Vol. 7 No.1">
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Reviewer Eskternal</span>
                        <select name="id_reviewer_eksternal" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" multiple="">
                        @foreach ($data_reviews_eksternal as $data_review_eksternal)
                            @if($reviews[0]->id_reviewer==$data_review_eksternal->id_reviewer)
                            <option selected value="{{$reviews[0]->id_reviewer}}">{{$reviews[0]->nama_reviewer}}</option>
                            @else
                            <option value="{{$data_review_eksternal->id_reviewer}}">{{$data_review_eksternal->nama_reviewer}}</option>
                            @endif
                        @endforeach
                        </select>
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Catatan Eksternal</span>
                        <select name="catatan_eksternal" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" multiple="">
                            @if($reviews[0]->catatan=='Re-Submit For Review')
                            <option selected value="Re-Submit For Review">Re-Submit For Review</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Accepted">Accepted</option>
                            @elseif($reviews[0]->catatan=='Revisi')
                            <option value="Re-Submit For Review">Re-Submit For Review</option>
                            <option selected value="Revisi">Revisi</option>
                            <option value="Accepted">Accepted</option>
                            @else
                            <option value="Re-Submit For Review">Re-Submit For Review</option>
                            <option value="Revisi">Revisi</option>
                            <option selected value="Accepted">Accepted</option>
                            @endif
                        </select>
                    </label>
                    @endif

                    <div class="mt-4">
                    <a href="{{url('edit-review/'.$reviews[0]->id_review)}}">
                    <button type="button" class="items-center justify-between px-4 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg active:bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-purple">
                        Batal
                    </button>
                    <button type="submit" class="ml-4 text-primary-normal hover:text-primary-white border-2 border-primatext-primary-normal hover:bg-primary-hover focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-primary-normal dark:hover:text-primary-white dark:hover:bg-green-600 dark:focus:ring-primary-hover">
                        Simpan
                    </button>
                    
                    </div>
                </form>
            </div>
@endsection