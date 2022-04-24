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
            <span class="ml-2 text-divenavy">back</span>
        </a>
    </x-slot>

    <x-slot name="iconRight">
        <a href={{ route('dashboard') }}>
            <x-text-logo/>
        </a>
    </x-slot>



    <!--wrapper-->
    <div class="flex justify-center mt-12">
        <div class="px-2 flex justify-center w-[400px] md:w-[900px]">
            <form action="{{ route('log.store') }}" method="POST" enctype="multipart/form-data" class="md:w-full">
                @csrf

                <div class="md:flex md:w-full">
                    {{-- 入力欄 --}}
                    <div class="md:w-1/2">
                        {{-- 日付 --}}
                        <div>
                            <div id='date' class="pr-8">日付</div>
                            <input type="date" name="date" class="w-[250px] sm:w-[300px] rounded-lg border-2 border-divenavy">
                        </div>
                        {{-- 生物名 --}}
                        <div>
                            <div class="pr-8 mt-6">生物名</div>
                            <input type="text" name="name" class="rounded-lg border-2 border-divenavy  w-[250px] sm:w-[300px]">
                        </div>
                        {{-- 潜水地 --}}
                        <div>
                            <div class="pr-8 mt-6">ポイント</div>
                            <select type="text" name="site_id" class="rounded-lg border-2 border-divenavy  w-[250px] sm:w-[300px]">
                                <option>
                                    <option disabled selected value>ポイントを選択</option>
                                    @foreach ($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                                    @endforeach
                                </option>
                            </select>
                        </div>
                        {{-- 水深 --}}
                        <div>
                            <div class="pr-8 mt-6">水深</div>
                            <input type="number" value="10" min="0" name="depth" class="rounded-lg border-2 border-divenavy  w-[120px] ">  M
                        </div>
                        {{-- 水温 --}}
                        <div>
                            <div class="pr-8 mt-6">水温</div>
                            <input  type="number" value="20"  min="0" name="temp" class="rounded-lg border-2 border-divenavy  w-[120px]  mb-10">  ℃
                        </div>
                    </div>
                    {{-- 入力欄ここまで --}}


                    {{-- <a href="#" id="add_tag" class="inline-flex items-center px-4 py-2 bg-divenavy border border-transparent rounded-md font-semibold text-xs text-white  hover:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">タグを追加</a> --}}

                    {{-- 画像登録エリア --}}
                    <div class="md:w-1/2">

                        <div class="w-[250px] sm:w-[300px]">
                            {{-- ファイル選択欄 --}}
                            <input type="file" name="image_data" id="log_image" class="my-6">
                            <div class="flex justify-center">
                                {{-- プレビュー表示場所 --}}
                                <img src="{{ Storage::url('uploads/no_image.png') }}" id="demo_pic" class="mb-4 h-48 object-cover" >
                            </div>
                        </div>
                        <div id="canvas_contents">
                            <p>地図を選択</p>
                            <select name="divemap_id" id="map" class="rounded-lg border-2 border-divenavy">
                                <option disabled selected value>マップを選択</option>
                                @foreach ($divemaps as $divemap)
                                    <option value="{{ $divemap->id }}">{{ $divemap->map_name }}</option>
                                @endforeach
                            </select>

                            <canvas id="canvas" width="360" height="240" style="border:1px solid #000;" class="mt-4"></canvas>
                            <input type="hidden" id="point_x" name="point_x">
                            <input type="hidden" id="point_y" name="point_y">
                        </div><!-- canvas入力画面ここまで -->

                        <div id="clear_btn" class="mt-4 p-2 flex justify-center items-center bg-divenavy text-sm font-bold text-white w-36 rounded-lg cursor-pointer">MAPをクリア</div>
                    </div>
                    {{-- 画像登録エリアここまで --}}
                </div>



                {{-- 登録ボタン --}}
                <x-button class="my-8">登録終了</x-button><br>
            </form>
        </div>
        {{-- ログ一覧に戻るボタン --}}

    </div>

    <!--wrapperここまで-->

</x-app-layout>

<script>

    const divemaps = @json($divemaps);

    console.log(divemaps);

    $('#map').on('change',function () {
        const val = $('#map').val();
        const target = divemaps.find(x => x.id == val);
        console.log(target);
        $('#canvas').css(`background-image`,`url(../storage/${target.image})`);
    });

    //canvasについての記述
    let posiX = 0; //一つ前の座標を代入するための変数
    let posiY = 0; //一つ前の座標を代入するための変数

    const can = $('#canvas')[0]; //キャンバスそのものを変数
    const ctx = can.getContext("2d"); //canに対してgetContext関数を実行し書き込み権限を与える

    //パスの開始
    ctx.beginPath();

    $('#clear_btn').on("click", function () {
    ctx.closePath();
    ctx.clearRect(0, 0, can.width, can.height);//canvasをクリア

    $('#canvas').css(`background-image`,`none`);
    $('#map').val('');

    })

    //ダブルクリックで◯をつける
    $(can).on("dblclick", function (e) {
    console.log(e.offsetX);
    console.log(e.offsetY);

    ctx.closePath();
    ctx.clearRect(0, 0, can.width, can.height);//canvasをクリア

    pointX = e.offsetX; //位置の横軸を変数に代入
    pointY = e.offsetY; //位置の縦軸を変数に代入

    document.getElementById( "point_x" ).value = e.offsetX ;
    document.getElementById( "point_y" ).value = e.offsetY;

    ctx.beginPath();//パスの開始
    ctx.fillStyle = "#ff0000";//色指定
    //Rect(座標、半径、円のスタート度、エンド度（描画）、回転)
    ctx.arc(pointX, pointY, 5, 0, Math.PI * 2, false);
    ctx.stroke();//実際に書く関数(枠線)
    ctx.fill(); //塗りつぶし
    });

</script>
