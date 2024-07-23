<style>
    .colored-div {
        width: 100px;
        height: 100px;
    }
</style>

Hola <?php echo $nombre; ?>.
Usted tiene <?php echo $edad; ?> años.
Su color favorito es <?php echo $color; ?>.
<div class="colored-div" style="background-color: <?php echo $color; ?>;"></div>