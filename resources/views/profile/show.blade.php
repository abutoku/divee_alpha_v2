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
                <img src="{{ Storage::url($profile->cover_image) }}" class="w-full h-80 object-cover bg-white rounded-lg shadow-xl">

                {{-- プロフィール表示部分 --}}
                <section class="pt-10">
                    <div  class="flex justify-center items-end w-full">
                        {{-- プロフィール画像 --}}
                        <div class="mr-10 flex justify-center items-center flex-col w-full relative">
                        @if($profile->card_rank !== 'Pro')
                        <img src="{{ Storage::url($profile->profile_image) }}" class="absolute bottom-2 h-36 w-36 sm:h-48 sm:w-48 mb-2 rounded-full object-cover bg-white border-2 border-paper">
                        @else
                        <img src="{{ Storage::url($profile->profile_image) }}"
                            class="absolute right-2 h-36 w-36 sm:h-48 sm:w-48 mb-2 rounded-full object-cover bg-white border-2 border-paper">
                        @endif

                        {{-- profile.edit プロフィール写真変更ページへのリンク --}}
                        @if ($profile->user_id === Auth::user()->id)
                        <a href="{{ route('profile.edit',$profile->id)  }}" class="text-xs">
                            プロフィール画像変更</a>
                            @endif

                        </div>

                        {{-- カードランク表示 Proの場合は表示なし --}}
                        @if($profile->card_rank !== 'Pro')
                        <div class="flex items-end self-end">
                            <b class="text-7xl">{{ $profile->dive_count }}</b>
                            <p>DIVE</p>
                        </div>
                        @endif

                    </div>

                    {{-- ユーザー名 --}}
                    <div class="flex justify-between items-end">
                        <h1 class="text-4xl mt-10 mr-8"><b>{{ $profile->user->name }}</h1>
                    </div>

                    {{-- カードランク --}}
                    <div class="mt-6">
                        <div class="flex items-end w-300 h-300" >
                            <p class="mr-2 text-base">CARD RANK:</p>
                            <b class="text-3xl">{{ $profile->card_rank }}</b>
                        </div>
                    </div>

                    @if($profile->shop_id !== null)
                    <a href="{{ route('shop.show',$profile->shop->id) }}">
                    <div class="mt-6">
                        <div class="flex items-center w-300 h-300" >
                            <p class="mr-2">{{ $profile->shop->shop_name }}</p>
                            <img src="{{ Storage::url($profile->shop->logo ) }}" class="rounded-full h-8 w-8 object-cover mr-2 bg-white">
                        </div>
                    </div>
                    </a>
                    @endif
                </section>
                {{-- マイプロフィール表示部分ここまで --}}

                {{-- ログインユーザーかどうかの条件分岐 --}}
                @if($profile->user_id == Auth::user()->id)
                {{-- 選択ボタン --}}
                <section class="flex justify-center only mt-12">
                    <div class="rounded-2xl py-1 w-[120px] sm:w-[200px] mr-4 border-2 border-divenavy bg-divenavy text-white flex justify-around">
                        ステータス</div>

                    <a href="{{ route('profile.list',$profile->user_id ) }}" class="rounded-2xl py-1 w-[120px] sm:w-[200px] border-2 border-divenavy  text-divenavy flex justify-around">
                        BUDDY LIST</a>
                </section>

                <section class="mt-12">
                    <p>未実装</p>
                </section>
                @else
                    <section class="mt-12">
                        <a href="{{ route('buddy.create') }}">
                            <x-button>
                                <svg class="h-5 w-5 text-white" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>メッセージ作成
                            </x-button>
                        </a>
                    </section>

                @endif
            {{-- 条件分岐ここまで --}}

        </div>
    </div>
    <!-- wrapperここまで -->
</x-app-layout>
