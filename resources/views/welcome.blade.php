<!DOCTYPE html>
<html>
<head>
    <title>Analizador Léxico (if-else)</title>
</head>
<body>
    <h1>Analizador Léxico</h1>
    <form method="post" action="/analizador-lexico">
        @csrf
        <label for="expression">Ingrese la expresión:</label>
        <input type="text" id="expression" name="expression" required>
        <button type="submit">Analizar</button>
    </form>
</body>
</html>
