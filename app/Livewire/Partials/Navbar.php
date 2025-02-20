<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;

    public function mount(){
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    //listening to sent event from product to update dom
    #[On("update-cart-count")]
    public function UpdateCartCount($total_count){
        $this->total_count = $total_count;
    }
    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
