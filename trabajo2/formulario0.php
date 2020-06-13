<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Automatas</title>
</head>
<body>
    <h2>Automata a modificar</h2>
        <form action="Ingresar.php" method="POST">
            <select name= "op">
                <option value=0>Autmoata 1</option>
                <option value=1>Automata 2</option>
            </select>
            <select name= "tipo">
                <option value="AFD">AFD</option>
                <option value="AFND">AFND</option>
            </select>
            <input type="submit" value="enviar" name="enviar">
        </form>
</body>
</html>