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

    {{-- ポイント選択部分 --}}
    <section class="mt-12">
        <form action="{{ route('tide.select') }}" method="post">
            @csrf
            <select name="site" class="rounded-lg border-2 border-divenavy">
                <option disabled selected value>ポイントを選択</option>
                @foreach ($points as $point)
                    <option value="{{ $point->id }}"
                        {{ isset($val) && $point->id === $val ? 'selected' : ''}}>
                        {{ $point->site_name }}
                    </option>
                @endforeach
            </select>
            <x-button>表示切り替え</x-button>
        </form>
    </section>

    {{-- 情報表示部分 --}}
    <section class="mt-2 flex justify-center">
        <div class="bg-white drop-shadow-md rounded-lg w-[480px] sm:w-[600px] h-54 mt-4 mb-6 p-8">

            {{-- @dd($tide); --}}
            <h1 class="font-bold text-2xl mb-8">{{ $name }}</h1>
            <div class="flex justify-between">
                <div>
                    <p class="font-bold text-3xl mb-4" >{{ $tide['moon']['title'] }}</p>
                    <div class="flex justify-center">
                        <p class="text-sm">現在の水温 :
                            <span class="font-bold text-xl sm:text-3xl">
                                {{ $temp }}℃
                            </span>
                        </p>

                    </div>
                </div>

                <div class="flex">
                    <div class="mr-8">
                        <p class="font-bold">干潮</p>
                        <p>{{ $tide['edd'][0]['time'] }}</p>
                        @if (isset($tide['edd'][1]))
                            <p>{{ $tide['edd'][1]['time']}}</p>
                        @else
                            <p>情報無し</p>
                        @endif
                    </div>

                    <div>
                        <p class="font-bold">満潮</p>
                        <p>{{ $tide['flood'][0]['time'] }}</p>
                        @if (isset($tide['flood'][1]))
                            <p>{{ $tide['flood'][1]['time']}}</p>
                        @else
                            <p>情報無し</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- グラフ表示部分 --}}
    <section class="flex justify-center flex-col items-center">
        <p>水温グラフ</p>
        <div class="w-[480px] sm:w-[600px] h-[350px] bg-slate-50 border-2 rounded-lg border-divenavy">
            <canvas id="my_chart"></canvas>
        </div>
    </section>

    <!-- Chart.js読み込み -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <script>
        'use strict';

        const num = @json($num);

        //折れ線グラフ
        var type = 'line';

        var data = {
            labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets:[
                {
                    data:[
                        num[0],
                        num[1],
                        num[2],
                        num[3],
                        num[4],
                        num[5],
                        num[6],
                        num[7],
                        num[8],
                        num[9],
                        num[10],
                        num[11],
                        ],
                    borderColor:'skyblue',
                    pointBackgroundColor:'skyblue',
                    borderWidth:4,
                }
            ]
        };

        var options = {
            layout: {
                padding: {
                    left: 50,
                    right: 50,
                    top: 50,
                    bottom: 0
                }
            },
            scales:{
                y: {
                // suggestedMin:0,
                beginAtZero: true,
                suggestedMax:30,
                },
            },
            plugins: {
                legend: {
                    display: false, //凡例の非表示
                },
            },
        };

        //canvasを描画するためのctxを取得
        var ctx = document.getElementById('my_chart').getContext('2d');

        //上記をmyChartに渡す
        var myChart = new Chart(ctx,{
        type: type,
        data: data,
        options: options,
        });

    </script>
</x-app-layout>
