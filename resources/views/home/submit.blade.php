<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Bukti Bayar | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{asset('assets/scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/flowbite.min.css')}}" />
    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.output.css')
    <script src="{{asset('assets/alpine.min.js')}}" defer></script>
    <script src="{{asset('assets/init-alpine.js')}}"></script>
    <script src="{{asset('assets/datepicker.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
      input[type=file]::file-selector-button {
        background-color: #9AAB89;
      }

      input[type=file]::file-selector-button:hover {
        background-color: #B5C7A3;
      }
    </style>
  </head>
  <body class="bg-gray-50">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col flex-1">            
        <!--header-->
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
            <div class="flex justify-center">
              <div class="">
                  <div class="flex items-center">
                      <img class="float-left  w-6 h-6" src="{{asset('images/logo emin.png')}}"> <span class="ml-3 text-primary-font" style="font-family: 'Podkova', serif;">Emin</span>
                  </div>
              </div>
            </div>
            <div  class="flec">
              <a href="" class="text-primary-normal  font-medium rounded-full text-sm px-3 py-1 text-center" aria-current="page">Tentang</a>
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=dinihq%40pcr.ac.id&authuser=0">
              <button type="button" class="text-white bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-green  font-medium rounded-full text-sm px-3 py-1 text-center mr-3 md:mr-0">
                  Hubungi kami
              </button>
              </a>
            </div>
        </div>
        </header>
        <!--main-->
        <main class="scrollbar h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
            
              <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                  <div class="bg-primary-normal w-60 h-8 shadow-md rounded-r-3xl"><span class="ml-4 text-primary-white">Upload Bukti Bayar</span></div>
              </h4>

              @if(Session::has('alert'))              
              <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">{{Session::get('alert')}}</span>
                </div>
              </div>
              @endif
                              
              <div class="w-full px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                      <span class="font-semibold">Mohon isi data bukti pembayaran dengan baik dan benar! Jika terjadi masalah tekan menu “Hubungi Kami” untuk memperoleh
                      informasi lebih lanjut.
                      </span>
                    </br>
                  </p>
              </div>

              <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                  <form action="/submit/{{$id_invoice}}" method="post" enctype="multipart/form-data" >
                      @csrf
                      <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">No Invoice</span>
                        <input readonly type="text" name="id_invoice" value="{{str_pad(substr($id_invoice, 0, 4), 4, '0', STR_PAD_LEFT).'/INV/JKT/PCR/2022'}}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary-hover focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                    </label>

                      <label class="block text-sm mt-4">
                          <span class="text-gray-700 dark:text-gray-400">Nama Pengirim</span>
                          <input type="text" name="nama_pengirim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary-hover focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Misal: Amang Sudarsono">
                      </label>

                      <label class="block text-sm mt-4">
                      <span class="text-gray-700 dark:text-gray-400">Upload Bukti Pembayaran</span>
                      <input type="file" name="file_upload" class="block text-sm mt-1 text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-primary-normal
                      "/>
                      </label>

                      <label class="block text-sm mt-4">
                            <span class="text-gray-700 dark:text-gray-400">Tanggal Transfer</span>
                            <div class="relative">
                              <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="#9AAB89" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                              </div>
                              <input datepicker datepicker-buttons datepicker-autohide datepicker-format="yyyy/mm/dd" type="text" name="tgl_bayar" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary-hover focus:outline-none pl-10 p-2.5 focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="yyyy/mm/dd">
                            </div>
                        </label>

                      <div class="mt-4">
                      <a href="/submit">
                        <button type="button" class="items-center justify-between px-4 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg active:bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">
                            Batal
                        </button>
                      </a>
                      <button type="submit" class="ml-4 text-primary-normal hover:text-primary-white border-2 border-primatext-primary-normal hover:bg-primary-hover focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-primary-normal dark:hover:text-primary-white dark:hover:bg-green-600 dark:focus:ring-primary-hover">
                          Kirim
                      </button>
                      </div>
                  </form>
              </div>
            </h2>
          </div>
        </main>

    </div>
    </div>
    </body>
    </html>