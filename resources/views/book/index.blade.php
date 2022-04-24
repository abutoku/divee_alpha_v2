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

    <livewire:booksearch />

    </div>
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
