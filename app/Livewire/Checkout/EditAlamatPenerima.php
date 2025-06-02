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

        // Update atau buat alamat default (tanpa order_id)
        ShippingAddress::updateOrCreate(
            [
                'user_id' => $user->id,
                'order_id' => null // Ini alamat default user
            ],
            [
                'recipient_name' => $this->shippingName,
                'address' => $this->shippingAddress,
                'phone_number' => $this->shippingNumber
            ]
        );

        $this->dispatch('addressUpdated');
        session()->flash('success', 'Alamat berhasil diperbarui');
        $this->dispatch('closeEditAddressModal');
    }

    public function render()
    {
        return view('livewire.checkout.edit-alamat-penerima');
    }
}
