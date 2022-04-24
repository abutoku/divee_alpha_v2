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

    {{-- 保存完了の表示 --}}
    @if(session('status'))
    <div id="flash_message" class="text-green-700 p-3 bg-green-300 rounded mt-16 mb-3 flex justify-center">
        {{ session('status') }}
    </div>
    @endif

    <section class="mt-16">
        <a href="{{ route('divemap.create') }}">
            <x-button class="p-4">
                <svg class="h-5 w-5 text-white mr-2"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />  <polyline points="7 10 12 15 17 10" />  <line x1="12" y1="15" x2="12" y2="3" />
                </svg>水中地図登録
            </x-button>
        </a>
    </section>

    <section class="mt-16">
        <div class="flex flex-col items-center">
            @foreach ($divemaps as $divemap)
            <div class="flex items-center bg-white  drop-shadow-md rounded-md w-[350px] sm:w-[600px] h-40 my-5 overflow-hidden">
                <img class="h-40 w-36 object-cover" src="{{ Storage::url($divemap->image) }}">

                <div class="w-full flex justify-between">

                    <p class="ml-6 text-lg font-bold">{{$divemap->map_name}}</p>

                    <div x-data="{ open:false }" @click.away="open = false" @close.stop="open = false" class="flex flex-col items-end ml-auto">

                        <button @click="open = !open" class="mr-6">
                            <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="12" cy="19" r="1" />
                                <circle cx="12" cy="5" r="1" />
                            </svg>
                        </button>

                        {{-- 削除ボタン --}}
                        <form x-show="open" x-cloak x-transition action="{{ route('divemap.destroy',$divemap->id )}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="mt-6 py-2 px-4 border rounded-lg">削除</button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </section>

</x-app-layout>
