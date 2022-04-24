<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <x-hamburger />
    </x-slot>

    <x-slot name="iconRight">
        {{-- ロゴなし --}}
    </x-slot>

    {{-- ----dashboardメイン部分---- --}}

    <!-- 選択ボタン -->
    <section class="flex mt-14 mb-8 justify-center sm:justify-start">
        <div class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy bg-divenavy text-white flex justify-around">
            HOME</div>
        <a href="{{ route('buddy.index') }}" class="rounded-2xl py-1 w-[200px] border-2 border-divenavy flex justify-around mr-2 relative">
            MESSAGE
            @if($notice >= 1)
            <span class="absolute top-0 right-0 flex h-5 w-5 ">
                <span class="animate-ping absolute inline-flex h-5 w-5 rounded-full bg-pink-400 opacity-75"></span>
                <span class="relative  rounded-full h-5 w-5 bg-pink-500 flex justify-center items-center">
                    <p class="text-white text-xs">{{ $notice }}</p>
                </span>
            </span>
            @endif
        </a>
    </section>

    <section class="flex justify-around">
            <a  href="{{ route('profile.show', Auth::user()->id ) }}" class="flex justify-between bg-white drop-shadow-md rounded-lg sm:hidden p-2 mb-6 w-11/12">
                <div class="flex justify-center items-center">
                    <img src="{{ Storage::url(Auth::user()->profile->profile_image) }}"
                        class="h-12 w-12 mr-2 sm:h-48 sm:w-48 mb-2 rounded-full object-cover bg-white border-2 border-paper">
                    <p class="text-xl mr-8"><b>{{ Auth::user()->profile->user->name }}</p>
                </div>
                    @if(Auth::user()->profile->card_rank !== 'Pro')
                    <div class="flex items-end self-end">
                        <b class="text-5xl">{{ Auth::user()->profile->dive_count }}</b>
                        <p>DIVE</p>
                    </div>
                    @endif
                </a>
        </a>
    </section>

    <!-- メニュー部分 -->
    <div class="lg:flex">
        {{-- dashboard left-side --}}
        <section class="lg:w-1/2 flex flex-col">

            <p class="mb-3 font-bold">自分の記録</p>
            <hr class="mb-6">

            <div class="flex justify-around">
                <!-- 生物ログ-->
                <a href="{{ route('log.index') }}"
                    class=" rounded-lg drop-shadow-md w-11/12  h-32 lg:h-40  mb-6 flex justify-center items-center bg-cover bg-center"
                    style="background-image: url('storage/uploads/picture.jpg');">
                    <span class="text-white text-xl font-bold bg-black bg-opacity-50 rounded-lg py-2 px-6">生物ログ</span>
                </a>

            </div>

            <p class="mb-3 font-bold">記録のシェア</p>
            <hr class="mb-6">

            <div class="flex flex-col items-center">
                <!-- Map -->
                <a href="{{ route('map.site') }}"
                    class="rounded-lg drop-shadow-md w-11/12 h-32 lg:h-40 mb-6 flex justify-center items-center bg-cover bg-center"
                    style="background-image: url('storage/uploads/map.jpg');">
                    <span class="text-white text-xl font-bold bg-black bg-opacity-50 rounded-lg py-2 px-6">全国の生物Map</span>
                </a>
            </div>

            <hr class="mb-6">
            <div class="flex flex-col items-center">
                <!-- 陸の情報 -->
                <a href="{{ route('map.post') }}"
                    class="rounded-lg drop-shadow-md w-11/12 h-32 lg:h-40 mb-6 flex justify-center items-center bg-cover bg-center"
                    style="background-image: url('storage/uploads/aft.jpg');">
                    <span class="text-white text-xl font-bold bg-black bg-opacity-50 rounded-lg py-2 px-6">アフターダイビングスポット</span>
                </a>
            </div>

            <p class="mb-3 font-bold">海</p>
            <hr class="mb-6">
            <div class="flex justify-around w-full">
                <!-- 陸の情報 -->
                <a href="{{ route('tide.info') }}"
                    class="flex justify-center items-center mb-10 p-6  rounded-lg drop-shadow-md w-11/12 h-32 lg:h-40 bg-cover bg-center"
                    style="background-image: url('storage/uploads/tide.jpg');">
                    <span class="text-white text-xl font-bold bg-black bg-opacity-50 rounded-lg py-2 px-6">今日の潮</span>
                </a>
            </div>

        </section>

        {{-- dashboard right-side --}}
        <section class="lg:w-1/2 flex justify-center">
            <!-- profile -->
            <div class="w-11/12 bg-white p-8 rounded-lg shadow-xl hidden lg:block">
                <img src="{{ Storage::url(Auth::user()->profile->cover_image) }}" class="w-full h-80 object-cover bg-white rounded-lg shadow-xl">
                {{-- プロフィール表示部分 --}}
                <section class="pt-10">
                    <div class="flex justify-center items-end w-full">
                        {{-- プロフィール画像 --}}
                        <div class="mr-10 flex justify-center items-center flex-col w-full relative">
                            @if(Auth::user()->profile->card_rank !== 'Pro')
                            <img src="{{ Storage::url(Auth::user()->profile->profile_image) }}"
                                class="absolute bottom-2 h-36 w-36 sm:h-48 sm:w-48 mb-2 rounded-full object-cover bg-white border-2 border-paper">
                            @else
                            <img src="{{ Storage::url(Auth::user()->profile->profile_image) }}"
                                class="absolute right-2 h-36 w-36 sm:h-48 sm:w-48 mb-2 rounded-full object-cover bg-white border-2 border-paper">
                            @endif
                        </div>

                        {{-- カードランク表示 Proの場合は表示なし --}}
                        @if(Auth::user()->profile->card_rank !== 'Pro')
                        <div class="flex items-end self-end">
                            <b class="text-7xl">{{ Auth::user()->profile->dive_count }}</b>
                            <p>DIVE</p>
                        </div>
                        @endif
                    </div>

                    {{-- ユーザー名 --}}
                    <div class="flex justify-between items-end">
                        <h1 class="text-4xl mt-10 mr-8"><b>{{ Auth::user()->profile->user->name }}</h1>
                    </div>

                    {{-- カードランク --}}
                    <div class="mt-6">
                        <div class="flex items-end w-300 h-300">
                            <p class="mr-2 text-base">CARD RANK:</p>
                            <b class="text-3xl">{{ Auth::user()->profile->card_rank }}</b>
                        </div>
                    </div>

                    @if(Auth::user()->profile->shop_id !== null)
                    <a href="{{ route('shop.show',Auth::user()->profile->shop->id) }}">
                        <div class="mt-6">
                            <div class="flex items-center w-300 h-300">
                                <p class="mr-2">{{ Auth::user()->profile->shop->shop_name }}</p>
                                <img src="{{ Storage::url(Auth::user()->profile->shop->logo ) }}"
                                    class="rounded-full h-8 w-8 object-cover mr-2 bg-white">
                            </div>
                        </div>
                    </a>
                    @endif
                </section>
                {{-- マイプロフィール表示部分ここまで --}}

            </div>
        </section>
        <!-- 各種ボタンここまで -->
    </div>
    {{-- 全体のフレックスここまで --}}
</x-app-layout>
