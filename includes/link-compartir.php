<div class="alert alert-info" role="alert">
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$link ="./?e=" . $id;
?>

<h5>Comparte este link para acceder a la encuesta:</h5>
<a id='link' href=<?php echo $link?>>
    <?php echo $host."/encuestas/?e=".$id?>
    <?php //echo $host."?e=".$id?>
</a>
<button class="btn btn-sm btn-primary" onclick="copiarLink()"><i class="far fa-clipboard text-white"></i></button>

</div>