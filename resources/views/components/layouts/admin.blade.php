<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Page Title' }}</title>
          @vite(['resources/css/app.css', 'resources/js/app.js'])
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
          <style>
                        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            }

            @media (min-width: 768px) {
            .gradient-form {
            height: 100vh !important;
            }
            }
            @media (min-width: 769px) {
            .gradient-custom-2 {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
            }
            }
          </style>
          @livewireStyles
    </head>
    <body>
      <div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
        <h4 class="text-white">My App</h4>
        <hr class="text-secondary">

        <ul class="nav nav-pills flex-column">

            <!-- Menu Item 1 -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>

            <!-- Menu Item 2 -->
            <li class="nav-item">
                <a href="{{ route('tasks') }}" class="nav-link text-white {{ request()->routeIs('tasks') ? 'active' : '' }}">
                    Tasks
                </a>
            </li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
      {{ $slot }}
    </div>

        </div>
        
     
        @livewireScripts
    </body>
        <!-- jQuery (Required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</html>
