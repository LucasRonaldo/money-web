<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>01</title>
</head>
<style>

    body{
        background-color: aquamarine
    }
    
</style>
<body>
    <form action="{{route('Exercicio01')}}" method="GET">
        <label for="n1">impar ou par:</label>
            <br>
            <input type="number" name="n1">
            <br>
            <br>
            <button>Descobrir</button>
        </form>
</body>
</html>