@vite(['resources/css/app.css', 'resources/js/app.js'])

<section class="bg-gradient-to-r from-blue-400 via-teal-500 to-blue-600 py-20">
    <div class="container mx-auto px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white text-center mb-8">ubah data</h1>
        <form action="{{ route('books.update', $books->id) }}" method="POST"
            class="bg-white rounded-xl shadow-2xl p-8 space-y-6 max-w-4xl mx-auto backdrop-blur-sm">
            @csrf
            @method('PUT')

            <!-- Input Judul Buku -->
            <div>
                <label for="judul" class="block mb-2 text-lg font-medium text-gray-700 dark:text-white">Judul
                    Buku</label>
                <input value="{{ $books->judul_buku }}" type="text" name="judul_buku" id="judul_buku"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500 transition-all ease-in-out shadow-inner"
                    placeholder="Masukkan Judul Buku" required>
            </div>

            <!-- Input Penulis -->
            <div>
                <label for="penulis"
                    class="block mb-2 text-lg font-medium text-gray-700 dark:text-white">Penulis</label>
                <input value="{{ $books->penulis }}" type="text" name="penulis" id="penulis"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500 transition-all ease-in-out shadow-inner"
                    placeholder="Masukkan Nama Penulis" required>
            </div>

            <!-- Input Kategori -->
            <div>
                <label for="kategori"
                    class="block mb-2 text-lg font-medium text-gray-700 dark:text-white">Kategori</label>
                <select id="kategori" name="kategori"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500 transition-all ease-in-out shadow-inner">
                    <option value="Novel" {{ $books->kategori == 'Novel' ? 'selected' : '' }}>Novel</option>
                    <option value="Fiksi" {{ $books->kategori == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                    <option value="Pendidikan" {{ $books->kategori == 'Pendidikan' ? 'selected' : '' }}>Pendidikan
                    </option>
                    <option value="Sejarah" {{ $books->kategori == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                    <option value="Biografi" {{ $books->kategori == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                </select>
            </div>

            <!-- Input Status -->
            <div>
                <label for="status"
                    class="block mb-2 text-lg font-medium text-gray-700 dark:text-white">Status</label>
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500 transition-all ease-in-out shadow-inner">
                    <option value="1" {{ $books->status == '1' ? 'selected' : '' }}>Tersedia</option>
                    <option value="0" {{ $books->status == '0' ? 'selected' : '' }}>Tidak
                        Tersedia</option>
                </select>
            </div>

            <!-- Input Tahun Terbit -->
            <div>
                <label for="tahun_terbit" class="block mb-2 text-lg font-medium text-gray-700 dark:text-white">Tahun
                    Terbit</label>
                <input value="{{ $books->tahun_terbit }}" type="date" name="tahun_terbit" id="tahun_terbit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500 transition-all ease-in-out shadow-inner"
                    placeholder="Masukkan Tahun Terbit" required>
            </div>

            <!-- Input Jumlah Stok -->
            <div>
                <label for="jumlah_stok" class="block mb-2 text-lg font-medium text-gray-700 dark:text-white">Jumlah
                    Stok</label>
                <input value="{{ $books->jumlah_stok }}" type="number" name="jumlah_stok" id="jumlah_stok"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500 transition-all ease-in-out shadow-inner"
                    placeholder="Masukkan Jumlah Stok" required>
            </div>

            <!-- Input Deskripsi -->
            <div>
                <label for="deskripsi"
                    class="block mb-2 text-lg font-medium text-gray-700 dark:text-white">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500 transition-all ease-in-out shadow-inner"
                    placeholder="Deskripsi buku" required>{{ $books->deskripsi }}</textarea>
            </div>

            <button type="submit"
                class="inline-flex items-center px-8 py-4 mt-6 text-lg font-semibold text-center text-white bg-teal-600 rounded-xl focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-800 hover:bg-teal-700 transition-all ease-in-out">
                Simpan Perubahan
            </button>
            <a href="{{ route('books.index') }}" type="submit"
                class="inline-flex items-center px-8 py-4 mt-6 text-lg font-semibold text-center text-white bg-teal-600 rounded-xl focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-800 hover:bg-teal-700 transition-all ease-in-out">
                Kembali
            </a>
        </form>
    </div>
</section>
