<x-layout>
    <div class="container max-w-screen-lg mx-auto py-6">
        <!-- Heading Section -->
        <div class="mb-6">
            <h2 class="font-semibold text-2xl text-gray-800">Form Transaksi Barang</h2>
            <p class="text-gray-600 text-sm mt-1">Isi detail transaksi barang di bawah ini.</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('transactions.record') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Product Name and Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm px-4 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama produk" required>
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" id="category"
                            class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm px-4 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          
                        </select>
                    </div>
                </div>

                <!-- Transaction Type and Quantity -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Transaksi</label>
                        <div class="mt-2 flex items-center space-x-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="type" value="in" class="form-radio text-blue-600"
                                    required>
                                <span class="ml-2 text-gray-700">Masuk</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="type" value="out" class="form-radio text-blue-600">
                                <span class="ml-2 text-gray-700">Keluar</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" min="1"
                            class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm px-4 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan jumlah" required>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan deskripsi transaksi" required></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="resetForm()"
                        class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded-md shadow-sm transition duration-150 ease-in-out">
                        Reset
                    </button>
                    <button type="submit"
                        class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md shadow-sm transition duration-150 ease-in-out">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
<script>
    function resetForm() {
        document.getElementById('transactionForm').reset();
    }
</script>
