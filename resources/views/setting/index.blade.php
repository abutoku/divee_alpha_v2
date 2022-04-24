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

    {{-- 各種設定一覧 --}}
    <section class="mt-16">
        <div class="bg-white w-80 rounded-lg">

            <div class="flex justify-start items-center h-12 border-b cursor-pointer hover:bg-gray-100">
                <a href="{{ route('site.create') }}" class="ml-2">ダイビングポイント登録</a>
            </div>

            <div class="flex justify-start items-center h-12 border-b cursor-pointer hover:bg-gray-100">
                <a href="{{ route('divemap.index') }}" class="ml-2">水中地図設定</a>
            </div>

        </div>
    </section>

</x-app-layout>
