
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

{{-- -----ログの中身とコメント表示ページ ---}}

<div class="flex justify-center">
    <div class="p-6 mt-12 rounded-lg shadow-md bg-white w-[350px] sm:w-[600px]">

    {{-- ---------写真表示部分---------------- --}}
    <div class="flex justify-between">
        <div class="flex items-center">
            <img src="{{ Storage::url($post->user->profile->profile_image) }}" alt="profilepic" class="rounded-full object-cover h-8 w-8 mr-2">
            <p class="pt-1 ml-2 font-bold text-sm">{{$post->user->name}}</p>
        </div>
        <div>
            <p class="text-xs">{{ $post->date }}</p>
        </div>
    </div>

{{-- -------ログの詳細表示部分------------ --}}
    <section class="flex flex-col mt-8 ">
        <p class="font-bold text-xl mb-4">{{ $post->title }}</p>
        <p>{!! nl2br(e($post->message)) !!}</p>
    </section>
    {{-- ------ログの詳細表示部分ここまで----- --}}
    <section class="flex flex-col mt-8 ">
        @foreach ($post->pictures as $picture)
        <img src="{{ Storage::url($picture->picture) }}" class="mt-2  rounded-lg object-cover">
        @endforeach
    </section>

    {{-- ---------写真表示部分ここまで---------------- --}}

    <div class="flex justify-end mt-8">
        {{-- ------いいねボタン表示部分------------ --}}
        <!-- favorite 状態で条件分岐 -->
        {{-- 中間テーブルのuser_idとログインユーザーのidが一致するデータを取得 --}}
        @if($post->users()->where('user_id', Auth::id())->exists())
        {{-- データがある場合はunfavoriteボタンを表示 --}}
        <!-- unfavorite ボタン -->
        <form action="{{ route('unfavorites',$post) }}" method="POST" class="text-left">
            @csrf
            <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{-- log_users_tableから$logに対応する件数を表示 --}}
                {{ $post->users()->count() }}
            </button>
        </form>
        {{-- データが無い場合はunfavoriteボタンを表示 --}}
        @else
        <!-- favorite ボタン -->
        <form action="{{ route('favorites',$post) }}" method="POST" class="text-left">
            @csrf
            <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-gray-500 py-1 px-2 focus:outline-none focus:shadow-outline">
                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{-- log_users_tableから$logに対応する件数を表示 --}}
                {{ $post->users()->count() }}
            </button>
        </form>
        @endif
        {{-- ------いいねボタン表示部分ここまで------------ --}}

        {{-- ------ログの更新、削除ボタン表示部分----------- --}}
        {{-- もしlogのuser_idとログイン中のユーザーのidが一致したら削除ボタンと更新ボタンを表示 --}}
        @if ($post->user_id === Auth::user()->id)
        {{-- 縦三点リーダー --}}
        <div x-data="{ open:false }" @click.away="open = false" @close.stop="open = false" class="flex flex-col items-end">
            <button @click="open = !open">
                <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="12" cy="19" r="1" />
                    <circle cx="12" cy="5" r="1" />
                </svg>
            </button>
            <div x-show="open" x-transition class="absolute border rounded-lg bg-white p-4 flex flex-col justify-center mt-6" x-cloak>
                {{-- 削除ボタン --}}
                <form action="{{ route('post.destroy',$post->id )}}" method="post">
                    @method('delete')
                    @csrf
                    <button>削除</button>
                </form>
                {{-- 更新ボタン --}}
                <form action="{{ route('post.edit',$post->id )}}" method="get">
                    @csrf
                    <button>編集</button>
                </form>
                {{-- 写真追加ボタン --}}
                <form action="{{ route('picture.edit',$post->id) }}" method="get">
                    <button>写真を追加</button>
                </form>

            </div>
        </div>
        @endif{{-- 削除ボタン表示の条件分岐ここまで--}}

    </div>
    {{-- ------ボタン表示部分ここまで----------- --}}

    <hr>
    {{-- -------コメント入力欄------ --}}
    <h2 class="mt-10">コメント</h2>
    <form method="post" action="{{ route('comment.store', $post ) }}" class="flex flex-col">
        @csrf
        <textarea name="comment" class="rounded-lg border-2 border-divenavy"></textarea>
        <x-button class="my-2 text-center mx-auto mb-12">送信</x-button>
    </form>
    {{-- -------コメント入力欄ここまで------ --}}
<hr>
    {{-- -------投稿コメント表示場所--------- --}}

    <div class="mt-4">
        {{-- comments()とすることで条件の指定が可能 --}}
        @foreach ($post->comments()->latest()->get() as $comment)
            <div class="flex justify-between mt-6">
                <div class="flex justify-start items-center">
                    <img src="{{ Storage::url( $comment->user->profile->profile_image) }}" class="rounded-full h-8 w-8 mr-2 mb-4">
                    <p>{{ $comment->user->name }}</p>
                </div>
                {{-- もしlogのuser_idとログイン中のユーザーのidが一致したら削除ボタンを表示 --}}
                @if ($comment->user_id === Auth::user()->id)
                    {{-- 縦三点リーダー --}}
                    <div x-data="{ open:false }" @click.away="open = false" @close.stop="open = false" class="flex flex-col items-end">
                        <button @click="open = !open">
                            <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="12" cy="19" r="1" />
                                <circle cx="12" cy="5" r="1" />
                            </svg>
                        </button>
                        {{-- 削除ボタン --}}
                        <form x-show="open" x-cloak x-transition action="{{ route('comment.destroy',$comment )}}" method="post" >
                            @method('delete')
                            @csrf
                            <button class=" border rounded-lg bg-white p-4">削除</button>
                        </form>
                    </div>
                @endif{{-- 削除ボタン表示の条件分岐ここまで--}}
            </div>

            <div class="mx-auto w-full  my-4"> {!! nl2br(e($comment->comment)) !!}</div>
            <hr>
        @endforeach
    </div>
    {{-- -------投稿コメント表示場所ここまで--------- --}}

    </div>
</div>

</x-app-layout>
