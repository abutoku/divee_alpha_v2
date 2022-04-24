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
            <img src="{{ Storage::url($shop->cover) }}"
                class="w-full h-80 object-cover bg-white rounded-lg shadow-xl">

            {{-- ショップ情報表示部分 --}}
            <section class="pt-10">
                <div class="flex justify-center items-end w-full">

                    {{-- ロゴ画像 --}}
                    <div class="mr-10 flex justify-center items-center flex-col w-full relative">
                        <img src="{{ Storage::url($shop->logo) }}"
                            class="absolute  bottom-1 left-10 h-36 w-36 sm:h-48 sm:w-48 mb-2 rounded-full object-cover bg-white border-2 border-paper">
                    </div>

                </div>
                {{-- ショップ名 --}}
                <div class="flex justify-between items-end">
                    <h1 class="text-4xl mt-10 mr-8"><b>{{ $shop->shop_name }}</h1>
                </div>

                {{-- URL --}}
                <div class="mt-6">
                    <a href="{{ $shop->url }}">
                        <div class="flex items-end w-300 h-300">
                            <p>{{ $shop->url }}</p>
                        </div>
                    </a>
                </div>

            </section>
            {{-- ショップ情報表示部分ここまで --}}

        </div>
    </div>
    <!-- wrapperここまで -->
</x-app-layout>
