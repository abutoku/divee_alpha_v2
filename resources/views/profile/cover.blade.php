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


    {{-- プロフィールカバー画像変更 --}}
    <div>
        <div class="w-[400px] sm:w-[600px] mx-auto">
            <section>

                <div class="p-12">
                    {{-- 入力フォーム --}}
                    <form action="{{ route('profile.coverchange',$profile->id) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="flex justify-center">
                            {{-- プレビュー表示場所 --}}
                            @if($profile->cover_image)
                                <img src="{{ Storage::url($profile->cover_image) }}" id="demo_img"
                                    class="h-48 w-48 object-cover mb-12 bg-white">
                            @else
                                <img src="{{ Storage::url('uploads/no_image.png') }}" id="demo_img" class="h-48 w-48 object-cover mb-12 bg-white">
                            @endif
                        </div>
                        {{-- ファイル選択欄 --}}
                        <input type="file" name="cover_image" id="cover" class="mb-6"><br>
                        {{-- 変更ボタン --}}
                        <x-button>変更</x-button>
                    </form>
                    {{-- 入力フォームここまで --}}
                </div>

            </section>
        </div>
    </div>

</x-app-layout>
