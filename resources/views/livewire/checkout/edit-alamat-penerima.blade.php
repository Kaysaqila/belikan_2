<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Edit Alamat Penerima</h2>

        <form wire:submit.prevent="update">
            <!-- Nama Penerima -->
            <div class="mb-4">
                <label for="shippingName" class="flex items-center mb-2 text-sm font-semibold text-gray-700">
                    <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
                    Nama Penerima
                </label>
                <input wire:model="shippingName" type="text"
                    class="w-full p-3 pl-4 pr-10 text-sm border-2 border-gray-200 rounded-xl bg-white
                        focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200"
                    placeholder="Nama Penerima">
            </div>

            <!-- Telepon Penerima -->
            <div class="mb-4">
                <label for="shippingNumber" class="flex items-center mb-2 text-sm font-semibold text-gray-700">
                    <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
                    Telepon Penerima
                </label>
                <input wire:model="shippingNumber" type="text"
                    class="w-full p-3 pl-4 pr-10 text-sm border-2 border-gray-200 rounded-xl bg-white
                        focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200"
                    placeholder="Telepon Penerima">
            </div>

            <!-- Alamat Penerima -->
            <div class="mb-6">
                <label for="shippingAddress" class="flex items-center mb-2 text-sm font-semibold text-gray-700">
                    <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
                    Alamat Penerima
                </label>
                <textarea wire:model="shippingAddress" rows="3"
                    class="w-full p-3 pl-4 text-sm border-2 border-gray-200 rounded-xl bg-white
                        focus:ring-4 focus:ring-green-100 focus:border-green-400 transition-all duration-200"
                    placeholder="Alamat Lengkap Penerima"></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between items-center">
                <button type="button" wire:click="$dispatch('closeEditAddressModal')"
                    class="text-gray-500 hover:underline">
                    Nanti
                </button>

                <button type="submit"
                    class="flex items-center space-x-2 px-6 py-3 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 
                        rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-200 
                        shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Simpan Alamat</span>
                </button>
            </div>
        </form>
    </div>
</div>
