<x-layout>
    <!-- Form Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Product</h2>

            <form action="{{ route('products.update', $product->id) }}" method="POST" id="productForm" class="space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Nama Barang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Barang
                    </label>
                    <input type="text" required name="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('name', $product->name) }}">
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori
                    </label>
                    <select required name="category_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <input type="number" name="price" id="price"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('price', $product->price) }}">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="description" id="description" cols="20" rows="5"
                        class="w-full border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Tanggal Masuk -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Masuk
                    </label>
                    <input type="date" required name="entry_date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('entry_date', $product->entry_date) }}">
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Stock
                    </label>
                    <input type="number" required min="1" name="stock"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('stock', $product->stock) }}">
                </div>

                <!-- Foto Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Foto Produk
                    </label>
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload file</span>
                                        <input id="file-upload" name="image" type="file" class="sr-only"
                                            accept="image/*" onchange="previewImage(event)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 2MB
                                </p>
                            </div>
                            <div id="image-preview-container">
                                @if ($product->image && file_exists(public_path('storage/' . $product->image)))
                                    <img id="preview" src="{{ asset('storage/' . $product->image) }}"
                                        class="mt-4 max-h-48 rounded-lg" alt="Preview">
                                @elseif ($product->image && file_exists(public_path('img/product/' . $product->image)))
                                    <img id="preview" src="{{ asset('img/product/' . $product->image) }}"
                                        class="mt-4 max-h-48 rounded-lg" alt="Preview">
                                @else
                                    <img id="preview" src="{{ asset('img/product/default.jpg') }}"
                                        class="mt-4 max-h-48 rounded-lg" alt="Preview">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>

<script>
    // Fungsi untuk menampilkan pratinjau gambar baru
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        // Pastikan file yang diunggah adalah gambar
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden'); // Menampilkan gambar pratinjau
            };

            reader.readAsDataURL(file);
        }
    }
</script>
