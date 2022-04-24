<style>

    #canvas {
        background-size: cover;
        background-position: center;
    }

</style>

<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ route('log.index') }}" class="flex">
            <svg class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            <span class="ml-2 text-divenavy">ログ一覧ページへ</span>
        </a>
    </x-slot>

    <x-slot name="iconRight">
        <a href={{ route('dashboard') }}>
            <x-text-logo />
        </a>
    </x-slot>

    {{-- -----ログの詳細ページ ---}}

    <section class="mt-16 flex justify-center">
        <div class="bg-white drop-shadow-md rounded-lg p-10 w-[400px] sm:w-[650px]">
            <div>
                <div>
                    <p class="text-xs">{{ $log->date->format('Y-m-d') }}</p>
                    <a href="{{ route('book.show',$log->book->id) }}" class="text-2xl font-bold">{{ $log->book->fish_name }}</a>
                    <p>{{ $log->site->site_name }}</p>
                    <p>水温 : {{ $log->temp }}℃</p>
                    <p>水深 : {{ $log->depth }} M</p>
                </div>
                @if($log->image)
                <div class="mt-10 flex justify-center">
                    <img src="{{ Storage::url($log->image) }}" class="h-56 w-80 object-cover rounded-lg">
                </div>
                @endif
            </div>

            @if($map !== [])
            <div class="mt-10 flex justify-center">
                <canvas id="canvas" width="400" height="300" style="border:1px solid #000;" class="mt-4"></canvas>
            </div>

            @endif
        </div>
    </section>

</x-app-layout>

<script>

    const log = @json($log);
    const map = @json($map);


    $('#canvas').css(`background-image`,`url(../storage/${map.image})`);

    //canvasについての記述
    const can = $('#canvas')[0]; //キャンバスそのものを変数
    const ctx = can.getContext("2d"); //canに対してgetContext関数を実行し書き込み権限を与える

    //パスの開始
    ctx.beginPath();

    pointX = log.point_x; //位置の横軸を変数に代入
    pointY = log.point_y; //位置の縦軸を変数に代入

    ctx.beginPath();//パスの開始
    ctx.fillStyle = "#ff0000";//色指定
    //Rect(座標、半径、円のスタート度、エンド度（描画）、回転)
    ctx.arc(pointX, pointY, 5, 0, Math.PI * 2, false);
    ctx.stroke();//実際に書く関数(枠線)
    ctx.fill(); //塗りつぶし

</script>
