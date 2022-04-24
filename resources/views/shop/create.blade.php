<x-guest-layout>
    {{-- 新規登録→プロフィール登録画面 --}}
    <x-auth-card>

        {{-- ロゴ表示部分 --}}
        <x-slot name="logo">
            <a href="/">
                <x-application-logo />
            </a>
        </x-slot>

        {{-- プロフィール入力フォーム --}}
        <div>
            <p>ショップを選択</p>
            @foreach ($shops as $shop)
                <form action="{{ route('shop.store') }}" method="post" class="flex justify-start items-center">
                    @csrf
                    <button class="mt-4 p-4 h-24 w-[400px] rounded-md bg-cover bg-center" style="background-image: url({{ Storage::url($shop->cover) }});">
                        <div class="flex justify-center items-center">
                            <img src="{{ Storage::url($shop->logo ) }}" class="rounded-full h-8 w-8 object-cover mr-2 bg-white">
                            <p class="text-white font-bold bg-black bg-opacity-50 px-2">{{ $shop->shop_name }}</p>
                        </div>
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    </button>
                </form>
            @endforeach
        </div>

        <a href="{{ route('dashboard') }}" >
            <x-button class="mt-12">登録しない</x-button>
        </a>

    </x-auth-card>
</x-guest-layout>
