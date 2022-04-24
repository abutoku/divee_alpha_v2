<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ route('book.show',$book->id) }}" class="flex">
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

    {{-- 図鑑MEMO編集画面 --}}
    <section class="mt-24 flex justify-center">
        <form action="{{ route('book.update',$book->id) }}" method="post" class="flex flex-col w-[300px]">
            @method('patch')
            @csrf
            <p class="mt-6">memo</p>
            <textarea name="info" class="rounded-lg border-2 border-divenavy h-[200px]">{{ $book->info }}</textarea>

            <x-button class="mt-6 flex justify-center">更新</x-button>
        </form>
    </section>

</x-app-layout>
