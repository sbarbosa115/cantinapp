<div style="text-align: center">
    <h3>ORDER: Online - mycantinapp.com</h3>
    <h3>To Go</h3>
    <h3>Server: Online Order</h3>
    <h3>{{ $order->created_at->format('d-M-Y g:i:sa') }}</h3>

    @foreach($order->productsOrder()->get() as $product)
        {{ $product->quantity }}.
        @if($product->product()->get()->first())
            {{ $product->product()->get()->first()->name }}
        @endif
        <br />
        {{ $product->sidesAsString() }}
        {{ $product->comment }}
    @endforeach

    <h3>ID: {{ $order->id }}</h3>
</div>