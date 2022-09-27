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
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    <style>
      input[type=file]::file-selector-button {
        background-color: #9AAB89;
      }

      input[type=file]::file-selector-button:hover {
        background-color: #B5C7A3;
      }
    </style>
  </head>
  <body>
@extends('layouts.admin-master')

@section('content')

  <!--header-->
  <div class="flex justify-center flex-1 lg:mr-32">
  <div
                class="w-full max-w-xl mx-auto focus-within:text-primary-font"
              >
                <form action="/cari-bayar" method="get" class="relative flex items-cente4r">
                  <input
                    id="input-bayar"
                    name="cari"
                    class="w-full pl-4 pr-2 text-sm placeholder-gray-600 bg-gray-100 focus:outline-none focus:shadow-outline-green border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-primary-normal  form-input"
                    type="text"
                    placeholder="Cari bukti bayar"
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
            <div class="bg-primary-normal w-60 h-8 shadow-md rounded-r-3xl"><span class="ml-4 text-primary-white">Upload Bukti Bayar</span></div>
        </h4>
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              @if(Session::has('alert'))              
              <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">{{Session::get('alert')}}</span>
                </div>
              </div>
              @endif
                <form action="/upload-bayar" method="post" enctype="multipart/form-data" >
                    @csrf                    
                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">No Invoice</span>
                        <select name="id_invoice" class="scrollbar block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-green dark:focus:shadow-outline-gray" multiple="">
                        @foreach ($invoices as $invoice)
                            <option value="{{$invoice->id_invoice}}">{{str_pad(substr($invoice->id_invoice, 0, 4), 4, '0', STR_PAD_LEFT).'/INV/JKT/PCR/2022'}}</option>
                        @endforeach
                        </select>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Nama Pengirim</span>
                        <input type="text" name="nama_pengirim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary-hover focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Amang Sudarsono">
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
                    <a href="/upload-bayar">
                      <button type="button" class="items-center justify-between px-4 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-normal border border-transparent rounded-lg active:bg-primary-normal hover:bg-primary-hover focus:outline-none focus:shadow-outline-green">
                          Batal
                      </button>
                    </a>
                    <button type="submit" class="ml-4 text-primary-normal hover:text-primary-white border-2 border-primatext-primary-normal hover:bg-primary-hover focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-primary-normal dark:hover:text-primary-white dark:hover:bg-green-600 dark:focus:ring-primary-hover">
                        Simpan
                    </button>
                    
                    </div>
                </form>
            </div>
            <script type="text/javascript">
                  $(function(){
                    $(document).on("keypress", function(e) {
                      if(e.which == 47){
                        $("#input-bayar").focus();
                      }
                    });
                  });
              </script>
@endsection