<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body>
    <h1>Product List</h1>
    <ul id="product-list">
        @foreach ($products as $product)
            <li>{{ $product->name }} - ${{ $product->price }}</li>
        @endforeach
    </ul>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            forceTLS: true
        });

        var channel = pusher.subscribe('products');
        channel.bind('App\\Events\\ProductUpdated', function(data) {
            let item = document.createElement('li');
            item.textContent = `${data.product.name} - $${data.product.price}`;
            document.getElementById('product-list').appendChild(item);
        });
    </script>
</body>
</html>
