<?php

function construirHead($titulo = 'Título por defecto', $metaDescripcion = '', $idioma = 'es') {
    $contenidoHead = '';

    $contenidoHead .= "<title>$titulo</title><br>";

    $contenidoHead .= '<meta name="description" content="' . $metaDescripcion . '">' . "\n";

    $contenidoHead .= '<link rel="stylesheet" href="./styles.css">' . "\n";

    $contenidoHead .= '<script src="./main.js"></script>' . "\n";

    return $contenidoHead;
}

$idioma = 'es';

$contenidoDinamicoHead = construirHead(
    'Mi Título Dinamico',
    'Esta es una descrpcion dinamica de la página.',
    $idioma
);

?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <?php echo $contenidoDinamicoHead; ?>
</head>
<body>
    <h1>Titulo</h1>
</body>
</html>
