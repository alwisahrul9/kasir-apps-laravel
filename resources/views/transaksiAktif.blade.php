@extends('layouts.default')

@section('content')
    <h1 class="text-center text-3xl font-medium mb-12">Transaksi Aktif</h1>
    @if (session('status'))
        <div id="toast-top-right" class="z-50 fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 divide-x rtl:divide-x-reverse divide-gray-200 top-5 right-5" role="alert">
            <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('status') }}</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <div class="relative overflow-x-auto mb-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No Meja
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pesanan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
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
                @foreach ($data as $item)
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
                        <td class="px-6 py-4 flex gap-3">
                            <!-- Modal toggle -->
                            <button
                                id="transaksiBtn"
                                data-id="{{ $item->id }}"
                                data-total="{{ $item->total }}"
                                data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                Selesaikan Transaksi
                            </button>
                            @include('modal.transaksi')

                            
                            <button
                                id="deleteBtn"
                                data-id="{{ $item->id }}"
                                data-modal-target="popup-modal"
                                data-modal-toggle="popup-modal"
                                class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center" type="button">
                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                    <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
                                </svg>
                            </button>
                            @include('modal.hapusOrder')    
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

        function toRupiah(nominal){
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(nominal)
        }
        
        $("#deleteBtn").click(function(){
            id = $(this).attr("data-id")

            $("#deleteConfirm").attr("href", `/hapus-order/${id}`)
        })

        $("#transaksiBtn").click(function(){
            id = $(this).attr("data-id")
            totalHarga = $(this).attr("data-total")

            $("#totalPesanan").html(`${toRupiah(totalHarga)}`)

            $("#kirimTransaksi").attr("href", `/transaksi-orderan/${id}`)
        })

        $(document).on("input", "#uang", function(){
            var nominal = $(this).val()
            if(nominal <= 0){
                $(this).val("")
            }

            var total = totalHarga - nominal
            
            $("#kembalian").html(`${toRupiah(total)}`)
        })

        const formUpdate = document.getElementById('formUpdate');
        function updated() {
            formUpdate.method = 'POST'
            formUpdate.action = '/transaksi-orderan/' + id
            formUpdate.submit()
        }
    </script>
@endsection