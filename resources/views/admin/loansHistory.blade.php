
<x-app-layout>
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 lg:pl-64">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="flex text-white flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 bg-primary-600 rounded-t-lg">
                    <div class="w-full md:w-1/2">
                        <h1 class="text-2xl font-semibold">informasi List</h1>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-purple-300 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Judul</th>
                                    <th scope="col" class="px-4 py-3">Tanggal Pinjam</th>
                                    <th scope="col" class="px-4 py-3">Tanggal Kembali</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">SISA HARI</th>
                                    <th scope="col" class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pinjamBukus as $item)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->book->judul_buku }}
                                        </th>
                                        <td class="px-4 py-3">{{ $item->tanggal_pinjam }}</td>
                                        <td class="px-4 py-3">{{ $item->tanggal_kembali }}</td>
                                         <td class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <span class="font-medium px-2 py-1 rounded-full {{ $item->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    
                                    {{ $item->status ? 'di pinjam' : 'di kembalikan' }}
                                </span>
                                       </td>
                                       <td class="px-6 py-4">
                                        @php
                                            $sisaHari = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->tanggal_kembali), false);
                                            // Membulatkan sisa hari ke angka terdekat
                                            $sisaHari = round(abs($sisaHari)); // Membulatkan angka desimal ke bilangan bulat terdekat
                                        @endphp
                                        <span class="inline-block px-3 py-1 text-sm font-medium">
                                            @if ($item->status === 'returned')
                                                Sudah Dikembalikan
                                            @else
                                                {{ $sisaHari > 0 ? $sisaHari . ' hari' : 'Lewat ' . abs($sisaHari) . ' hari' }}
                                            @endif
                                        </span>
                                    </td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <!-- Tombol Edit -->


                                            <!-- Tombol Perpanjang Tanggal -->
                                            <form action="{{ route('pinjam.perpanjang', $item->id) }}" method="POST"
                                                class="inline-block ms-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="date" name="tanggal_kembali"
                                                    class="text-sm px-2 py-1 rounded" required>
                                                <button type="submit"
                                                    class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                    Perpanjang
                                                </button>
                                            </form>

                                            <!-- Tombol Kembalikan Paksa -->
                                            <!-- <form action="{{ route('pinjam.kembalikanpaksa', $item->id) }}"
                                                method="POST" class="inline-block ms-2">
                                                @csrf
                                                @method('POST')
                                                <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded">
                                                    Kembalikan Paksa
                                                </button>
                                            </form> -->

                                            @if ($item->status === 'borrowed')
                                                <!-- Cek status peminjaman -->
                                                <form action="{{ route('pinjam.kembalikanpaksa', $item->id) }}"
                                                    method="POST" class="inline-block ms-2">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                        Kembalikan Paksa
                                                    </button>
                                                </form>
                                            @endif


                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-3 text-center">Tidak ada data peminjaman</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </x-app-layout>
