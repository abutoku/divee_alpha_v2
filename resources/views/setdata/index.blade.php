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
        {{-- ロゴなし --}}
    </x-slot>

    <a href="{{ route('setdata.create') }}">
        <x-button class="mt-12">データ追加</x-button>
    </a>

    {{-- 一覧表示部分 --}}
    <section class="mt-8 bg-white w-80 rounded-lg">
        @forelse ($setdatas as $setdata)
            <a href="{{ route('setdata.edit',$setdata->id) }}" class="flex justify-start items-center h-12 border-b cursor-pointer hover:bg-gray-100">
            <p class="ml-4">{{ $setdata->site_name }}</p>
            </a>
        @empty
            <p>登録がありません</p>
        @endforelse
    </section>


</x-app-layout>
