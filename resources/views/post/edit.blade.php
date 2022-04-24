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

    {{-- ------ログの更新（編集）画面------- --}}

    {{-- ------入力フォーム-------------- --}}
    <div class="flex justify-center mt-10">
        <form action="{{ route('post.update',$post->id) }}" method="POST" class="mt-10">
            @method('put')
            @csrf
            <div>
                <div>date</div>
                <div><input type="date" name="date" value="{{ $post->date}}" class="rounded-lg border-2 border-divenavy w-[250px] sm:w-[300px] mb-6"></div>
            </div>

            <div>
                <div>title</div>
                <div><input type="text" name="title" value="{{ $post->title}}" class="rounded-lg border-2 border-divenavy w-[250px] sm:w-[300px] mb-6"></div>
            </div>

            <div>
                <div>コメント</div>
                <div><textarea name="message" class="rounded-lg border-2 border-divenavy h-36 w-[250px] sm:w-[300px]">{{ $post->message}}</textarea></div>
            </div>

            <x-button class="mt-6 mb-12">更新</x-button>
        </form>
    </div>
    {{-- ------入力フォームここまで-------------- --}}

<hr>
<div class="flex flex-col justify-center items-center mt-10">

    <x-button id="select_picture" class="mb-2">サムネイル変更</x-button>

    <div id="thumbnail_view">
        <p>一覧画面に表示する画像を選択してください</p>
        <div class="flex justify-center">
        @foreach ($post->pictures as $picture)
        <form action="{{ route('picture.change',$picture->id)}}" method="post">
            @csrf
            <button>
                <img src="{{ Storage::url($picture->picture) }}" class="h-48 object-cover">
            </button>
        </form>
        @endforeach
        </div>
    </div>

    <x-button id="delete_picture">写真を削除</x-button>

    <div id="delete_view">
        <p>削除する画像を選んでください</p>
        <div class="flex justify-center">
        @foreach ($post->pictures as $picture)
        <form action="{{ route('picture.destroy',$picture->id ) }}" method="post">
            @method('DELETE')
            @csrf
            <button>
                <img src="{{ Storage::url($picture->picture) }}" class="h-48 object-cover">
            </button>
        </form>
        @endforeach
        </div>

    </div>
</div>


</x-app-layout>
