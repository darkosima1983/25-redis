<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Produkt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1>Neues Produkt hinzufügen</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('products.save') }}">
    @csrf

    <p>
        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </p>

    <p>
        <label>Beschreibung</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
    </p>

    <p>
        <label>Preis (€)</label><br>
        <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
    </p>

    <button type="submit">Speichern</button>
</form>

<p>
    <a href="{{ route('products.all') }}">← Zurück zur Übersicht</a>
</p>

</body>
</html>