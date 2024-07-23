<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hola <?php echo $nombre; ?>.
    Usted tiene <?php echo $edad; ?> años.
    Su color favorito es <?php echo $color; ?>.
    <div class="colored-div" style="background-color: <?php echo $color; ?>;"></div>
</body>
</html>
<style>
    .colored-div {
        width: 100px;
        height: 100px;
    }
</style>

