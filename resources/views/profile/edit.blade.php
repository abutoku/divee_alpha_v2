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

{{-- -----プロフィールの写真登録----- --}}
<div>
    <div class="w-[400px] sm:w-[600px] mx-auto">

        <div class="p-12">
            {{-- 入力フォーム --}}
            <form action="{{ route('profile.update',$profile->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="flex justify-center">
                    {{-- プレビュー表示場所 --}}
                    <img src="{{ Storage::url($profile->profile_image) }}" id="demo_img" class="rounded-full h-48 w-48 object-cover mb-12 bg-white" >
                </div>
                    {{-- ファイル選択欄 --}}
                    <input type="file" name="profile_image" id="profile_image" class="mb-6"><br>
                    {{-- 変更ボタン --}}
                    <x-button>変更</x-button>
            </form>
            {{-- 入力フォームここまで --}}
        </div>
    </div>

</div>


</x-app-layout>
