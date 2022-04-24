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
            <x-hamburger/>
    </x-slot>

    <x-slot name="iconRight">
        <a href={{ route('dashboard') }}>
            <x-text-logo/>
        </a>
    </x-slot>

    @if(session('status'))
    <div id="flash_message" class="text-green-700 p-3 bg-green-300 rounded mt-16 mb-3 flex justify-center">
        {{ session('status') }}
    </div>
    @endif

    <!--wrapper-->
    {{-- 作成ボタン --}}
    <div class="pt-16">
        <a href="{{ route('log.create') }}"><x-button>
            <svg class="h-5 w-5 mr-2 text-white" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
            <line x1="16" y1="5" x2="19" y2="8" />
            </svg>記録を残す</x-button>
        </a>

        <a href="{{ route('book.index') }}"><x-button>
            <svg class="h-5 w-5 mr-2 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                <line x1="3" y1="6" x2="3" y2="19" />
                <line x1="12" y1="6" x2="12" y2="19" />
                <line x1="21" y1="6" x2="21" y2="19" />
            </svg>図鑑を見る</x-button>
        </a>

    {{-- 検索欄 --}}
        <section class="flex justify-start items-center mt-2">
            <form action="{{ route('log.search') }}" method="post">
                @csrf
                <select name="site_id" class="rounded-lg border-2 border-divenavy my-2">
                    <option disabled selected value>ポイントを選択</option>
                    @foreach ($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                    @endforeach
                </select>

                <!--工事中-->
                {{-- <select name="site" class="rounded-lg border-2 border-divenavy my-2">

                    <option disabled selected value>月を選択</option>
                    @foreach ($dates->unique('date') as $date)
                    <option value="{{ $date }}">{{ $date->date->format('Y-m') }}</option>
                    @endforeach

                </select> --}}

                <x-button>検索</x-button>
            </form>
        </section>

    {{-- 表示部分 --}}
        <section class="mt-2">
            <div class="flex flex-col items-center">
            @forelse ($logs as $log)
            {{-- 画像がある場合 --}}
                @if($log->image)
                    <div class="flex justify-between bg-white drop-shadow-md rounded-lg w-[400px] sm:w-[650px] h-40 sm:h-60 my-5">
                        <div class="p-2 sm:p-4 w-full">
                            <div class="flex justify-between">
                                {{-- テキスト部分 --}}
                                <div>
                                    <div class="mt-4 text-xs sm:text-base">{{  $log->date->format('Y-m-d') }}</div>
                                    <div class="font-bold text-lg">{{  $log->book->fish_name }}</div>
                                    <div class="text-sm sm:text-base">{{  $log->site->site_name }}</div>
                                    <div class="text-sm sm:text-base">水深 : {{  $log->depth }}M</div>
                                    <div class="text-sm sm:text-base mb-2 sm:mb-8">水温 : {{  $log->temp }}℃</div>
                                    <a href="{{ route('log.show',$log->id) }}">詳細へ</a>
                                </div>
                                {{-- 縦三点リーダー --}}
                                <div x-data="{ open:false }" @click.away="open = false" @close.stop="open = false" class="flex flex-col items-end">
                                    <button @click="open = !open">
                                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <circle cx="12" cy="12" r="1" />
                                            <circle cx="12" cy="19" r="1" />
                                            <circle cx="12" cy="5" r="1" />
                                        </svg>
                                    </button>
                                    {{-- 削除ボタン --}}
                                    <form x-show="open" x-transition action="{{ route('log.destroy',$log->id )}}" method="post" x-cloak>
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="m-6 py-2 px-4 border rounded-lg">削除</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        {{-- 生物画像 --}}
                        <div>
                            <img src="{{ Storage::url($log->image) }}" alt="picture" class="h-40 sm:h-60 w-56 sm:w-[400px] object-cover rounded-r-lg">
                        </div>
                    </div>
            {{-- サムネイル画像が無い場合 --}}
                @else
                    <div class="flex flex-col bg-white drop-shadow-md rounded-lg w-[400px] sm:w-[650px] h-40 sm:h-60 my-5 p-2 sm:p-4">
                        <div class="flex justify-between">
                            {{-- テキスト部分 --}}
                            <div>
                                <div class="mt-4 text-xs sm:text-base">{{  $log->date->format('Y-m-d') }}</div>
                                <div class="font-bold text-lg">{{  $log->book->fish_name }}</div>
                                <div class="text-sm sm:text-base">{{  $log->site->site_name }}</div>
                                <div class="text-sm sm:text-base">水深 : {{  $log->depth }}M</div>
                                <div class="text-sm sm:text-base mb-2 sm:mb-8">水温 : {{  $log->temp }}℃</div>
                                <a href="{{ route('log.show',$log->id) }}">詳細へ</a>
                            </div>
                            {{-- 縦三点リーダー --}}
                            <div x-data="{ open:false }" @click.away="open = false" @close.stop="open = false" class="flex flex-col items-end">
                                <button @click="open = !open">
                                    <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <circle cx="12" cy="12" r="1" />
                                        <circle cx="12" cy="19" r="1" />
                                        <circle cx="12" cy="5" r="1" />
                                    </svg>
                                </button>
                                {{-- 削除ボタン --}}
                                <form x-show="open" x-cloak x-transition action="{{ route('log.destroy',$log->id )}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="mt-6 py-2 px-4 border rounded-lg">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            <p>情報はありません</p>
            @endforelse

            </div>
        </section>
    {{-- 表示部分ここまで --}}
    </div>
    <!--wrapperここまで-->
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
