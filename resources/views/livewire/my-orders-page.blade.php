<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">My Orders</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Status</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Amount</th>
                  <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                @php
                    $status = '';
                    $payment_staus='';
                    if($order->status == 'new'){
                      $status = '<span class="bg-orange-500 py-1 px-3 rounded text-white shadow">New</span>';
                    }if($order->status == 'processing'){
                      $status = '<span class="bg-orange-400 py-1 px-3 rounded text-white shadow">Processing</span>';
                    }if($order->status == 'cancelled'){
                      $status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Cancelled</span>';
                    }if($order->status == 'delivered'){
                      $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Delivered</span>';
                    }

                    if($order->payment_status == 'pending'){
                      $payment_staus = '<span class="bg-orange-400 py-1 px-3 rounded text-white shadow">Pending</span>';
                    }
                    if($order->payment_status == 'paid'){
                      $payment_staus = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Paid</span>';
                    }
                    if($order->payment_status == 'failed'){
                      $payment_staus = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Failed</span>';
                    }
                @endphp
                  <tr class="odd:bg-white even:bg-gray-100" wire:key="{{$order->id}}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">{{$order->id}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{{$order->created_at->format('d-m-y')}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{!! $status !!}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{!! $payment_staus !!}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{{Number::currency($order->grand_total, 'NGN')}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                      <a href="/my-orders/{{$order->id}}" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View Details</a>
                    </td>
                  </tr> 
                @endforeach
  
              </tbody>
            </table>
          </div>
        </div>
      {{$orders->links()}}
      </div>
    </div>
  </div>