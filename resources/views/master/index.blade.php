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
        <main class="ml-4 mt-4 w-full">
            @foreach($shops as $shop)
                <div class="flex justify-between bg-slate-200 mb-6 w-80">
                    <div>
                        <p>{{ $shop->shop_name }}</p>
                        <p>{{ $shop->url }}</p>
                    </div>
                    <form action="{{ route('master.destroy',$shop->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button>削除</button>
                    </form>
                </div>
            @endforeach
        </main>

        <a href="{{ route('dashboard') }}">
            <x-button class="ml-4">戻る</x-button>
        </a>
<!-- jquery,main.js 読み込み -->
<x-readjs />

@livewireScripts
</body>

</html>
