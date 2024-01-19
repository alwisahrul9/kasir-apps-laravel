@extends('layouts.default')

@section('content')
    <h1 class="text-center text-3xl font-medium mb-12">Pesan Makanan</h1>
    @if (session('gagal'))
        <div id="toast-top-right" class="z-50 fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 divide-x rtl:divide-x-reverse divide-gray-200 top-5 right-5" role="alert">
            <div id="toast-warning" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Warning icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('gagal') }}</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-warning" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    @if (session('berhasil'))
        <div id="toast-top-right" class="z-50 fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 divide-x rtl:divide-x-reverse divide-gray-200 top-5 right-5" role="alert">
            <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('berhasil') }}</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <div class="grid grid-cols-12 gap-3">
        <div class="lg:col-span-7 col-span-12 border shadow-lg p-5 rounded">
            <div class="mb-4 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Makanan</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Minuman</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Cemilan</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="grid xl:grid-cols-3 grid-cols-2 gap-3">
                        @foreach ($data->where('kategori_id', 1) as $item)
                            <div class="bg-white shadow relative">
                                <img class="h-[15rem] w-full" src="{{ url('storage/gambar/'.$item->gambar) }}" alt="">
                                <div class="px-3 pb-3">
                                    <h1 class="text-center text-lg font-semibold mb-3">{{ $item->nama }}</h1>
                                    <p class="text-sm">Harga / Porsi:</p>
                                    <p class="text-sm mb-2">@currency($item->harga)</p>
                                    <p class="text-sm">Stok:</p>
                                    <p class="text-sm mb-2">{{ $item->stok }}</p>
                                    <p class="text-sm">Kategori:</p>
                                    <p class="text-sm">{{ $item->kategori->nama }}</p>
                                </div>
                                <button
                                    id="btn_{{ $item->id }}"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-harga="{{ $item->harga }}"
                                    class="orderBtn absolute flex items-center gap-1 text-xs text-white py-1 px-2 bg-green-500 bottom-2 right-2 rounded">
                                    <svg class="w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                                    </svg>
                                    Pesan
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="grid xl:grid-cols-3 grid-cols-2 gap-3">
                        @foreach ($data->where('kategori_id', 2) as $item)
                            <div class="bg-white shadow relative">
                                <img class="h-[15rem] w-full" src="{{ url('storage/gambar/'.$item->gambar) }}" alt="">
                                <div class="px-3 pb-3">
                                    <h1 class="text-center text-lg font-semibold mb-3">{{ $item->nama }}</h1>
                                    <p class="text-sm">Harga / Porsi:</p>
                                    <p class="text-sm mb-2">@currency($item->harga)</p>
                                    <p class="text-sm">Stok:</p>
                                    <p class="text-sm mb-2">{{ $item->stok }}</p>
                                    <p class="text-sm">Kategori:</p>
                                    <p class="text-sm">{{ $item->kategori->nama }}</p>
                                </div>
                                <button
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-harga="{{ $item->harga }}"
                                    class="orderBtn absolute flex items-center gap-1 text-xs text-white py-1 px-2 bg-green-500 bottom-2 right-2 rounded">
                                    <svg class="w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                                    </svg>
                                    Pesan
                                </button>
                            </div>
                        @endforeach
                    </div>   
                </div>
                <div class="hidden p-4 rounded-lg" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <div class="grid xl:grid-cols-3 grid-cols-2 gap-3">
                        @foreach ($data->where('kategori_id', 3) as $item)
                            <div class="bg-white shadow relative">
                                <img class="h-[15rem] w-full" src="{{ url('storage/gambar/'.$item->gambar) }}" alt="">
                                <div class="px-3 pb-3">
                                    <h1 class="text-center text-lg font-semibold mb-3">{{ $item->nama }}</h1>
                                    <p class="text-sm">Harga / Porsi:</p>
                                    <p class="text-sm mb-2">@currency($item->harga)</p>
                                    <p class="text-sm">Stok:</p>
                                    <p class="text-sm mb-2">{{ $item->stok }}</p>
                                    <p class="text-sm">Kategori:</p>
                                    <p class="text-sm">{{ $item->kategori->nama }}</p>
                                </div>
                                <button
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-harga="{{ $item->harga }}"
                                    class="orderBtn absolute flex items-center gap-1 text-xs text-white py-1 px-2 bg-green-500 bottom-2 right-2 rounded">
                                    <svg class="w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                                    </svg>
                                    Pesan
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-5 col-span-12 border shadow-lg py-5 rounded">
            <h1 class="text-xl text-center font-semibold mb-4">Keranjang Pemesanan</h1>
            <form class="max-w-sm mx-auto" action="/order-makanan" method="POST">
                @csrf
                <div class="orderMenu">
                </div>
                <div class="mb-5">
                    <label for="no_meja" class="block mb-2 text-sm font-medium text-gray-900">No. Meja</label>
                    <input type="number" id="no_meja" name="no_meja" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-5">
                    <h1>Total Harga:</h1>
                    <span>Rp </span><input type="text" name="total" id="totalHarga" readonly style="outline-color: none; border: none" class="focus:ring-0 p-0"/>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </form>  
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        let menuId = []
        let menu = []
        let btnId = []
        var ke = -1;
        var hargaSebelumnya = 0
        $(".orderBtn").click(function(){
            var id = $(this).attr("data-id")
            var nama = $(this).attr("data-nama")
            var harga = $(this).attr("data-harga")
            var idBtn = $(this).attr("id")
            ke += 1
                        
            if(!menuId.includes(id)){
                menuId.push(id)
                btnId.push(idBtn)
                menu.push({
                    "id": id,
                    "harga": harga,
                })

                $(this).removeClass("absolute flex items-center gap-1 text-xs text-white py-1 px-2 bg-green-500 bottom-2 right-2 rounded")
                $(this).addClass("absolute flex items-center gap-1 text-xs text-white py-1 px-2 bg-red-500 bottom-2 right-2 rounded")

                var element = `<div id="${id}">
                                    <label for="menu" class="block mb-2 text-sm font-medium text-gray-900">Menu</label>
                                    <div class="flex gap-3 items-center">
                                        <input type="text" value="${nama}" name="menu[${ke}]" class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@flowbite.com" required>
                                        <input type="number" value="1" data-id="${id}" data-harga="${harga}" name="quantity[${ke}]" class="mb-5 quantity bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Jumlah" required>
                                        <button data-id="${id}" data-btn="${idBtn}"type="button" class="hapusOrder text-red-500 underline">
                                            Hapus
                                        </button>
                                    </div>
                                </div>`

                $(".orderMenu").append(element)

                let filter = menu.filter((item, index) => item.id === id)

                filter.map((item, index) => {
                    let totalPerItem = harga * 1
                    return item.harga = totalPerItem
                })

                let hasil = 0

                menu.forEach(item => {
                    hasil += item.harga
                })

                $("#totalHarga").val(hasil)
            }
        })

        $(document).on('input', ".quantity", function () {
            let id = $(this).attr("data-id")            
            let currentValue = $(this).val()
            let hargaPerItem = $(this).attr("data-harga")
            
            let filter = menu.filter(item => item.id === id)

            filter.map((item, index) => {
                let totalPerItem = hargaPerItem * currentValue
                return item.harga = totalPerItem
            })

            let hasil = 0

            menu.forEach(item => {
                hasil += item.harga
            })

            $("#totalHarga").val(hasil)
        });

        $(document).on('click', ".hapusOrder", function () {
            let id = $(this).attr("data-id")
            let idBtn = $(this).attr("data-btn")

            $(`#${id}`).remove()

            menu = menu.filter(item => {
                return item.id !== id
            })

            menuId = menuId.filter(item => {
                return item !== id
            })

            btnId = btnId.filter(item => {
                return item !== idBtn
            })

            let filter = menu.filter((item, index) => item.id === id)

            filter.map((item, index) => {
                let totalPerItem = harga * 1
                return item.harga = totalPerItem
            })

            if(!btnId.includes(idBtn)){
                $(`#${idBtn}`).removeClass("absolute flex items-center gap-1 text-xs text-white py-1 px-2 bg-red-500 bottom-2 right-2 rounded")
                $(`#${idBtn}`).addClass("absolute flex items-center gap-1 text-xs text-white py-1 px-2 bg-green-500 bottom-2 right-2 rounded")
            }

            let hasil = 0

            menu.forEach(item => {
                hasil += item.harga
            })
            
            $("#totalHarga").val(hasil)
        });

        $(document).on("input", "#no_meja", function(){
            var value = $(this).val()
            if(value <= 0){
                $(this).val("")
            }
        })
        
    </script>
@endsection