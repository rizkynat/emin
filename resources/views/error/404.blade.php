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
        <!--main-->
        <main class="h-full pb-16 overflow-hidden">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-64 mx-auto grid">
            <h2
              class="my-6 font-semibold text-gray-700 dark:text-gray-200"
            >
              <div class="px-4 py-3 mb-8 mt-16 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="my-12 mx-auto grid content-center">
                  <img src="/images/404.png" class="mx-auto" width="250px" />
                  <br/>
                  <p class="mx-auto font-bold">Halaman tidak ditemukan!</p>
                  <br/>
                </div>
              </div>
            </h2>
          </div>
        </main>

    </div>
    </div>
    </body>
    </html>