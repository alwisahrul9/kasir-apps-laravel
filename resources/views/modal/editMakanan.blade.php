<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Edit Info Makanan
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" id="formEdit" onsubmit="updated()" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        @error('nama')
                            <div class="px-4 py-2.5 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <span class="font-medium">Oops!</span> Nama wajib diisi.
                            </div>
                        @enderror
                        <input type="text" name="nama" value="{{ old('nama') }}" id="namaEdit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" placeholder="Nama Makanan" required>
                    </div>
                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                        @error('harga')
                            <div class="px-4 py-2.5 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <span class="font-medium">Oops!</span> Harga berupa angka.
                            </div>
                        @enderror 
                        <input type="text" name="harga" value="{{ old('harga') }}" id="hargaEdit" placeholder="Harga per Porsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                        @error('stok')
                            <div class="px-4 py-2.5 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <span class="font-medium">Oops!</span> Stok berupa angka.
                            </div>
                        @enderror 
                        <input type="text" name="stok" value="{{ old('stok') }}" id="stokEdit" placeholder="Stok Makanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="kategori_id" class="block mb-2 text-sm font-medium text-gray-900">Ketegori</label>
                        @error('kategori_id')
                            <div class="px-4 py-2.5 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <span class="font-medium">Oops!</span> Kategori wajib diisi.
                            </div>
                        @enderror 
                        <select id="kategori_idEdit" name="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" required>
                            <option selected>Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>  
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="gambar">Upload Gambar</label>
                        @error('gambar')
                            <div class="px-4 py-2.5 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <span class="font-medium">Oops!</span> Gambar berupa JPG, JPEG atau PNS maksimal 3MB.
                            </div>
                        @enderror 
                        <input type="file" id="gambar" name="gambar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none">
                    </div>
                    <button type="submit" class="w-full text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>