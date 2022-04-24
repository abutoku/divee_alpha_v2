
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

{{-- メンバーのカードランクとダイブ本数の一覧 --}}
<section class="bg-paper text-divenavy mt-6">

    <div class="flex flex-col justify-center h-full ">
        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 p-6">
            <a href="{{ route('shop.show',$shop->id) }}" class="flex justify-center items-center">
                <img src="{{ Storage::url($shop->logo)}}" class="object-cover mr-4 h-24 w-24">
                <p class="font-bold text-xl">{{ $shop->shop_name }}</p>
            </a>

            <header class="mt-2 mx-2 px-5 py-4 border-b border-t border-gray-100 bg-gradient-to-r from-blue-700 via-purple-500 to-blue-900 text-white font-bold rounded-xl drop-shadow-md">
                <h2>Pro</h2>
            </header>

                @forelse ($pro as $x)
                    <a href="{{ route('profile.show',$x->user_id) }}" method="get">
                        <div class="flex items-center px-5 py-4 hover:bg-gray-100">
                            <img src="{{ Storage::url($x->profile_image) }}" class="rounded-lg h-12 w-12 object-cover">
                            <div class="mx-4">{{ $x->user->name }}</div>
                        </div>
                    </a>
                    <hr class="mx-8">

                @empty
                    <p>メンバーがいません</p>
                @endforelse

            <header class="mt-2 mx-2 px-5 py-4 border-b border-t border-gray-100 bg-gradient-to-r from-blue-700 via-purple-500 to-pink-700 text-white font-bold rounded-xl drop-shadow-md">
                <h2>DM</h2>
            </header>

                @forelse ($dm as $x)
                    <a href="{{ route('profile.show',$x->user_id) }}" method="get">
                        <div class="flex items-center px-5 py-4 hover:bg-gray-100">
                            <img src="{{ Storage::url($x->profile_image) }}" class="rounded-lg h-12 w-12 object-cover">
                            <div class="mx-4">{{ $x->user->name }}</div>
                            <div class="ml-auto font-bold">{{ $x->dive_count }}</div>
                        </div>
                    </a>
                    <hr class="mx-8">
                @empty
                    <p>メンバーがいません</p>
                @endforelse

            <header class="mt-2 mx-2 px-5 py-4 border-b border-t border-gray-100 bg-gradient-to-r from-blue-700 via-purple-500 to-yellow-600 text-white font-bold rounded-xl drop-shadow-md">
                <h2>MSD</h2>
            </header>

                @forelse ($msd as $x)
                <a href="{{ route('profile.show',$x->user_id) }}" method="get">
                    <div class="flex items-center px-5 py-4 hover:bg-gray-100">
                        <img src="{{ Storage::url($x->profile_image) }}" class="rounded-lg h-12 w-12 object-cover">
                        <div class="mx-4">{{ $x->user->name }}</div>
                        <div class="ml-auto font-bold">{{ $x->dive_count }}</div>
                    </div>
                </a>
                <hr class="mx-8">
                @empty
                    <p>メンバーがいません</p>
                @endforelse

            <header class="mt-2 mx-2 px-5 py-4 border-b border-t border-gray-100 bg-gradient-to-r from-blue-700  to-green-500 text-white font-bold rounded-xl drop-shadow-md">
                <h2>AOW</h2>
            </header>

                @forelse ($aow as $x)
                <a href="{{ route('profile.show',$x->user_id) }}" method="get">
                    <div class="flex items-center px-5 py-4 hover:bg-gray-100">
                        <img src="{{ Storage::url($x->profile_image) }}" class="rounded-lg h-12 w-12 object-cover">
                        <div class="mx-4">{{ $x->user->name }}</div>
                        <div class="ml-auto font-bold">{{ $x->dive_count }}</div>
                    </div>
                </a>
                <hr class="mx-8">
                @empty
                    <p>メンバーがいません</p>
                @endforelse

            <header class="mt-2 mx-2 px-5 py-4 border-b border-t border-gray-100 bg-gradient-to-r from-blue-700 to-blue-300 text-white font-bold rounded-xl drop-shadow-md">
            <h2>OW</h2>
            </header>

                @forelse($ow as $x)
                <a href="{{ route('profile.show',$x->user_id) }}" method="get">
                    <div class="flex items-center px-5 py-4 hover:bg-gray-100">
                        <img src="{{ Storage::url($x->profile_image) }}" class="rounded-lg h-12 w-12 object-cover">
                        <div class="mx-4">{{ $x->user->name }}</div>
                        <div class="ml-auto font-bold">{{ $x->dive_count }}</div>
                    </div>
                </a>
                <hr class="mx-8">
                @empty
                    <p>メンバーがいません</p>
                @endforelse
                {{-- メンバーのカードランクとダイブ本数の一覧ここまで --}}

        </div>
    </div>
</section>
{{-- <p class="button">TOP</p> --}}
</x-app-layout>

{{-- <script>

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


</script> --}}
