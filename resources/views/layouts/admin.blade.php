<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ theme: localStorage.getItem('theme'),
                theme_icon : localStorage.getItem('theme-icon')
              } "
      x-init="
        $watch('theme', val => {
           if (val == 'dark' || val == 'light'){
                localStorage.setItem('theme', val)
           }else{
                localStorage.removeItem('theme')
                theme = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
           }
        });
        $watch('theme_icon', val => {
           localStorage.setItem('theme-icon', val)
      });
      "
      :class="theme ? theme : ''">
<head>
    @include("includes._meta")

    @if(isset($htmlTitle))
        <title>{{$htmlTitle}}</title>
    @else
        <title>{{config('setting.app_name.value') ?? config('app.name')}}</title>
    @endif

    @stack("stylesBefore")

    @include("includes._google-fonts")
    {{--3rd party css on base css--}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    {{--app tailwind css on app.css--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--uicon--}}
    <link rel="stylesheet" href="{{ asset('vendor/uicons/css/uicons-regular-rounded.css') }}">

    @livewireStyles

    @stack("styles")
    @stack("scriptsBefore")

    <script data-turbolinks-eval="false" data-turbo-eval="false" defer
            src="{{ asset('vendor/alpine/alpine.js') }}"></script>

    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('js/admin.js') }}"></script>

    {{--    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('js/turbolinks.js') }}"></script>--}}

</head>
<body class="bg-gray-200 dark:bg-gray-900 dark:text-gray-400 text-gray-100 flex text-sm font-body antialiased"
      x-data="{showSidebar : true}">

<x-ui.sidebar></x-ui.sidebar>

<div :class="showSidebar ? 'lg:ml-60' : ''"
    class="w-full flex flex-col h-screen overflow-y-hidden">

    <x-ui.mobile-header></x-ui.mobile-header>
    <x-ui.header></x-ui.header>

    <div class="w-full overflow-x-hidden flex flex-col" id="main-content">
        {{ $slot }}

        <footer class="flex justify-end">
            <small class="text-xs font-bold my-5 mx-5 dark:text-gray-300 text-gray-700">
                <i class="fa fa-copyright"></i> {{date('Y')}} {{ config('setting.app_name.value') }}
            </small>
        </footer>
    </div>
</div>

@livewireScripts
<script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('js/admin_after.js') }}"></script>

@stack("scripts")
@stack("stylesAfter")


</body>
</html>
