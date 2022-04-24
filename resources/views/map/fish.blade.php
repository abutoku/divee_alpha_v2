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

    <!-- 選択ボタン -->
    <section class="flex mt-16 justify-center sm:justify-start">

        <a href="{{ route('map.site') }}"
            class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy  text-divenavy flex justify-around">
            ポイント別に見る</a>

        <div
            class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy bg-divenavy text-white flex justify-around">
            生物名で検索</div>

    </section>

    <form action="{{ route('map.search') }}" method="POST">
        @csrf
        <input type="text" name="search_name" placeholder="生物名を入力" class="my-8 rounded-lg border-2 border-divenavy"">
        <x-button>検索</x-button>
    </form>

    <!-- 地図 -->
    <section class="flex justify-center">
        <div id="target" class="w-[500px] h-[400px] sm:w-[1200px] sm:h-[600px]"></div>
    </section>

</x-app-layout>


{{-- google map --}}
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('app.google_api') }}&callback=initMap">
</script>


<script>
    const locations = @json($locations);

    console.log(locations);
    const pins = locations.map(x =>{
        return {lat:x.latitude,lng:x.longitude};
    });

    //投稿記事の地図設定
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
        });

        console.log(pins);

        const markers  = pins.map((position) => {
            return marker = new google.maps.Marker({
            position,
            });
    });
    const markerCluster = new markerClusterer.MarkerClusterer({ map,markers });

    }

</script>
