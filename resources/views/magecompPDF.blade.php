<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factuur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: left;
            color: #333;
        }
        .invoice-container {
            margin-top: 30px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
            font-size: 12px;
        }
        .invoice-details h1 {
            margin: 5px 0;
            font-size: 16px;
        }
        .green-text {
            color: #48A240;
        }
        .blue-text {
            color: #45A0CB;
        }
        .header-img {
            float: right;
            margin-top: -50px;
            margin-right: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .total-table {
            margin-top: 40px;
            width: 45%;
            margin-left: auto;
            margin-right: 0;
        }
        .date-container {
            text-align: right;
            font-size: 12px;
        }
        .footer-text {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;

        }
    </style>
</head>
<body>
    <img src="{{ $logo }}" alt="Logo" class="header-img" width="150" height="150">
    
    <h1><span class="green-text">Groene</span><span class="blue-text">Vingers</span></h1>
    
    <div class="invoice-container">
        <div class="invoice-details">
            <h1><strong>Bedrijfgegevens</strong></h1>
            <p><strong>Bedrijf:</strong> GroeneVingers</p>
            <p><strong>Adres:</strong> straat 123, 1234 AB Stad</p>
            <p><strong>Emailadres:</strong> nummer</p> 
        </div>
        <div class="invoice-details">
        <h1><strong>Klantgegevens</strong></h1>
            <p><strong>Klant:</strong> Test naam</p>
            <p><strong>Adres:</strong> straat 123, 1234 AB Stad</p>
            <p><strong>Factuurnummer:</strong> nummer</p>
        </div>

        <div class="date-container">
            <p><strong>Datum:</strong> {{ $date }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Omschrijving</th>
                    <th>Hoeveelheid</th>
                    <th>Prijs per stuk</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product A</td>
                    <td>2</td>
                    <td>€50,00</td>
                    <td>€100,00</td>
                </tr>
                <tr>
                    <td>Product B</td>
                    <td>1</td>
                    <td>€75,00</td>
                    <td>€75,00</td>
                </tr>
                <tr>
                    <td>Product C</td>
                    <td>3</td>
                    <td>€55,00</td>
                    <td>€165,00</td>
                </tr>
                <tr>
                    <td>Product D</td>
                    <td>10</td>
                    <td>€25,00</td>
                    <td>€250,00</td>
                </tr>
                <tr>
                    <td>Product E</td>
                    <td>5</td>
                    <td>€60,00</td>
                    <td>€300,00</td>
                </tr>
            </tbody>
        </table>

        <table class="total-table">
            <tbody>
                <tr>
                    <th><strong>Bedrag excl. btw:</strong></th>
                    <td>€200,00</td>
                </tr>
                <tr>
                    <th><strong>Btw:</strong></th>
                    <td>€175,00</td>
                </tr>
                <tr>
                    <th><strong>Totaalbedrag:</strong></th>
                    <td>€375,00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer-text">
        <p>Betalingstermijn: Binnen 14 dagen na factuurdatum(*Datum 14 dagen later*)</p>
    </div>
</body>
</html>
