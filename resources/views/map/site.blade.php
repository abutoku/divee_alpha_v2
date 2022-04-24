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

    <!-- 選択ボタン -->
    <section class="flex mt-16 justify-center sm:justify-start">
        <div class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy bg-divenavy text-white flex justify-around">
            ポイント別に見る</div>
        <a href="{{ route('map.fish') }}" class="rounded-2xl py-1 mr-4 w-[200px] border-2 border-divenavy flex justify-around">
            生物名で検索</a>
    </section>

    <!-- ポイント選択部分 -->
    <div class="flex flex-col items-center">
        <div id="place_seach" class="my-8 mr-2 flex items-end w-full">
            <div class="mr-8">
                <p class="text-sm mb-2">ポイント名</p>
                @if($val)
                <p id="site_name" class="text-4xl font-bold">{{ $val->site_name }}</p>
                @else
                <p id="site_name" class="text-2xl sm:text-4xl font-bold">選択されていません</p>
                @endif
            </div>

            <section class="flex justify-center">
                <form action="{{ route('map.getSiteLog') }}" method="POST">
                    @csrf
                    @if($val)
                    <input type="hidden" name="siteid" id="site_id" value="{{ $val->id }}">
                    @else
                    <input type="hidden" name="siteid" id="site_id" >
                    @endif
                    <x-button>検索</x-button>
                </form>
            </section>
        </div>

        <div class="lg:flex lg:justify-around w-full">
            <!-- 地図 -->
            <section class="flex justify-center">
                <div id="target" class="w-[500px] h-[400px] sm:w-[1200px] lg:w-[800px] sm:h-[600px]"></div>
            </section>
            <!-- 情報表示 -->
            <section class="flex justify-center mt-12 lg:mt-0">
                <div>
                @forelse ($logs as $log)
                    @if($log->image)
                        <div class="flex justify-between items-center bg-white rounded-lg drop-shadow-md h-36  w-[400px] mb-4">

                            <div class="p-4">
                                <p class="text-xs">{{ $log->date->format('Y-m-d') }}</p>
                                <a href="{{ route('profile.show',$log->user->id) }}" class="flex justify-start items-center mb-4">
                                    <img src="{{  Storage::url($log->user->profile->profile_image)  }}" class="mr-2 w-8 h-8 rounded-full">
                                    <p>{{ $log->user->name }}</p>
                                </a>
                                <p>{{ $log->book->fish_name }}</p>
                            </div>

                            <img src="{{  Storage::url( $log->image )  }}" class="h-36 w-36 rounded-r-lg object-cover">

                        </div>
                    @else
                        <div class="p-4 w-[400px] mb-4  bg-white rounded-lg drop-shadow-md">
                            <p class="text-xs">{{ $log->date->format('Y-m-d') }}</p>
                            <a href="{{ route('profile.show',$log->user->id) }}" class="flex justify-start items-center mb-4">
                                <img src="{{  Storage::url($log->user->profile->profile_image)  }}" class="mr-2 w-8 h-8 rounded-full">
                                <p>{{ $log->user->name }}</p>
                            </a>
                            <p>{{ $log->book->fish_name }}</p>
                        </div>
                    @endif
                @empty
                    <p>情報がありません</p>
                @endforelse
                </div>
            </section>
        </div>

    </div>
    <p class="button">TOP</p>
</x-app-layout>

    {{-- google map --}}
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('app.google_api') }}&callback=initMap">
    </script>

    <script>
        //受け取ったデータをjson化
            const sites = @json($sites);

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
                });

            //ダイブサイトにピンを表示
            sites.forEach(function(site){

            const pin = {lat:site.latitude, lng:site.longitude};

            marker = new google.maps.Marker({
                position:pin,
                map:map,
                title:site.site_name,
                icon : {
                url: '../storage/uploads/pin02.png',
                scaledSize: new google.maps.Size(24, 16)
                },
                animation: google.maps.Animation.DROP,
            });

            //マーカーをクリックすると発動
            marker.addListener("click",function() {
            //site_idを取得
            document.getElementById("site_id").value = site.id;
            //ポイント名を取得してHTML変更
            const name = `<p>${site.site_name}</p>`;
            $('#site_name').html(name);
            });
        });
    }

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
