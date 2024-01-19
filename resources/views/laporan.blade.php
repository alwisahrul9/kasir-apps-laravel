@extends('layouts.default')

@section('content')
    <h1 class="text-center text-3xl font-medium mb-5">Rekap Laporan</h1>
    <div class="flex justify-between items-center mb-3">
        <h1 class="text-lg font-semibold">Rekap Laporan Bulanan</h1>
        <a href="/print-laporan" class="bg-orange-400 rounded px-4 text-white text-lg py-2">Print</a>
    </div>

    <div class="relative overflow-x-auto mb-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stok
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Terjual
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Pemasukkan
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1
                @endphp
                {{-- Array untuk menyimpan uang masuk --}}
                @php
                    $uangMasuk = [];
                @endphp
                @foreach ($data as $item)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $no++ }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->nama }}
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            {{ $item->stok }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- Buat Array --}}
                            @php
                                $array = []
                            @endphp
                            {{-- Lakukan perulangan dan masukkan data quantity ke array diatas --}}
                            @foreach ($item->order->where('tanggal', $now->toDateString()) as $data)
                                @php
                                    array_push($array, $data->pivot->quantity)
                                @endphp
                            @endforeach
                            {{-- Jumlahkan seluruh isi array --}}
                            @php
                                $totalTerjual = array_sum($array)
                            @endphp
                            {{-- Tampilkan jumlah --}}
                            @currency($totalTerjual)
                        </td>
                        <td class="px-6 py-4">
                            @currency($item->harga)
                        </td>
                        <td class="px-6 py-4">
                            {{-- Hitung total pemasukkan ($totalTerjual x harga per item) --}}
                            @php
                                $totalPemasukan = $totalTerjual * $item->harga;
                            @endphp
                            {{-- Tampilkan Pemasukkan --}}
                            @currency($totalPemasukan)
                            @php
                                array_push($uangMasuk, $totalPemasukan);
                            @endphp
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="border p-4 text-lg text-black font-semibold text-end">Total Pemasukan:</td>
                    <td class="border p-4 text-lg text-black font-semibold">@currency(array_sum($uangMasuk))</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h1 class="text-lg font-semibold mb-3">Riwayat Laporan</h1>
    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Pilih Tahun</label>
    <form id="sortingTahun">
        <select id="tahun" name="inputTahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block md:w-1/2 lg:w-1/4 w-full p-2.5">
            <option disabled selected>Pilih Tahun</option>
            @for ($i = $minYear; $i <= $maxYear; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </form>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        const form = document.getElementById('sortingTahun')
        $('#tahun').change(function() {
            var $option = $(this).find('option:selected');
            var value = $option.val();
            var text = $option.text();

            console.log(value);
            console.log(text);

            form.method = 'GET'
            form.action = '/generate-laporan'
            form.submit()
        });
    </script>
    <script>
        const ctx = document.getElementById('myChart');
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Agustus', 'September', 'Oktober', 'November', 'Desember']
        const data = {{ Js::from($dataTiapBulan) }}
        const tahun = {{ Js::from($inputTahun) }}
        
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: bulan,
            datasets: [{
              label: `Jumlah Orderan ${tahun}`,
              data: data,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    </script>
@endsection