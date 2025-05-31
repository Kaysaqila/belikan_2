<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\ShippingAddress;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class EditAlamatPenerima extends Component
{
    public $shippingAddress, $shippingNumber, $shippingName;
    public $orderId;
    
    public function mount()
    {
        $user = Auth::user();

        // data awal form
        $this->shippingAddress = $user->address;
        $this->shippingNumber = $user->phone_number;
        $this->shippingName = $user->name;

        // Ambil order yang belum selesai (contoh)
        $latestOrder = Order::where('user_id', $user->id)
                            ->where('status', 'pending') // sesuaikan dengan logikamu
                            ->latest()
                            ->first();

        $this->orderId = $latestOrder?->id; // kalau null, tetap null
    }

    public function update()
    {
        $this->validate([
            'shippingName' => 'required|string',
            'shippingAddress' => 'required|string|max:255',
            'shippingNumber' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        // Cari shipping address yang ada (tanpa memperdulikan order_id)
        $shippingAddress = ShippingAddress::where('user_id', $user->id)
            ->latest()
            ->first();

        if ($shippingAddress) {
            // Update alamat pengiriman yang sudah ada
            $shippingAddress->update([
                'recipient_name' => $this->shippingName,
                'address' => $this->shippingAddress,
                'phone_number' => $this->shippingNumber,
            ]);
        } else {
            // Buat alamat pengiriman baru TANPA order_id
            ShippingAddress::create([
                'user_id' => $user->id,
                'recipient_name' => $this->shippingName,
                'address' => $this->shippingAddress,
                'phone_number' => $this->shippingNumber,
                // Tidak menyertakan order_id
            ]);
        }

        $this->dispatch('addressUpdated');
        session()->flash('success', 'Alamat berhasil diperbarui');
        $this->dispatch('closeEditAddressModal');
    }

    public function render()
    {
        return view('livewire.checkout.edit-alamat-penerima');
    }
}
