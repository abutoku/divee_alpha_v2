<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <x-hamburger />
    </x-slot>

    <x-slot name="iconRight">
        <a href={{ route('dashboard') }}>
            <x-text-logo />
        </a>
    </x-slot>
    {{-- -----マイプロフィール画面----- --}}

    <!-- wrapper -->
    <div class="flex justify-center">

        <div class="mt-10 w-[400px] sm:w-[600px] ">
            <img src="{{ Storage::url($infomation->cover_image) }}" class="w-full h-80 object-cover bg-white rounded-lg shadow-xl">

            {{-- プロフィール表示部分 --}}
            <section class="pt-10">
                <div  class="flex justify-center items-end w-full">
                    {{-- プロフィール画像 --}}
                    <div class="mr-10 flex justify-center items-center flex-col w-full relative">
                        <img src="{{ Storage::url($infomation->logo_image) }}" class="absolute left-0 h-36 w-36 sm:h-48 sm:w-48 mb-2 ml-12 rounded-full object-cover bg-white border-2 border-paper">
                    </div>
                </div>
                {{-- ユーザー名 --}}
                <div class="flex justify-between items-end mt-8">
                    <h1 class="text-4xl sm:text-6xl mt-16 sm:mt-24 mr-8"><b>{{ $infomation->user->name }}</h1>
                </div>
                <a href="{{ $infomation->shop_url }}" class="">{{ $infomation->shop_url }}</a>
            </section>
            {{-- マイプロフィール表示部分ここまで --}}
        </div>

    </div>
    <!-- wrapperここまで -->
</x-app-layout>
