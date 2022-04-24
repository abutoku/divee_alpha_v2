<style>
    .button {
        border-radius: 10px;
        position: fixed;
        right: 10;
        bottom: 10;
        font-size: 30px;
        color: #fff;
        background: #3E5155;
        padding: 10px;
        cursor: pointer;
        transition: .3s;

        /*デフォルトで非表示にする*/
        opacity: 0;
        visibility: hidden;
    }

    /*このクラスが付与されると表示する*/
    .active {
        opacity: 1;
        visibility: visible;
    }
</style>

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

    @if(session('status'))
    <div id="flash_message" class="text-green-700 p-3 bg-green-300 rounded mt-16 mb-3 flex justify-center">
        {{ session('status') }}
    </div>
    @endif

    <!-- 選択ボタン -->
    <section class="flex mt-14 mb-8 justify-center sm:justify-start">
        <a href="{{ route('dashboard') }}"
            class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy text-divenavy flex justify-around">
            HOME</a>
        <div class="rounded-2xl py-1 w-[200px] border-2 border-divenavy  bg-divenavy text-white flex justify-around">
            MESSAGE</div>
    </section>

    <a href="{{ route('buddy.create') }}" >
        <x-button>
            <svg class="h-5 w-5 text-white" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>メッセージ作成
        </x-button>
    </a>

    <section class="flex justify-center">
        <div class="mt-8">
            @forelse ($buddies as $buddy)
                <div class="bg-white rounded-lg drop-shadow-md w-[400px] sm:w-[650px] p-4 mt-4">
                    <p class="mb-2 text-xs">{{ $buddy->user->created_at->format('Y/m/d') }}</p>
                    <div class="flex justify-start items-center mb-4">
                        <img src="{{  Storage::url($buddy->user->profile->profile_image)  }}" class="mr-2 w-10 h-10 rounded-full">
                        <p>{{ $buddy->user->name }}</p>
                    </div>
                    <p class="mt-8">{!! nl2br(e($buddy->message)) !!}</p>
                </div>
            @empty
                <p class="mt-12">メッセージはありません</p>
            @endforelse
        </div>
    </section>
<p class="button">TOP</p>
</x-app-layout>

<script>
        
        $(function() {
        // 変数にクラスを入れる
        var btn = $('.button');

        //スクロールしてページトップから100に達したらボタンを表示
        $(window).on('load scroll', function(){
        if($(this).scrollTop() > 100) {
        btn.addClass('active');
        }else{
        btn.removeClass('active');
        }
        });

        //スクロールしてトップへ戻る
        btn.on('click',function () {
        $('body,html').animate({
        scrollTop: 0
        });
        });
        });

    </script>
