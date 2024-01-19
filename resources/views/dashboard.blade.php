@extends('layouts.default')

@section('content')
    <h1 class="text-center text-3xl font-medium mb-12">Menu Makanan</h1>
    @include('modal.addMakanan')
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
    
    <div class="grid lg:grid-cols-5 sm:grid-cols-2 md:grid-cols-3 grid-cols-1 gap-3">
        @foreach ($data as $item)
            @php
                $harga = $item->harga
            @endphp
            <div class="bg-white shadow relative">
                <img class="h-[20rem] w-full" src="{{ url('storage/gambar/'.$item->gambar) }}" alt="">
                <div class="px-3 pb-3">
                    <h1 class="text-center text-lg font-semibold mb-3">{{ $item->nama }}</h1>
                    <p class="text-sm mb-2">Harga / Porsi: @currency($item->harga)</p>
                    <p class="text-sm mb-2">Stok: {{ $item->stok }}</p>
                    <p class="text-sm">Kategori: {{ $item->kategori->nama }}</p>
                </div>
                <div class="flex p-3 gap-2 justify-end">
                    <button
                        data-id="{{ $item->id }}"
                        data-nama="{{ $item->nama }}"
                        data-harga="{{ $item->harga }}"
                        data-stok="{{ $item->stok }}"
                        data-kategori="{{ $item->kategori->id }}"
                        data-modal-target="edit-modal"
                        data-modal-toggle="edit-modal"
                        class="edit py-1 px-2 bg-yellow-500 text-xs text-white">
                        Edit
                    </button>
                    @include('modal.editMakanan')

                    <button
                        data-id="{{ $item->id }}"
                        data-modal-target="hapus-modal"
                        data-modal-toggle="hapus-modal" 
                        class="hapus py-1 px-2 bg-red-500 text-xs text-white">
                        Hapus
                    </button>
                    @include('modal.hapusMakanan')
                </div>
            </div>
        @endforeach
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        let id;

        $('.edit').click(function() {
            id = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            var harga = $(this).attr('data-harga');
            var stok = $(this).attr('data-stok');
            var kategori = $(this).attr('data-kategori');
            $("#namaEdit").val(nama);
            $("#hargaEdit").val(harga);
            $("#stokEdit").val(stok);
            $("#kategori_idEdit").val(kategori);
        });

        $('.hapus').click(function() {
            id = $(this).attr('data-id');
            $("#deleteBtn").attr('href', `/hapus-makanan/${id}`);
        });

        const formEdit = document.getElementById('formEdit');
        function updated() {
            formEdit.method = 'POST'
            formEdit.action = '/update-makanan/' + id
            formEdit.submit()
        }
    </script>
@endsection