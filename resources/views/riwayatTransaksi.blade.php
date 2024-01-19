@extends('layouts.default')

@section('content')
    <h1 class="text-center text-3xl font-medium mb-12">Riwayat Transaksi</h1>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NO Meja
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pesanan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tindakan
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1
                @endphp
                @foreach ($data->where('active', 'not') as $item)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $no++ }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->no_meja }}
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <ul class="list-disc">
                                @foreach ($item->menu as $data)
                                    <li>{{ $data->nama }} :</li>
                                @endforeach
                            </ul>
                            <ul>
                                @foreach ($item->menu as $data)
                                    <li>{{ $data->pivot->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-6 py-4">
                            @currency($item->total)
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->updated_at->format("d M Y") }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/print-transaksi/{{ $item->id }}">
                                <svg class="w-5 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z"/>
                                    <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        let totalHarga;
        let id;

        $("#deleteBtn").click(function(){
            id = $(this).attr("data-id")

            $("#deleteConfirm").attr("href", `/hapus-order/${id}`)
        })

        $("#transaksiBtn").click(function(){
            id = $(this).attr("data-id")
            totalHarga = $(this).attr("data-total")

            $("#totalPesanan").html(`Rp ${totalHarga}`)

            $("#kirimTransaksi").attr("href", `/transaksi-orderan/${id}`)
        })

        $(document).on("input", "#uang", function(){
            var nominal = $(this).val()
            if(nominal <= 0){
                $(this).val("")
            }

            var total = totalHarga - nominal
            
            $("#kembalian").html(`Rp ${total}`)
        })

        const formUpdate = document.getElementById('formUpdate');
        function updated() {
            formUpdate.method = 'POST'
            formUpdate.action = '/transaksi-orderan/' + id
            formUpdate.submit()
        }
    </script>
@endsection