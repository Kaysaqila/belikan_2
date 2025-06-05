<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\ShippingAddress;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class EditAlamatPenerima extends Component
{
    public $shippingAddress, $shippingNumber, $shippingName, $note; // Add note property
    public $orderId;

    public function mount()
    {
        $user = Auth::user();

        // Initialize form data with user's default address
        $this->shippingAddress = $user->address;
        $this->shippingNumber = $user->phone_number;
        $this->shippingName = $user->name;

        // Get the latest pending order for the user
        $latestOrder = Order::where('user_id', $user->id)
                            ->where('status', 'pending') // Adjust based on your logic
                            ->latest()
                            ->first();

        $this->orderId = $latestOrder?->id; // Keep it null if no order found

        // Load the existing shipping address if available
        $shipping = ShippingAddress::where('user_id', $user->id)
            ->where('order_id', null) // Only get the default address
            ->latest()
            ->first();

        if ($shipping) {
            $this->shippingAddress = $shipping->address;
            $this->shippingNumber = $shipping->phone_number;
            $this->shippingName = $shipping->recipient_name;
            $this->note = $shipping->note; // Load the note if it exists
        }
    }

    public function update()
    {
        $this->validate([
            'shippingName' => 'required|string|max:255',
            'shippingAddress' => 'required|string|max:255',
            'shippingNumber' => 'required|string|max:20',
            'note' => 'nullable|string|max:500', // Validate note
        ]);

        $user = Auth::user();

        // Update or create the default shipping address
        ShippingAddress::updateOrCreate(
            [
                'user_id' => $user->id,
                'order_id' => null // Ensure this is a default address
            ],
            [
                'recipient_name' => $this->shippingName,
                'address' => $this->shippingAddress,
                'phone_number' => $this->shippingNumber,
                'note' => $this->note, // Save the note
            ]
        );

        // Dispatch an event to notify that the address has been updated
        $this->dispatch('addressUpdated');
        session()->flash('success', 'Alamat berhasil diperbarui');
        $this->dispatch('closeEditAddressModal'); // Close the modal
    }

    public function render()
    {
        return view('livewire.checkout.edit-alamat-penerima');
    }
}
