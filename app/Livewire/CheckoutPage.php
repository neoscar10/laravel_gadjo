<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title("Checkout Page")]

class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $street_address;
    public $city;
    public $state;
    public $payment_method;


    public function mount(){
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) == 0) {
            return redirect('/products');
        }
    }

    public function placeOrder(){
        $this->validate([
            "first_name"=> "required|min:2",
            "last_name"=> "required|min:2",
            "phone"=> "required|min:6",
            "street_address"=> "required|min:6|max:520",
            "state"=> "required|min:6|max:255",
            "city"=> "required|min:6|max:255",
            "payment_method" => "required"
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_item = [];
        foreach($cart_items as $item){
            $line_items[] = [
                'price_data' => [
                    'currency' => 'ngn',
                    'unit_amount' =>$item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ]
                    ],
                    'quantity' => $item['quantity'],
            ];
        }
        //crreating an instance of order
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'ngn';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . auth()->user()->name;

        // creating an instance of address
        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->email = $this->email;
        $address->state = $this->state;
        $address->city = $this->city;
        $address->street_address = $this->street_address;

        $redirect_url = '';

         if($this->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),
            ]);
            $redirect_url = $sessionCheckout->url;
         }else{
            $redirect_url = route('success');
         }
         $order->save();
         $address->order_id = $order->id;
         $address->save();
         $order->items()->createMany($cart_items);
         CartManagement::clearCartItems();
         Mail::to(request()->user())->send(new OrderPlaced($order));
         return redirect($redirect_url)->with('success','Order placed successfully!');

    }
   
    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        
        return view('livewire.checkout-page', [
            'cart_items'=> $cart_items,
            'grand_total'=> $grand_total
        ]);
    }
}
