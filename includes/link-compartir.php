<div class="alert alert-info" role="alert">
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$link ="./?e=" . $this->datos["id"];
?>

<h5>Comparte este link para acceder a la encuesta:</h5>
<div class="link-box">
    <a id='link' href=<?php echo $link?>>
        <?php echo $host."/encuestas/?e=".$this->datos["id"];?>
        <?php //echo $host."?e=".$id?>
    </a>
    <button class="btn btn-sm btn-primary btn-copy-link" data-toggle="tooltip" title="Copiar" onclick="copiarLink()"><i class="far fa-clipboard text-white"></i></button>
    
</div>


</div>