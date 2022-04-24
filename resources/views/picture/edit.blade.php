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

<div class="mt-12 flex justify-center">
    {{-- 入力フォーム --}}
    <form action="{{ route('picture.update',$post->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        {{-- ファイル選択欄 --}}
        <input type="file" name="picture" id="post_picture" class="mb-12">
        {{-- プレビュー表示場所 --}}
        <img src="{{ Storage::url('uploads/no_image.png') }}" id="demo_picture" class="mb-4 h-48 object-cover">
        {{-- 登録ボタン --}}
        <x-button class="mb-12">登録</x-button>

    </form>
    {{-- 入力フォームここまで --}}
</div>
<div class="flex justify-center">
    <a href="{{ route('post.index') }}"><x-button>登録終了</x-button></a>
</div>


    {{-- ---------写真表示部分---------------- --}}
<div class="flex justify-center">
    @foreach ($post->pictures as $picture)
        <img src="{{ Storage::url($picture->picture) }}" class="h-48 mt-8 object-cover">
    @endforeach
</div>
    {{-- ---------写真表示部分ここまで---------------- --}}

</x-app-layout>
