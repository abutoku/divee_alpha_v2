<x-guest-layout>
    {{-- 新規登録→プロフィール登録画面 --}}
    <x-auth-card>

        {{-- ロゴ表示部分 --}}
        <x-slot name="logo">
            <a href="/">
                <x-application-logo/>
            </a>
        </x-slot>

        {{-- プロフィール入力フォーム --}}
        <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data"
        class="p-6">
            @csrf
                <div class="ml-14">
                    <p class="text-divenavy text-sm">カードランク</p>
                    {{-- カードの種類 --}}
                    <select name="card_rank" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-divenavy">
                        <option value="Pro">Pro</option>
                        <option value="DM">DM</option>
                        <option value="MSD">MSD</option>
                        <option value="AOW">AOW</option>
                        <option value="OW">OW</option>
                    </select>
                </div>

                <div class="my-6 ml-14">
                    {{-- 今まで潜った本数 --}}
                    <p class="text-divenavy text-sm" >ダイブ本数</p>
                    <input type="number" name="dive_count" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    DIVE
                </div>

            <x-button class="mt-4 ml-64">登録</x-button>
        </form>

    </x-auth-card>
</x-guest-layout>
