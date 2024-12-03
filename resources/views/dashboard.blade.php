<x-app-layout>
    <html>
    <head>
      <script src="https://cdn.tailwindcss.com"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    </head>
    
    <body class="bg-gray-100 font-roboto" style="margin-left: 250px">
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center bg-gray-200 rounded-full px-4 py-2 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <a href="{{route('admin.loanHistory')}}" class="bg-gray-200 rounded-3xl outline-none "  type="text">cari buku</a>
                    <i class="fas fa-search text-gray-500 ml-2"></i>
                </div>
                <div class="flex items-center space-x-4">
    <p id="serverTime" data-time="{{ now()->format('Y-m-d H:i:s') }}">
        {{ now()->format('l, d M Y | H:i:s') }}
    </p>
    <i class="fas fa-clock"></i>
    <i class="fas fa-user-circle"></i>
</div>
            </div>
    
            <!-- Welcome Section -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                <div class="flex items-center">
                    <!-- Image -->
                    <div class="w-1/2 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <img alt="Library Illustration" class="w-full" src="image/geo1.png" />
                    </div>
                    <!-- Welcome Text -->
                    <div class="ml-10">
                        <h1 class="text-3xl font-bold mb-3 ">Selamat Pagi,<span class="text-purple-600"> {{Auth::user()->name}}!</span></h1>
                        <p class="text-gray-600 mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        <div class="flex space-x-4 mt-6">
                            <a href="{{route('admin.loanHistory')}}" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">informasi</a>
                            <a href="{{route('books.create')}}"  class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">tambah buku</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Info Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold mb-2">Info Dashboard Buku</h2>
                <p class="text-gray-600 mb-6">Dashboard informasi buku total buku dipinjam, buku sedang dipinjam, buku dikembalikan, buku rusak</p>
                
                <!-- Grid for Info Boxes -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Info Box 1 -->
                    <div class="bg-green-200 rounded-lg p-4 text-center transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <i class="fa-solid fa-book text-5xl"></i>
                    <h3 class="text-2xl font-bold">{{ $totalBuku }}</h3>
                        <p>Total buku dipinjam</p>
                    </div>
                    <!-- Info Box 2 -->
                    <div class="bg-teal-600 text-white rounded-lg p-4 text-center transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <i class="fa-solid fa-book-bookmark text-5xl"></i>
                    <h3 class="text-2xl font-bold"> {{ $totalstat }}</h3>
                        <p>Sedang dipinjam</p>
                    </div>
                    <!-- Info Box 3 -->
                    <div class="bg-yellow-400 rounded-lg p-4 text-center transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <i class="fa-solid fa-book-medical text-5xl"></i>
                    <h3 class="text-2xl font-bold">{{ $totalava }}</h3>
                        <p>Buku dikembalikan</p>
                    </div>
                    <!-- Info Box 4 -->
                    <div class="bg-red-600 text-white rounded-lg p-4 text-center transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <i class="fa-solid fa-book-skull text-5xl"></i>
                     <!-- <p class="text-2xl font-bold">19</p> -->
                      <p class="text-2xl font-bold">0</p>
                        <p>Buku rusak</p>
                    </div>
                </div>
                
                <!-- Manage Button -->
                <div class="flex justify-end mt-4">
                    <a href="{{route('books.index')}}" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">Kelola</a>
                </div>
            </div>
        </div>
    </body>
    </html>
</x-app-layout>
