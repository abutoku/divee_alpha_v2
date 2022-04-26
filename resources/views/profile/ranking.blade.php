{{-- ヘッダー要素・コンポーネント ⏬⏬--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('RANKING') }}
        </h2>
    </x-slot>
{{-- ヘッダー要素・コンポーネント ⏫⏫--}}
<p>トータル本数ランキング</p>

    @foreach ($profiles as $profile)
        @if( $profile->card_rank == 'Pro')
        {{-- カードランクがProの場合ループをスキップ --}}
            @continue
        @endif
<a href="{{ route('profile.show',$profile->id) }}" method="get">
    <div class="flex items-center px-5 py-4">
        <img src="{{ Storage::url($profile->profile_image) }}" class="rounded-lg h-12 w-12">
        <div class="mx-4">{{ $profile->user->name }}</div>
        <div>{{ $profile->dive_count }}本</div>
    </div>
</a>
@endforeach

<p>2022年上半期ランキング .... Comming soon...!</p>
<p>2022年1月ランキング .... Comming soon...!</p>



{{-- ヘッダー要素・コンポーネント 閉じタグ⏬⏬--}}
</x-app-layout>
{{-- ヘッダー要素・コンポーネント 閉じタグ⏫⏫--}}
