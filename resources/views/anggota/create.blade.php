<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12 lg:pl-64">

            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class=" m-5 flex flex-col items-start justify-between space-y-4 sm:flex-row sm:space-y-0">
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        RIWAYAT PINJAM BUKU </h1>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">JUDUL BUKU</th>
                                <th scope="col" class="px-4 py-3">PENULIS</th>
                                <th scope="col" class="px-4 py-3">TANGGAL PINJAM</th>
                                <th scope="col" class="px-4 py-3">TANGGAL KEMBALI</th>
                                <th scope="col" class="px-4 py-3">SISA HARI</th>
                                <th scope="col" class="px-4 py-3">STATUS</th>
                                <th scope="col" class="px-4 py-3">AKSI</th>

                                <!-- <th scope="col" class="px-4 py-3">aksi</th> -->


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-3">{{ $loan->book->judul_buku }}</td>
                                <td class="px-4 py-3">{{ $loan->book->penulis }}</td>
                                <td class="px-4 py-3">{{ $loan->tanggal_pinjam }}</td>
                                <td class="px-4 py-3">{{ $loan->tanggal_kembali }}</td>
                                <td class="px-6 py-4">
                                        @php
                                            $sisaHari = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($loan->tanggal_kembali), false);
                                            // Membulatkan sisa hari ke angka terdekat
                                            $sisaHari = round(abs($sisaHari)); // Membulatkan angka desimal ke bilangan bulat terdekat
                                        @endphp
                                        <span class="inline-block px-3 py-1 text-sm font-medium">
                                            @if ($loan->status === 'returned')
                                                Sudah Dikembalikan
                                            @else
                                                {{ $sisaHari > 0 ? $sisaHari . ' hari' : 'Lewat ' . abs($sisaHari) . ' hari' }}
                                            @endif
                                        </span>
                                    </td>
                                <td class="px-4 py-3">
                                    <span class="font-medium px-2 py-1 rounded-full {{ $loan->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ $loan->status ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    <td class="px-4 py-3">
                                        @if ($loan->status === 'borrowed')
                                            <form action="{{ route('anggota.kembalikan', $loan->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                   KEMBALIKAN
                                    </span>
                                    </button>
                                            </form>
                                        @endif
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>