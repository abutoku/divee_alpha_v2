<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Divee</title>

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

<body class="font-body">
    {{-- 全体の背景色 --}}
    <div class="bg-paper min-h-[1000px]">

        <!-- ハンバーガーメニュー -->
        <div id="menu_contents" class="bg-paper w-[320px] min-h-[1000px] absolute p-8 z-40">
            <div>
                <!-- ユーザー名表示 -->
                <a href="{{ route('profile.show', Auth::user()->id ) }}" class="flex justify-center items-center mt-10">
                <img src="{{ Storage::url(Auth::user()->profile->profile_image) }}"
                    class="h-16 w-16 rounded-full object-cover bg-white mr-4">
                <div>{{ Auth::user()->name }}</div>
                </a>
            </div>

            <div class="mt-12">
                <ul>

                    @if(Auth::user()->profile->shop_id)
                    <a href="{{ route('profile.index') }}">
                        <li class="mb-6 pb-2 border-b">メンバー一覧</li>
                    </a>
                    @endif

                    <a href="{{ route('profile.menu') }}">
                        <li class="mb-6 pb-2 border-b">プロフィール編集</li>
                    </a>

                    <a href="{{ route('setting.index') }}">
                        <li class="mb-6 pb-2 border-b">設定</li>
                    </a>

                    <a href="#">
                        <li class="mb-6 pb-2 border-b">ヘルプ</li>
                    </a>

                    @if(Auth::user()->profile->card_rank == 'Pro')
                    <a href={{ route('back.index') }}>
                        <li class="mb-6 pb-2 border-b">管理者</li>
                    </a>
                    @endif

                </ul>
                <!-- ログアウトボタン -->
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" class="flex justify-center">
                    @csrf

                    <x-button class="w-40 h-12 flex justify-center mt-12" :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('ログアウト') }}
                    </x-button>
                </form>
            </div>
        </div>
        <!-- menu_contentsここまで -->

        <!-- ハンバーガーメニューの背景 -->
        <div id="mask" class="w-full h-full fixed bg-black bg-opacity-50 z-30">
            <!-- クローズボタン -->
            <div class="absolute left-[350px]">
                <svg class="h-12 w-12 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <polyline points="11 7 6 12 11 17" />
                    <polyline points="17 7 12 12 17 17" />
                </svg>
            </div>
        </div>

        <!-- ヘッダー部分 -->
        <header class="w-full h-14 px-6 fixed flex justify-between items-center border-b border-gray-300 bg-paper z-20">
            <!-- 画面右上に表示される場所 -->
            <div>{{ $iconLeft }}</div>
            <!-- 画面左上に表示される場所 -->
            <div>{{ $iconRight }}</div>
        </header>

        {{-- wrapper --}}
        <div class="p-6 text-divenavy">

            {{ $slot }}

        </div>
        {{-- wrapperここまで --}}
    </div>
    {{-- 全体ここまで --}}

    <!-- jquery,main.js 読み込み -->
    <x-readjs />

    @livewireScripts
</body>

</html>
