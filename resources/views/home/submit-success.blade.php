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
                      <img class="float-left  w-6 h-6" src="{{asset('images/logo emin.png')}}"> <span class="ml-3 text-primary-font" style="font-family: 'Podkova', serif;">Eminh</span>
                  </div>
              </div>
            </div>
            <div  class="flec">
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=dinihq%40pcr.ac.id&authuser=0" class="text-primary-normal  font-medium rounded-full text-sm px-3 py-1 text-center" aria-current="page">Tentang</a>
              <button type="button" class="text-white bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-green  font-medium rounded-full text-sm px-3 py-1 text-center mr-3 md:mr-0">
                  Hubungi kami
              </button>
            </div>
        </div>
        </header>
        <!--main-->
        <main class="h-full pb-16 overflow-hidden">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-64 mx-auto grid">
            <h2
              class="my-6 font-semibold text-gray-700 dark:text-gray-200"
            >
              <div class="px-4 py-3 mb-8 mt-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="my-12 mx-auto grid content-center">
                  <img src="/images/success.png" class="mx-auto" width="250px" />
                  <br/>
                  <p class="mx-auto font-bold">Bukti pembayaran berhasil dikirim!</p>
                  <br/>
                  <p class="mx-auto text-middle">LoA dan Kuintansi akan dikirimkan melalui email. Cek email Anda secara regular.</p>
                </div>
              </div>
            </h2>
          </div>
        </main>

    </div>
    </div>
    </body>
    </html>