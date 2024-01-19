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
        <tr>
            <th>Menu</th>
            <th>Quantity</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        @php
            $totalSemua = []
        @endphp
        @foreach ($find->menu as $item)
            @php
                $subTotal = $item->harga * $item->pivot->quantity
            @endphp
            @php
                array_push($totalSemua, $subTotal)
            @endphp
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->pivot->quantity }}</td>
                <td>@currency($item->harga)</td>
                <td>@currency($subTotal)</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: center; font-size: 1rem">Total:</td>
            <td style="text-align: center; font-size: 1rem">@currency(array_sum($totalSemua))</td>
        </tr>
    </table>

    <h3 style="text-align: center">TERIMA KASIH ATAS KUNJUNGAN ANDA</h3>
</body>
<script>
    window.print()
</script>
</html>