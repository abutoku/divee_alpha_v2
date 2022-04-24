<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    <main class="mt-12 p-4">
        <form action="{{ route('master.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>ショップ名<span class="ml-2 text-xs text-red-600">※必須</span></p>
            <input type="text" name="shop_name">

            <p>ロゴ<span class="ml-2 text-xs text-red-600">※必須</span></p>
            <input type="file" name="logo_image">

            <p>カバー画像</p>
            <input type="file" name="cover_image">

            <p>WebサイトURL</p>
            <input type="text" name="url"><br>

            <x-button class="mt-6">登録</x-button>
        </form>
    </main>

    <a href="{{ route('dashboard') }}">
        <x-button class="ml-4">戻る</x-button>
    </a>
    <!-- jquery,main.js 読み込み -->
    <x-readjs />

    @livewireScripts
</body>

</html>
