<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ url()->previous() }}" class="flex">
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

{{-- -----生物詳細画面----- --}}
    <section class="flex justify-end mt-12">
        {{-- 縦三点リーダー --}}
        <div x-data="{ open:false }" @click.away="open = false" @close.stop="open = false" class="flex flex-col items-end">
            <button @click="open = !open">
                <svg class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="12" cy="5" r="1" />
                    <circle cx="12" cy="19" r="1" />
                </svg>
            </button>
            <div x-show="open" x-transition x-cloak class="absolute right-12 flex flex-col bg-white p-4 rounded-lg border">
                <a href="{{ route('book.select',$book->id) }}" class="text-xs mt-2">写真変更</a>
                <a href="{{ route('book.memo',$book->id ) }}" class="text-xs mt-2">MEMO編集</a>
            </div>
        </div>
    </section>


    <section>
        <div class="flex justify-around">
            <div class="flex flex-col w-1/2 sm:w-1/3">
            {{-- 画像の登録があるか？ --}}
            @if($book->picture)
                <img src="{{ Storage::url($book->picture) }}" alt="生物の写真"
                class="object-cover h-72 md:h-80 rounded-lg drop-shadow-2xl">
            @else
                <img src="{{ Storage::url('uploads/no_image.png') }}" alt="画像無し"
                class="object-cover h-72 md:h-80 rounded-lg drop-shadow-2xl">
            @endif
            </div>

            <div class="w-1/2 sm:w-1/3 flex flex-col items-center">
                {{-- 生物名 --}}
                <h1 class="mt-8  text-lg md:text-3xl font-bold">{{ $book->fish_name }}</h1>
                @if($book->order)
                    <div class="flex">
                        <p class="text-xs lg:text-base mr-6">{{ $book->order }}</p>
                        <p class="text-xs lg:text-base">{{ $book->family }}</p>
                    </div>
                @endif
                <section class="hidden lg:block w-11/12">
                    {{-- 説明文 --}}
                    @if($book->info)
                        <div class="mt-4 ml-2 p-4 rounded-lg h-56 border bg-slate-50">
                            {!! nl2br(e($book->info)) !!}
                        </div>
                    @else
                        <div class="mt-4 ml-2 p-4 rounded-lg  h-56 sm:h-72 border bg-slate-50"><a href="{{ route('book.memo',$book->id ) }}" class="flex"><svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>Memo</a></div>
                    @endif
                </section>
            </div>
        </div>
    </section>

    {{-- 検索欄 --}}
    {{-- <section class="mt-12 flex flex-col w-[300px]">
        <form action="{{ route('book.search') }}" method="post" class="flex justify-start items-center">
            @csrf
            <select name="site_id" class="rounded-lg border-2 border-divenavy my-2">
                <option>
                <option disabled selected value>ポイントを選択</option>
                @foreach ($sites as $site)
                <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                @endforeach
                </option>
            </select>
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <x-button class="ml-4">検索</x-button>
        </form>
    </section> --}}

    {{-- 地図選択 --}}
    <section class="flex flex-col w-[300px] mt-12">

            <select id="map" name="site_id" class="rounded-lg border-2 border-divenavy my-2">
                <option>
                <option disabled selected value>地図を選択</option>
                @foreach ($divemaps as $divemap)
                <option value="{{ $divemap->id }}">{{ $divemap->map_name }}</option>
                @endforeach
                </option>
            </select>
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            {{-- <input type="text" class="rounded-lg border-2 border-divenavy" placeholder="日時検索"> --}}

    </section>

    {{-- -----ログ表示部分----- --}}
    <div class="md:flex justify-around">

        <div class="mt-10 flex justify-center h-[300px]">
            <canvas id="canvas" width="400" height="300" style="border:1px solid #000; background-color:white;" class="mt-4"></canvas>
        </div>

        <section class="mt-12 lg:w-1/2">
            @forelse ($logs as $log)
            <div x-data="{ open: false }" @click.away="open = false" @close.stop="open = false" class="flex justify-center ">

                <div class="show-btn bg-white rounded-lg drop-shadow-md w-[400px] lg:w-11/12 mb-4 p-4  hover:bg-gray-100 cursor-pointer"  @click="open = ! open" id="{{ $log->id }}" value="{{ $log->divemap_id }}">
                    <div class="flex">
                        <p class="mr-4">{{ $log->date->format('Y-m-d') }}</p>
                        <p>{{ $log->site->site_name }}</p>
                    </div>
                </div>

                {{-- モーダル部分 --}}
                <div class="inset-0 w-full h-full fixed flex items-center justify-center z-20"
                style="background-color: rgba(0,0,0,.5);" x-show="open" x-cloak>

                    <div class="text-left bg-white h-[600px] p-6 overflow-y-auto" @click.away="open = false">
                        <h2 class="text-2xl font-bold mb-2">{{ $book->fish_name }}</h2>
                        <p class="text-xs">{{ $log->date->format('Y-m-d') }}</p>
                        <p>{{ $log->site->site_name }}</p>
                        <p>水温 : {{ $log->temp }} ℃</p>
                        <p class="mb-4">水深 : {{ $log->depth }} M</p>
                        @if($log->image)
                        <div class="flex justify-center">
                        <img src="{{ Storage::url($log->image) }}" class="w-[300px] h-[200px] rounded-lg object-cover mb-8">
                        </div>
                        @endif
                        <a href="{{ route('log.show',$log->id) }}" class="">詳細へ</a>
                        <div class="flex justify-center mt-8">
                            <x-button class="bg-gray-700 text-white px-4 py-2 rounded no-outline focus:shadow-outline select-none"
                            @click="open = false">Close</x-button>
                        </div>
                    </div>
                </div>

            </div>
            @empty
                <p class="ml-6">情報がありません</p>
            @endforelse
        </section>

        {{-- 写真の表示部分 --}}

        {{-- <section class="hidden lg:block md:w-1/2">

            <div class="mt-10 flex justify-center">
                <canvas id="canvas" width="400" height="300" style="border:1px solid #000;" class="mt-4"></canvas>
            </div>

            <div class="flex flex-wrap justify-around">
                @foreach ($logs as $log)
                    @if($log->image)
                    <img src="{{ Storage::url($log->image) }}" class="w-56 h-40 rounded-lg object-cover mb-2">
                    @endif
                @endforeach
            </div>
        </section> --}}

    </div>
</x-app-layout>

<script>

    const divemaps = @json($divemaps);
    const logs = @json($logs);

    //canvasについての記述
    const can = $('#canvas')[0]; //キャンバスそのものを変数
    const ctx = can.getContext("2d"); //canに対してgetContext関数を実行し書き込み権限を与える

    //パスの開始
    ctx.beginPath();

    //地図か選択されたら
    $('#map').on('change',function () {

        //canvasをクリア
        ctx.closePath();
        ctx.clearRect(0, 0, can.width, can.height);//canvasをクリア

        const val = $('#map').val();
        const target = divemaps.find(x => x.id == val);
        console.log(target);
        // 背景を変える
        $('#canvas').css(`background-image`,`url(../storage/${target.image})`);


        //divemap_idが一致しているものがあれば丸を描画
        logs.forEach(element => {
            if(element.divemap_id == target.id){
                console.log('ok');

                pointX = element.point_x; //位置の横軸を変数に代入
                pointY = element.point_y; //位置の縦軸を変数に代入

                ctx.beginPath();//パスの開始
                ctx.fillStyle = "#ff0000";//色指定
                //Rect(座標、半径、円のスタート度、エンド度（描画）、回転)
                ctx.arc(pointX, pointY, 5, 0, Math.PI * 2, false);
                ctx.stroke();//実際に書く関数(枠線)
                ctx.fill(); //塗りつぶし
            }
        });

    });


</script>
