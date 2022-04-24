<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- tailwind_css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- css_file -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @livewireStyles
</head>
<body>
    <form method="POST" action="{{ route('logout') }}" class="flex justify-center">
        @csrf

        <x-button class="w-40 h-12 flex justify-center mt-12" :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('ログアウト') }}
        </x-button>
    </form>

    {{ $slot }}

    <!-- jquery,main.js 読み込み -->
    <x-readjs />

    @livewireScripts
</body>
</html>
