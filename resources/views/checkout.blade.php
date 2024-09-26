@php
    use App\Models\Product;

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
    <title>Je gegevens - GroeneVingers</title>
    <link rel="shortcut icon" href="{{ url('assets/icons/favicon.svg') }}" type="image/x-icon">
    <script src="{{ url('javascript/script.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/includes/reset.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/header.css') }}">
    <link rel="stylesheet" href="{{ url('css/includes/footer.css') }}">
    <link rel="stylesheet" href="{{ url('css/checkout.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>
    @include('includes.header')
    <div class="wrapper">
        <h2 class="title">Je gegevens</h2>

        <div class="columns">
            <form class="order-form" action="{{ route('order.setCustomerInformation') }}" method="post">
                @csrf
                @method('PATCH')

                <div class="input-wrapper">
                    <label class="input-label" for="fullName">Full name</label>
                    <input class="input-field" id="fullName" name="fullName" type="text" placeholder="John Doe" />
                </div>

                <div class="input-wrapper">
                    <label class="input-label" for="email">Email</label>
                    <input class="input-field" id="email" name="email" type="email"
                        placeholder="your.email@email.com" />
                </div>

                <div class="input-wrapper">
                    <label class="input-label" for="phone">Telefoonnummer</label>
                    <input class="input-field" id="phone" name="phone" type="tel"
                        placeholder="+316123456789" />
                </div>

                <div class="input-wrapper">
                    <label class="input-label" for="address">Adres</label>
                    <input class="input-field" id="address" name="address" type="text"
                        placeholder="Straatnaam en huisnummer" />
                </div>

                <div class="input-wrapper">
                    <label class="input-label" for="city">Woonplaats</label>
                    <input class="input-field" id="city" name="city" type="text" placeholder="Woonplaats" />
                </div>

                <div class="input-wrapper">
                    <label class="input-label" for="zipcode">Postcode</label>
                    <input class="input-field" id="zipcode" name="zipcode" type="text" placeholder="1234 AB" />
                </div>

                <button class="checkout-btn" type="submit">Afrekenen</button>
            </form>

            <div class="order-overview">
                <div class="order-overview-header">
                    <h3 class="order-overview-title">Winkelwagen</h3>
                </div>
                @foreach ($order->orderrow as $orderrow)
                    @php
                        $product = Product::find($orderrow->product_id);
                    @endphp

                    <div class="product-wrapper">
                        <span>{{ $orderrow->quantity }}x {{ $product['name'] }}</span>
                        <span>€ {{ number_format($orderrow->price, 2, ',') }}</span>
                    </div>
                @endforeach
                </br>
                <div class="order-overview-footer">
                    <p><strong>Totaal:</strong></p>
                    <p><strong>€ {{ number_format($order->price, 2, ',') }}</strong></p>
                </div>
                <div class="order-overview-footer">
                    <p>btw (9%):</p>
                    <p>€ {{ number_format($order->btw_price, 2, ',', '') }}</p>
                </div>
                <div class="order-overview-footer">
                    <p>verzendkosten:</p>
                    <p>€ {{ number_format($order->ship_price, 2, ',', '') }}</p>
                </div>
                </br>
                <div class="order-overview-footer">
                    <h5><strong>Totaalprijs:</strong></h5>
                    <h5><strong>€ {{ number_format($order->total_price, 2, ',', '') }}</strong></h5>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>

</html>
