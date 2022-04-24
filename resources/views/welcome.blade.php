<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Divee</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
    /* 背景色 */
    body {
        background-color: #015DC6;
    }
    .main {
        height: 1200px;
    }
    /* リンクのスタイルを初期化 */
    a:link,
    a:visited,
    a:hover,
    a:active {
        text-decoration: none;
        color: white;
    }
    .wrapper {
        width: 90%;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #top_header {
        width:100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .top-contents{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .btn-area {
        display: flex;
        justify-content: center;
    }

    .top-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 200px;
        height:60px;
        border-radius: 10px;
        margin-bottom: 12px;
        background-color:white;
    }
    .sigin-in {
        color:white;
        text-decoration:underline;
        margin-left:auto;
    }

    #map_area {
        display:flex;
        justify-content: center;
    }
    #target {
        width:1200px;
        height: 600px;
    }

    #top_message {
        color:white;
        font-size:48px;
        font-family: 'Press Start 2P', cursive;
    }

    #info {
    font-size:4px;
    color:white;
    text-align: left;
    }

    @media screen and (max-width: 500px) {
    /* 480px以下に適用されるCSS（スマホ用） */
    .top-btn {
        width: 120px;
        height:40px;
    }
    .sigin-in {
        font-size: 12px;
    }
    #top_message {
        font-size:24px;
    }


    }
    </style>

</head>
<body>
    {{-- 全体の背景 --}}
    <div class="main">
        <div class="wrapper">
            <div id="top_header">
                {{-- ロゴマークの読み込み --}}
                <x-application-logo/>

                <div class="top-contents">
                    {{-- ログインボタン部分 --}}
                    @auth
                    {{-- すでにログイン済みであればHOMEへ --}}
                    <div class="btn-area">
                        <a href="{{ url('/dashboard') }}" class="top-btn" style="color:#015DC6;">
                            HOMEへ
                        </a>
                    </div>
                    @else
                    {{-- ログインリンク --}}
                    <div class="btn-area">
                        <a href="{{ route('login') }}" class="top-btn" style="color:#015DC6;">
                            ログイン
                        </a>
                    </div>
                    {{-- 新規登録リンク --}}
                    <div class="sigin-in">
                        <a href="{{ route('register') }}">新規登録はこちら</a>
                    </div>
                    @endauth
                </div>

            </div>
            {{-- headerここまで --}}
            <p id="top_message">Welcome!!</p>
            <p id="info">直近3日以内に投稿があったポイント</p>
        </div>
        {{-- wrapperここまで --}}
        <!-- 地図 -->
        <section id="map_area">
            <div id="target"></div>
        </section>

     </div>
    {{-- 全体ここまで --}}

    {{-- google map --}}
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('app.google_api') }}&callback=initMap">
    </script>

    <script>

    //受け取ったデータをjson化
    const newposts = @json($newposts);

    //生物の地図設定
    function initMap() {
    'use strict'

    var target = document.getElementById('target');
    var map;
    //latitude（緯度）,longitude（経度）
    var fukuoka = {lat:33.5867214193664, lng:130.3946010116519};
    var marker;

    //33.5867214193664, 130.3946010116519
    map = new google.maps.Map(target,{
    center:fukuoka,
    zoom:8,
    disableDefaultUI:true,
    mapId:"a9c9f838d91f3515",
    });

    //ピンを配置
    newposts.forEach(function(post){

        const pin = {lat:post.latitude, lng:post.longitude};

        marker = new google.maps.Marker({
        position:pin,
        map:map,
        icon : {
        url: 'storage/uploads/pin01.png',
        scaledSize: new google.maps.Size(36, 42)
        },
        animation: google.maps.Animation.BOUNCE,
        });

    });

    }

    </script>
</body>
</html>
