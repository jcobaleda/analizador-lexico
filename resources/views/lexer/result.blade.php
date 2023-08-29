<!DOCTYPE html>
<html>
<head>
    <title>Resultado del Analizador Léxico</title>
</head>
<body>
    <h1>Tokens generados:</h1>
    <ul>
        @foreach ($tokens as $token)
        <li>Tipo: {{ $token['type'] }} => Valor: {{ $token['value'] }}</li>
        @endforeach
    </ul>
</body>
</html>
