<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ route('map.post') }}" class="flex">
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
    {{-- ------新規ログの入力画面------- --}}

    {{-- ------入力フォーム-------------- --}}
    <div class="flex justify-center mt-16">

        <div class="px-2 pb-8 rounded-lg shadow-lg bg-white flex justify-center w-[400px] sm:w-[600px] p-2">

            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                {{-- 日付 --}}
                <div class="mt-8 flex flex-col items-center">
                    <div>
                        <div class="pr-8">date</div>
                        <input type="date" name="date" class="w-[300px] sm:w-[400px] rounded-lg border-2 border-divenavy">
                    </div>
                {{-- タイトル --}}
                    <div>
                        <div class="pr-8 mt-6">タイトル</div>
                        <input type="text" name="title" class="rounded-lg border-2 border-divenavy w-[300px] sm:w-[400px]">
                    </div>
                {{-- コメント --}}
                    <div>
                        <div class="pr-8 mt-6">コメント</div>
                        <textarea name="message" class="rounded-lg border-2 border-divenavy  h-36 w-[300px] sm:w-[400px] mb-8"></textarea>
                    </div>
                </div>

                <div>場所を選択</div>
                {{-- 地図 --}}
                <div id="target" class="w-[400px] h-[300px]"></div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">

                {{-- 登録ボタン --}}
                <x-button class="my-12 ml-4">次へ</x-button>
                {{-- ------入力フォームここまで-------------- --}}
            </form>
        </div>
    </div>
</x-app-layout>

<script async defer src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('app.google_api') }}&callback=initMap"></script>


<script>

    //投稿記事の地図の設定
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
            zoom:14,
            disableDefaultUI:true,
        });

        map.addListener('click',function(e){
            if(marker){
                marker.setMap(null);
            }
            console.log(e.latLng.lat());
            console.log(e.latLng.lng());
            console.log(e.latLng.toString());
            document.getElementById( "latitude" ).value = e.latLng.lat() ;
            document.getElementById( "longitude" ).value = e.latLng.lng();

            marker = new google.maps.Marker({
            position:e.latLng,
            map:map,
            title:e.latLng.toString(),
            animation: google.maps.Animation.DROP,
        });

        //クリックした場所を中心にする
        this.panTo(e.latLng);

        });
    }

</script>
