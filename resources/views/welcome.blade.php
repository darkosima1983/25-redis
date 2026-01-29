<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
</head>
<body>

<h1>Neueste Produkte</h1>

<ul>
    @forelse($products as $product)
        <li>
            <strong>{{ $product->name }}</strong><br>
            {{ $product->description }}<br>
            Preis: {{ number_format($product->price, 2) }} €
        </li>
    @empty
        <li>Keine Produkte vorhanden</li>
    @endforelse
</ul>

<p>
    <a href="{{ route('products.all') }}">Alle Produkte anzeigen</a>
</p>

</body>
</html>