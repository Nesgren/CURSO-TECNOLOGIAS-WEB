<?php
if ($_POST == true) {
    $numeroMes = $_POST['numeroMes'];
    $error = "";

    if ($numeroMes < 1 || $numeroMes > 12) {
        $error = "Número de mes inválido. Por favor, introduce un número entre 1 y 12.";
    } else {
        switch ($numeroMes) {
            case 1:
                $mes = "Enero";
                break;
            case 2:
                $mes = "Febrero";
                break;
            case 3:
                $mes = "Marzo";
                break;
            case 4:
                $mes = "Abril";
                break;
            case 5:
                $mes = "Mayo";
                break;
            case 6:
                $mes = "Junio";
                break;
            case 7:
                $mes = "Julio";
                break;
            case 8:
                $mes = "Agosto";
                break;
            case 9:
                $mes = "Septiembre";
                break;
            case 10:
                $mes = "Octubre";
                break;
            case 11:
                $mes = "Noviembre";
                break;
            case 12:
                $mes = "Diciembre";
                break;
        }
    }

    if ($error) {
        echo "<h1>$error</h1>";
    } else {
        echo "<h1>El mes es: $mes</h1>";
    }
}
?>
