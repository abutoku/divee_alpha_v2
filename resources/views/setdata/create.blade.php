<x-app-layout>
    {{-- ヘッダーロゴ部分 --}}
    <x-slot name="iconLeft">
        <a href="{{ route('setdata.index') }}" class="flex">
            <svg class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            <span class="ml-2 text-divenavy">back</span>
        </a>
    </x-slot>

    <x-slot name="iconRight">
        {{-- ロゴなし --}}
    </x-slot>

    <section class="mt-12">
        <p class="mb-8">データ入力</p>
        <form action="{{ route('setdata.store') }}" method="post">
            @csrf
            <table>
                <tr>
                    <th>
                        ポイント名
                    </th>
                    <td>
                        <input type="text" name="site_name">
                    </td>
                </tr>
                <tr>
                    <th>
                        現在の水温
                    </th>
                    <td>
                        <input type="number" name="temp">
                    </td>
                </tr>
                <tr>
                    <th>
                        都道府県コード
                    </th>
                    <td>
                        <input type="number" name="pc">
                    </td>
                </tr>
                <tr>
                    <th>
                        港コード
                    </th>
                    <td>
                        <input type="number" name="hc">
                    </td>
                </tr>
                <tr>
                    <th>
                        1月
                    </th>
                    <td>
                        <input type="number" name="jan">
                    </td>
                </tr>
                <tr>
                    <th>
                        2月
                    </th>
                    <td>
                        <input type="number" name="feb">
                    </td>
                </tr>
                <tr>
                    <th>
                        3月
                    </th>
                    <td>
                        <input type="number" name="mar">
                    </td>
                </tr>
                <tr>
                    <th>
                        4月
                    </th>
                    <td>
                        <input type="number" name="apr">
                    </td>
                </tr>
                <tr>
                    <th>
                        5月
                    </th>
                    <td>
                        <input type="number" name="may">
                    </td>
                </tr>
                <tr>
                    <th>
                        6月
                    </th>
                    <td>
                        <input type="number" name="jun">
                    </td>
                </tr>
                <tr>
                    <th>
                        7月
                    </th>
                    <td>
                        <input type="number" name="jul">
                    </td>
                </tr>
                <tr>
                    <th>
                        8月
                    </th>
                    <td>
                        <input type="number" name="aug">
                    </td>
                </tr>
                <tr>
                    <th>
                        9月
                    </th>
                    <td>
                        <input type="number" name="sep">
                    </td>
                </tr>
                <tr>
                    <th>
                        10月
                    </th>
                    <td>
                        <input type="number" name="oct">
                    </td>
                </tr>
                <tr>
                    <th>
                        11月
                    </th>
                    <td>
                        <input type="number" name="nov">
                    </td>
                </tr>
                <tr>
                    <th>
                        12月
                    </th>
                    <td>
                        <input type="number" name="dec">
                    </td>
                </tr>
            </table>
            <x-button class="mt-8">登録</x-button>
        </form>
    </section>

</x-app-layout>
