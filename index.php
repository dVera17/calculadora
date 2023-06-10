<?php
session_start();
$valores1 = $_SESSION['valores1'] ?? '';
$valores2 = $_SESSION['valores2'] ?? '';
$operacion = $_SESSION['operacion'] ?? '';
$resultado = '';
if (isset($_POST['num'])) {
    $selectedNum = $_POST['num'];
    if ($selectedNum === 'C') {
        $valores1 = '';
        $valores2 = '';
    } elseif ($selectedNum === '←') {
        $valores1 = substr($valores1, 0, -1);
    } else {
        $valores1 .= $selectedNum;
    }
} elseif (isset($_POST['operacion'])) {
    $operacion = $_POST['operacion'];
    if ($valores1 != '') {
        $valores2 = $valores1;
        $valores1 = '';
    }
} elseif (isset($_POST['calcular'])) {
    $valor1 = floatval($valores2);
    $valor2 = floatval($valores1);
    switch ($operacion) {
        case '+':
            $resultado = $valor1 + $valor2;
            break;
        case '-':
            $resultado = $valor1 - $valor2;
            break;
        case '*':
            $resultado = $valor1 * $valor2;
            break;
        case '/':
            if ($valor2 != 0) {
                $resultado = $valor1 / $valor2;
            } else {
                $resultado = 'Error: división por cero';
            }
            break;
        default:
            $resultado = 'Error: operación no válida';
            break;
    }
    $valores1 = $resultado;
    $valores2 = '';
    $operacion = '';
}
$_SESSION['valores1'] = $valores1;
$_SESSION['valores2'] = $valores2;
$_SESSION['operacion'] = $operacion;
$outputValue = $valores1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="content">
        <form method="POST">
            <input type="text" name="output" value="<?php echo $outputValue; ?>"> <br>
            <button type="submit" name="num" value="1">1</button>
            <button type="submit" name="num" value="2">2</button>
            <button type="submit" name="num" value="3">3</button>
            <button type="submit" name="num" value="←">←</button><br>
            <button type="submit" name="num" value="4">4</button>
            <button type="submit" name="num" value="5">5</button>
            <button type="submit" name="num" value="6">6</button>
            <button type="submit" name="num" value="C">C</button><br>
            <button type="submit" name="num" value="7">7</button>
            <button type="submit" name="num" value="8">8</button>
            <button type="submit" name="num" value="9">9</button>
            <button type="submit" name="num" value="0">0</button> <br>
            <button type="submit" name="operacion" value="+">+</button>
            <button type="submit" name="operacion" value="-">-</button>
            <button type="submit" name="operacion" value="*">*</button>
            <button type="submit" name="operacion" value="/">/</button><br>
            <input type="submit" name="calcular" value="Calcular">
        </form>
    </div>
</body>
</html>