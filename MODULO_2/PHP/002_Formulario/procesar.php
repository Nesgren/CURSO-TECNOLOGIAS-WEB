<style>
    .colored-div {
        width: 100px;
        height: 100px;
    }
</style>

<p>Hola <?php echo $nombre; ?>.</p>
<p>Usted tiene <?php echo $edad; ?> años.</p>
<p>Su color favorito es <?php echo $color; ?>.</p>
<div class="colored-div" style="background-color: <?php echo $color; ?>;"></div>