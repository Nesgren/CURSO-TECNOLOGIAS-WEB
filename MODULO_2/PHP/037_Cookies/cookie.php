<?php
    echo 'Cookies antes de asignar una cookie:<Br>';
	foreach ($_COOKIE as $clave => $valor) {
		echo 'Clave: '.$clave.' Valor: '.$valor.'<br>';   	
	}
    setcookie("TestCookie", 'MiValor', time()+3600);  /* expira en 1 hora */
?>