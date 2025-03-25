<div class="bg-black text-white px-4 py-2 flex items-center justify-between">
    <!-- Menu Sidebar Button -->
    <button @click="open = !open" class="text-white text-xl">
        ☰
    </button>

    <div x-data="{ open: false }">
    <!-- Sidebar -->
    <div x-show="open" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-40">
        <div class="w-64 h-full bg-black text-white p-4">
            <h2 class="text-xl font-bold">Dashboard</h2>
            <ul class="mt-4">
                <li><a href="#" class="block py-2 hover:bg-gray-700">Home</a></li>
                <li><a href="#" class="block py-2 hover:bg-gray-700">Settings</a></li>
                <li><a href="#" class="block py-2 hover:bg-gray-700">Logout</a></li>
            </ul>
        </div>
    </div>
</div>


    <!-- Navbar Links -->
    <div class="flex space-x-6">
        <a href="#" class="hover:text-gray-400">JENIS</a>
        <a href="#" class="hover:text-gray-400">AQUARIUM</a>
        <a href="#" class="hover:text-gray-400">PERAWATAN</a>
        <a href="#" class="hover:text-gray-400">AKSESORIS</a>
    </div>

    <!-- Search & Cart -->
    <div class="flex items-center space-x-4">
        <input type="text" placeholder="Cari..." class="bg-gray-900 text-white px-2 py-1 rounded">
        <span class="text-white text-xl">🛒</span>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://cdn.tailwindcss.com"></script>
