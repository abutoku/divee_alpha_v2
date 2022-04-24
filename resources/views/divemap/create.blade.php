<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ route('setting.index') }}" class="flex">
            <svg class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            <span class="ml-2 text-divenavy">back</span>
        </a>
    </x-slot>

    <x-slot name="iconRight">
        <a href={{ route('dashboard') }}>
            <x-text-logo />
        </a>
    </x-slot>

    <section class="mt-12 flex justify-center">
        {{-- 水中地図のアップロードフォーム --}}
        <form action="{{ route('divemap.store') }}" method="post" enctype="multipart/form-data" class="flex flex-col">
            @csrf
                <p>地図名</p>
                <input type="text" name="map_name" class="rounded-lg border-2 border-x-divenavy">

                <p class="mt-6">地図画像</p>

                <div class="flex justify-center mt-4">
                    <img src="{{ Storage::url('uploads/no_image.png') }}" id="demo_img" class="h-48 w-48 object-cover bg-white">
                </div>

                <input type="file" id="dive_map" name="map_image" class="mt-4">

                <x-button class="mt-12 flex justify-center">登録</x-button>
        </form>

    </section>

</x-app-layout>
