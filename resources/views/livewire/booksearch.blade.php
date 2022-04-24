<div>
    <input type="text" id="search" placeholder="名前検索" class="mt-16 rounded-lg border-2 border-divenavy" wire:model="searchWord">

    <div class="flex flex-col items-center mt-8">
        @forelse ($books as $book)
            <a href="{{ route('book.show',$book->id) }}" class="bg-white  drop-shadow-md rounded-lg w-[400px] sm:w-[650px] h-24 sm:h-40 my-5 overflow-hidden hover:bg-gray-100">
                <div class="flex justify-between items-start sm:items-center">
                    <div class="p-4">
                        <p class="font-bold text-sm sm:text-xl">{{$book->fish_name}}</p>
                    </div>
                    @if($book->picture)
                    {{-- 画像がある場合 --}}
                    <img class="h-24 sm:h-40 w-36 object-cover rounded-r-lg" src="{{ Storage::url($book->picture) }}">
                    {{-- 画像が無い場合 --}}
                    @else
                    <img class="h-24 sm:h-40 w-36 object-cover rounded-r-lg" src="{{ Storage::url('uploads/no_image.png') }}">
                    @endif
                </div>
            </a>
        @empty
            <p class="mt-12">まだ投稿がありません</p>
        @endforelse
    </div>

</div>
