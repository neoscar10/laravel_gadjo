<x-mail::message>
# Order placed successfully!

Thank you for shapping with gadjo! Your order number is {{$order->id}}

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
