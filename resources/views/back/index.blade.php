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


    <section class="mt-12">

        <ul>
            <li>
                <a href="{{ route('setdata.index') }}">データ一覧</a>
            </li>
            <li>
                <a href="{{ route('setdata.create') }}">データ入力</a>
            </li>
        </ul>

    </section>


</x-app-layout>
