@php
    use App\Models\Product;
    use App\Models\Categorie;

    // Bereken de prijs inclusief 9% BTW
    $order->btw_price = $order->price * 0.09;

    // Controleer of de oorspronkelijke prijs minder is dan 50 euro en voeg zo nodig verzendkosten toe
    if ($order->price < 50) {
        $order->ship_price = 7.5; // Verzendkosten
    } else {
        $order->ship_price = 0; // Geen verzendkosten
    }

    // Bereken de totale prijs
    $order->total_price = $order->btw_price + $order->ship_price + $order->price;
@endphp

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Je bestelling - GroeneVingers</title>
    <link rel="shortcut icon" href="{{ url('assets/icons/favicon.svg') }}" type="image/x-icon">
    <script src="{{ url('javascript/script.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/includes/reset.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/header.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/footer.css') }}">
    <link rel="stylesheet" href="{{ url('css/status.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>
    @include('includes.header')
    <div class="wrapper">
        <h2 class="title">Je bestelling</h2>
        <div class="order-insights">
            <div class="order-overview">
                <div class="order-overview-header">
                    <p>Bestelling</p>
                    <span
                        class="order-status
                        @if ($order->status->name === 'Ontvangen') received
                        @elseif ($order->status->name === 'Betaald')
                            payed
                        @elseif ($order->status->name === 'Verwerkt')
                            processed
                        @elseif ($order->status->name === 'Verzonden')
                            send
                        @elseif ($order->status->name === 'Afgeleverd')
                            delivered
                        @elseif ($order->status->name === 'Geannuleerd')
                            cancelled @endif
                    ">{{ $order->status->name }}</span>
                </div>

                <div class="order-overview-body">
                    @foreach ($order->orderrow as $orderrow)
                        @php
                            $product = Product::find($orderrow->product_id);
                            $category = Categorie::find($product['categorie_id']);
                        @endphp

                        <div class="order-item">
                            <div class="item-information">
                                <img class="product-image" src="{{ $product->img_src }}" alt="product image" />
                                <div class="product-information">
                                    <span class="product-name">{{ $product['name'] }}</span>
                                    <span class="product-category">{{ $category['name'] }}</span>
                                </div>
                            </div>
                            <span class="quantity">{{ $orderrow->quantity }}x</span>
                            <span class="price">€{{ number_format($orderrow->price, 2, ',') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="order-overview-footer">
                    <p>Totaal:</p>
                    <p>€ {{ number_format($order->price, 2, ',') }}</p>
                
                    <p>Prijs inclusief 9% BTW:</p>
                    <p>€ {{ number_format($order->btw_price, 2, ',', '') }}</p>
                
                    <p>Eventuele verzendkosten:</p>
                    <p>€ {{ number_format($order->ship_price, 2, ',', '') }}</p>
                </div>
                </br>
                <div class="order-overview-footer">
                    <h5>Totaalprijs:</h5>
                    <h5>€ {{ number_format($order->total_price, 2, ',', '') }}</h5>
                </div>
            </div>

            <div class="order-information">
                <div class="order-information-header">
                    <p>Je gegevens</p>
                </div>

                <div class="order-information-body">
                    <div class="customer-information">
                        <span>{{ $order->customer_name }}</span>
                        <span>{{ $order->email }}</span>
                        <span>{{ $order->phone }}</span>
                    </div>

                    <h6 class="address-information-header">Adresgegevens</h6>
                    <div class="address-information">
                        <span>{{ $order->address }}</span>
                        <span>{{ $order->city }}, {{ $order->zipcode }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>

</html>
