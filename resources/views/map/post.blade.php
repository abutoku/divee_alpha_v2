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

    {{-- モーダル --}}

    <section id="map_modal" class="w-full h-full">
        <div id="map_mask" class="inset-0 w-full h-full fixed flex items-center justify-center z-20 bg-black bg-opacity-50">
        </div>
        <div class="absolute inset-0 m-auto bg-white h-36 w-36 p-4 rounded z-30">
            <div id="output"></div>
        </div>
    </section>

    <!-- 選択ボタン -->
    <section class="flex mt-16 justify-center sm:justify-start">
        <div class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy bg-divenavy text-white flex justify-around">
            MAP</div>
        <a href="{{ route('post.index') }}" class="rounded-2xl py-1 w-[200px] border-2 border-divenavy  text-divenavy flex justify-around">
            タイムライン</a>
    </section>

    <section class="mt-12">
        <a href="{{ route('post.create') }}"
            class="rounded-lg drop-shadow-md ">
            <x-button>
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                </svg>投稿
            </x-button>
        </a>
    </section>

    <!-- 地図 -->
    <section class="flex justify-center mt-12">
        <div id="target" class="w-[500px] h-[400px] sm:w-[1200px] sm:h-[600px]"></div>
    </section>

</x-app-layout>

{{-- google map --}}
<script async defer
    src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('app.google_api') }}&callback=initMap">
</script>

<script>

    $('#map_modal').hide();

    $('#map_mask').on('click',function(){
        $('#map_modal').hide();
    });

    //受け取ったデータをjson化
    const posts = @json($posts);

    //投稿記事の地図設定
    function initMap() {
        'use strict'

        var target = document.getElementById('target');
        var map;
        //latitude（緯度）,longitude（経度）
        var fukuoka = {lat:33.5867214193664, lng:130.3946010116519};
        var marker;
        var infoWindow;

        //33.5867214193664, 130.3946010116519
        map = new google.maps.Map(target,{
            center:fukuoka,
            zoom:10,
            disableDefaultUI:true,
        });

        //ダイブサイトにピンを表示
        posts.forEach(function(post){

        if(post.latitude !== null && post.longitude !== null){
            const pin = {lat:post.latitude, lng:post.longitude};

            marker = new google.maps.Marker({
            position:pin,
            map:map,
            title:'Click me!',
            icon : {
            url: '../storage/uploads/pin03.png',
            scaledSize: new google.maps.Size(36, 36)
            },
            animation: google.maps.Animation.BOUNCE,
            });

            //吹き出し（情報ウィンドウ）作成
            infoWindow = new google.maps.InfoWindow({
            position: pin,
            content: `
            <div>
                <div>
                    <p>Tips</p>
                </div>
                <div>
                    <p>${post.title}</p>
                </div>
            </div>
            `,
            pixelOffset: new google.maps.Size(0, -50)
            })

        }

        //マーカーをホバーしたら情報ウィンドウを表示
        marker.addListener('click', () => {
        // infoWindow.setMap(null);
        $('#map_modal').show();

        const info = `
        <p>Tips</p>
        <p class="mb-4 font-bold">${post.title}</P>
        <a href=/post/${post.id}>詳細へ</a>
        `;

        $('#output').html(info);
        });

        });

    }

</script>
