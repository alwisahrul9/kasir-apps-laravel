<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10rem;
            margin-top: 2.5rem;
        }

        th {
            background-color: #dddddd;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            
        }

        .kop_surat {
            position: relative;
        }

        img {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            margin: 0;
            padding: 0;
        }

        .line {
            border: 1px solid black;
            border-style: dashed;
        }
    </style>


    <div class="kop_surat">
        <img src="{{ url('assets/icon.png') }}" alt="">
        <h1 style="text-align: center">Shinsekai Food</h1>
        <p style="text-align: center; font-size: 12px">Jl. Jend. Sudirman RW No.415, Buluh Kasap, Kec. Dumai Tim., Kota Dumai, Riau 28826</p>
    </div>
    <div class="line"></div>
    <table>
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Menu
                </th>
                <th>
                    Stok
                </th>
                <th>
                    Terjual
                </th>
                <th>
                    Harga
                </th>
                <th>
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
                <tr>
                    <td>
                        {{ $no++ }}
                    </td>
                    <td>
                        {{ $item->nama }}
                    </td>
                    <td>
                        {{ $item->stok }}
                    </td>
                    <td>
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
                    <td>
                        @currency($item->harga)
                    </td>
                    <td>
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
                <td colspan="5" style="text-align: center">Total Pemasukan:</td>
                <td>@currency(array_sum($uangMasuk))</td>
            </tr>
        </tbody>
    </table>

    <h3 style="text-align: center">TERIMA KASIH ATAS KUNJUNGAN ANDA</h3>
</body>
<script>
    window.print()
</script>
</html>