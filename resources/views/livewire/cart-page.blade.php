<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
      <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
      <div class="flex flex-col md:flex-row gap-4">
        <div class="md:w-3/4">
          <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
            <table class="w-full">
              <thead>
                <tr>
                  <th class="text-left font-semibold">Product</th>
                  <th class="text-left font-semibold">Price</th>
                  <th class="text-left font-semibold">Quantity</th>
                  <th class="text-left font-semibold">Total</th>
                  <th class="text-left font-semibold">Remove</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cart_items as $item)
                <tr wire:key="{{$item['product_id']}}">
                  <td class="py-4">
                    <div class="flex items-center">
                      <img class="h-16 w-16 mr-4" src="{{url('storage', $item['image'])}}" alt="Product image">
                      <span class="font-semibold">{{$item['name']}}</span>
                    </div>
                  </td>
                  <td class="py-4">₦{{number_format($item['unit_amount'], 0)}}</td>
                  <td class="py-4">
                    <div class="flex items-center">
                      <button wire:click='decreaseQty({{$item['product_id']}})' class="border rounded-md py-2 px-4 mr-2">-</button>
                      <span class="text-center w-8">{{$item['quantity']}}</span>
                      <button wire:click='increaseQty({{$item['product_id']}})' class="border rounded-md py-2 px-4 ml-2">+</button>
                    </div>
                  </td>
                  <td class="py-4">₦{{number_format($item['total_amount'], 0)}}</td>
                  <td>
                    <button wire:click="removeItem({{ $item['product_id'] }})" 
                        class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 flex items-center gap-2 relative">
                        <!-- Default Text -->
                        <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">Remove</span> 
                        <!-- Loading Animation -->
                        <span wire:loading wire:target="removeItem({{ $item['product_id'] }})" class="flex items-center gap-2">Removing 
                            <svg class="w-4 h-4 text-red-600 animate-spin inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0 7.5 4.5 12 9V5a8 8 0 01-8 8z"></path>
                            </svg>
                            
                        </span>
                
                    </button>
                </td>
                
                </tr>
                @empty
                    <td colspan="5" class="text-center py-4 text-4xl text-slate-500 font-semibold">No items available in cart!</td>
                @endforelse
                <!-- More product rows -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="md:w-1/4">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Summary</h2>
            <div class="flex justify-between mb-2">
              <span>Subtotal</span>
              <span>₦{{number_format($grand_total, 0)}}</span>
            </div>
            {{-- <div class="flex justify-between mb-2">
              <span>Taxes</span>
              <span>$1.99</span>
            </div> --}}
            <div class="flex justify-between mb-2">
              <span>Shipping</span>
              <span>₦{{number_format(0, 2)}}</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Total</span>
              <span class="font-semibold">₦{{number_format($grand_total, 0)}}</span>
            </div>
            @if ($cart_items)
              <a href="/checkout" class="bg-orange-500 text-white block text-center py-2 px-4 rounded-lg mt-4 w-full">Checkout</a>
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>