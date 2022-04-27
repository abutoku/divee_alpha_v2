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
    <section class="flex mt-14 mb-8 justify-center sm:justify-start lg:hidden">
        <div class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy bg-divenavy text-white flex justify-around">
            HOME</div>
        <a href="#" class="rounded-2xl py-1 w-[200px] border-2 border-divenavy flex justify-around mr-2 relative">
            INFOMATION
        </a>
    </section>


    <!-- メニュー部分 -->
    <div class="lg:flex sm:mt-16">
        {{-- dashboard left-side --}}
        <section class="lg:w-1/2 flex flex-col">
            
            <div class="flex justify-around">
                <!-- 生物ログ-->
                <a href="{{ route('log.index') }}"
                    class=" rounded-lg drop-shadow-md w-11/12  h-32 lg:h-40  mb-6 flex justify-center items-center bg-cover bg-center"
                    style="background-image: url('storage/uploads/picture.jpg');">
                    <span class="text-white text-xl font-bold bg-black bg-opacity-50 rounded-lg py-2 px-6">生物ログ</span>
                </a>
            </div>

            <div class="flex justify-around w-full">
                <!-- 陸の情報 -->
                <a href="{{ route('tide.info') }}"
                    class="flex justify-center items-center mb-10 p-6  rounded-lg drop-shadow-md w-11/12 h-32 lg:h-40 bg-cover bg-center"
                    style="background-image: url('storage/uploads/tide.jpg');">
                    <span class="text-white text-xl font-bold bg-black bg-opacity-50 rounded-lg py-2 px-6">今日の潮</span>
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


            <hr class="mb-6">


        </section>

        {{-- dashboard right-side --}}
        <section class="lg:w-1/2 flex justify-center">
            <!-- profile -->
            <div class="w-11/12 bg-white p-8 rounded-lg shadow-xl hidden lg:block">
                <img src="{{ Storage::url(Auth::user()->infomation->cover_image) }}" class="w-full h-80 object-cover bg-white rounded-lg shadow-xl">
                {{-- プロフィール表示部分 --}}
                <section class="pt-10">
                    <div class="flex justify-center items-end w-full">
                        {{-- プロフィール画像 --}}
                        <div class="mr-10 flex justify-center items-center flex-col w-full relative">
                            <img src="{{ Storage::url(Auth::user()->infomation->logo_image) }}"
                                class="absolute left-0 h-36 w-36 sm:h-48 sm:w-48 ml-12 mb-2 rounded-full object-cover bg-white border-2 border-paper">
                        </div>
                    </div>

                    {{-- ユーザー名 --}}
                    <div class="flex justify-between items-end mt-20">
                        <h1 class="text-4xl mt-10 mr-8"><b>{{ Auth::user()->name }}</h1>
                    </div>

                </section>
                {{-- マイプロフィール表示部分ここまで --}}

            </div>
        </section>
        <!-- 各種ボタンここまで -->
    </div>
    {{-- 全体のフレックスここまで --}}
</x-app-layout>
