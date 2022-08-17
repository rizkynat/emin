<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Bank | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.output.css')
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="assets/init-alpine.js"></script>
  </head>
  <body>
@extends('layouts.admin-master')

@section('content')
            
        <h4
            class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
                Tambah Bank
        </h4>
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="/tambah-bank" method="post">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Bank</span>
                        <input type="text" name="nama_bank" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary-hover focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="BRI">
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">No Rekening</span>
                        <input type="text" name="no_rek" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="002345678201">
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Atas Nama</span>
                        <input type="text" name="atas_nama" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="John Orge">
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                        <input type="email" name="email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="john@gmail.com">
                    </label>

                    <div class="mt-4">
                    <a href="/tambah-bank">
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