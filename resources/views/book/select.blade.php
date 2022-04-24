<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ route('book.index') }}" class="flex">
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

    <section class="mt-16">

        <p>画像を選択してください</p>

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form action="{{ route('book.change',$book->id ) }}" method="post" class="flex justify-around flex-wrap">
            @csrf
            <input type="hidden" id="log_id" name="log_id">
                @foreach ($logs as $log)
                    @if($log->image)
                    <button>
                        <img src="{{ Storage::url($log->image) }}" id="{{ $log->id }}" class="h-48 mt-8 object-cover">
                    </button>
                    @endif
                @endforeach
        </form>

    </section>

</x-app-layout>

<script>

    $('img').on('click',function(){
        $('#log_id').val(this.id);
    });

</script>
