<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Alle Produkte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1>Alle Produkte</h1>

<p>
    <a href="{{ route('products.create') }}">
        Neues Produkt hinzufügen
    </a>
</p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Preis (€)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Keine Produkte vorhanden</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>