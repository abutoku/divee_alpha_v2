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
    <section class="flex mt-16 mb-8 justify-center sm:justify-start">
        <a href="{{ route('map.post') }}" class="rounded-2xl py-1 w-[200px] mr-4 border-2 border-divenavy text-divenavy flex justify-around">
            MAP</a>
        <div class="rounded-2xl py-1 w-[200px] border-2 border-divenavy  bg-divenavy text-white flex justify-around">
            タイムライン</a>
    </section>


    {{-- -----一覧表示部分--------- --}}
    <section>

        <div class="flex flex-col items-center">
            @foreach ($posts as $post)
            {{-- サムネイル画像がある場合 --}}
            @if($post->thumbnail)
            <a href="{{ route('post.show',$post->id) }}" class="bg-white  drop-shadow-md rounded-md w-[350px] sm:w-[600px] h-40 my-5 overflow-hidden">
                <div class="flex justify-between">
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <img src="{{ Storage::url($post->user->profile->profile_image) }}" alt="profilepic"
                                class="rounded-full h-8 w-8 object-cover mr-2">
                            <div>{{ $post->user->name }}</div>
                        </div>
                        <p class="mb-2 text-xs">{{$post->date}}</p>
                        <p class="mb-2 font-bold">{{$post->title}}</p>
                        <p>{!! nl2br(e($post->message)) !!}</p>
                    </div>
                    <img class="h-40 w-36 object-cover rounded-r-lg" src="{{ Storage::url($post->thumbnail) }}">
                </div>
            </a>
            {{-- サムネイル画像が無い場合 --}}
            @else
            <a href="{{ route('post.show',$post->id) }}"
                class="bg-white drop-shadow-md rounded-lg w-[350px] sm:w-[600px] h-36 my-5 p-4 overflow-hidden">
                <div class="flex items-center mb-4">
                    <img src="{{ Storage::url($post->user->profile->profile_image) }}" alt="profilepic"
                        class="rounded-full h-8 w-8 object-cover mr-2">
                    <div>{{ $post->user->name }}</div>
                </div>
                <p class="mb-2">{{$post->date}}</p>
                <p>{!! nl2br(e($post->message)) !!}</p>
            </a>
            @endif
            @endforeach

        </div>

    </section>
    {{-- -----一覧表示部分--------- --}}

</x-app-layout>
