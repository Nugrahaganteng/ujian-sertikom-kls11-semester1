<x-app-layout>
  <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12 lg:pl-64">
    <!-- Heading & Filters -->
    <div class="mb-4 flex justify-center items-center px-24 sm:flex sm:space-y-0 md:mb-8">
      <div class="w-full">
        <h1 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl text-center">
          Daftar Buku Perpustakaan
        </h1>
        <!-- Cards Container -->
        <div class="grid grid-cols-3 md:grid-cols-3 gap-3 mt-6 justify-between ">
          <!-- Iterasi Buku -->
          @forelse($books as $book)
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center">
              <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                  judulbuku:{{ $book->judul_buku }}
                </h5>
              </a>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                nama penulis:{{ $book->penulis }}
              </p>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                jumlah stok:{{ $book->jumlah_stok }}
              </p>
              
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                 Kategori: {{ $book->kategori }}
              </p>

              <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Status:
                                <span class="font-medium px-2 py-1 rounded-full {{ $book->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    {{ $book->status ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </p>
              

<!-- Modal toggle -->

@if ($book->status =='1' && $book->jumlah_stok >0)


<button data-modal-target="modal-{{$book->id}}" data-modal-toggle="modal-{{$book->id}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transform transition-all duration-300 hover:scale-105 hover:shadow-lg" type="button">
  input data
</button>
@endif
<!-- Main modal -->
<div id="modal-{{ $book->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h4 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Isi Terlebih Dahulu Form Peminjaman Buku
                </h4>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-{{ $book->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{route('anggota.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Anggota</label>
                        <input type="email" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{auth()->user()->name }}" readonly  />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                        <input type="" name="judul_buku" id="judul_buku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{$book->judul_buku}}" readonly />
                    </div> 

                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                        <input type="email" name="penulis" id="penulis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{$book->penulis}}" readonly  />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <input type="email" name="kategori" id="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{$book->kategori}}" readonly />
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                </div>

                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">PINJEM BUKU</button>    
                </form>
            </div>
        </div>
    </div>
</div>

            </div>
          @empty
            <!-- Pesan jika tidak ada buku -->
            <div class="col-span-3 text-center">
              <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                Tidak ada buku yang tersedia saat ini.
              </p>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </section>
</x-app-layout>
