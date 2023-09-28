<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 127px;
            background-color: #141212;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #fff;
        }
        
        form {
            margin-top: 20px;
        }
        
        label {
            font-weight: bold;
            color: #fff;
        }
        
        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        

        button {
            display: block;
            width: 150px;
            margin-top: 10px;
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Analizador Lexico y Sintactico</h1>
    </header>
    <div class="container">
        <form href="/welcome.html">
            @csrf
            <div>
                <label>Codigo Analizado</label>
                <textarea>{{$expression}}</textarea>
            </div>
            <button type="submit">Analizar otro codigo</button>
        </form>
        <br>
        <div style="display: flex; justify-content: space-between;">
            <div style="width: 48%;">
                <label>Resultado Lexico:</label>
                <textarea readonly>
                    @foreach ($tokens as $token)
                        Tipo: {{ $token['type'] }} => Valor: {{ $token['value'] }}
                    @endforeach
                </textarea>
            </div>
            <div style="width: 48%;">
                <label>Resultado Sintactico:</label>
                <textarea readonly>
                    @foreach ($analisis as $analis)
                        Analisis: {{$analis}}
                    @endforeach
                </textarea>
            </div>
        </div>
        
    </div>
</body>
</html>
