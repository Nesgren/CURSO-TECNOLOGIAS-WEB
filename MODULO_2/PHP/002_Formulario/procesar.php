<?php
echo "Hola " . htmlspecialchars ($_GET['nombre']) . ".<br>";
echo "Usted tiene " . htmlspecialchars($_GET['edad']) . " años.<br>";
echo "Su color favorito es <div style='width: 50px; height: 50px; background-color: " . htmlspecialchars($_GET['color']) . ";'></div>.";
?>
