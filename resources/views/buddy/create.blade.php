<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ route('buddy.index') }}" class="flex">
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

    <section class="mt-24 flex justify-center">
        <form action="{{ route('buddy.store') }}" method="post" class="flex flex-col w-[300px]">
            @csrf
            <select name="dive_count" class="rounded-lg border-2 border-divenavy">
                <option disabled selected value>ダイブ本数</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="0">本数の登録無し</option>
            </select>

            <select name="buddy_id" class="mt-6 rounded-lg border-2 border-divenavy">
                <option disabled selected value>バディを選択</option>
                @foreach ($profiles as $profile)
                <option value="{{ $profile->user->id }}">{{ $profile->user->name }}</option>
                @endforeach
            </select>

            <p class="mt-6">message</p>
            <textarea name="message" class="rounded-lg border-2 border-divenavy h-[200px]"></textarea>

            <x-button class="mt-6 flex justify-center">送信</x-button>
        </form>
    </section>

</x-app-layout>
