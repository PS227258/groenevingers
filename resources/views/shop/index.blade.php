<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten - GroeneVingers</title>
    <link rel="shortcut icon" href="{{ url('assets/icons/favicon.svg') }}" type="image/x-icon">
    <script src="{{ url('javascript/script.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/products.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/reset.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/header.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/footer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>
    @include('includes.header')
    <div class="wrapper">
        <div class="products-section">
            <h3 class="products-section-title">{{ GoogleTranslate::trans('Onze producten', app()->getLocale()) }}</h3>
            <div class="products-wrapper">
            @php($i = 0)

            @foreach ($products as $product)
                    <div class="product-wrapper" onclick="location.href='{{ route('shop.show', ['shop' => $product->id])}}'">
                        <img src="{{$product->img_src}}">
                        <div class="product-information">
                            <span class="product-name">{{$product->name}}</span>
                            <span class="product-price">€ {{ number_format($product->price, 2, ',') }}</span>
                            <span class="product-categorie">{{$product->categorie->name}}</span>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    
        <a class="cart" href="{{ route('order.index') }}">
            <div class="cart-icon-container">
                <img class="cart-icon" width="30px" src="{{ url('assets/icons/cart.svg') }}" alt="Winkelwagen">
            </div>
        </a>

        {{ $products->links('pagination::semantic-ui') }}
    </div>
    @include('includes.footer')
</body>

</html>