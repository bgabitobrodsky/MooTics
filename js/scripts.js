// agregar una opcion más al crear la encuesta (max 5)
var cantOpciones = 2;
function agregarOpcion(){
    cantOpciones++;
    var body = document.getElementById('panel-body');
    var opcion = document.createElement('div');
    opcion.className = "fila-opcion";
    opcion.innerHTML = '<input name="opciones[]" type="text" class="opcion" placeholder="' + cantOpciones + '.">';
    $(opcion).hide();
    body.appendChild(opcion);
    $(opcion).slideDown();

    if(cantOpciones>=5){
        document.getElementById('fila-mas').parentNode.removeChild(document.getElementById('fila-mas'));
    }
}

// activar los tooltips
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

// copiar el link de la encuesta al portapapeles
$('.btn-copy-link').click(function(){
    var aux = document.createElement("input");
    aux.setAttribute("value", $(this).prev().html());
    this.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    this.removeChild(aux);
    console.log($(this).prev().html());
})

$('.btn-delete').hide();

$('.btn-ask-delete').click(function(){
    $(this).next().animate({width:'toggle'},100);
})

$('.btn-delete').click(function(){
    btn = $(this);
    var id = btn.attr('target');
    $.post('./php/eliminar-encuesta.php',{
        "id_encuesta":id
    }, function(data){
        if(data == 1){
            console.log("eliminado");
            location.reload();
        }
    });
})

$('.btn-pausa').click(function(){
    btn = $(this);
    btn.empty();
    var id = $(this).attr('target');
    $.post('./php/pausar.php',{
        "id_encuesta":id
    }, function(data){
        console.log(data);
        if(data == 'play'){
            btn.append('<i class="fas fa-play text-white"></i>')
        }else if(data=='pause'){
            btn.append('<i class="fas fa-pause text-white"></i>')
        }
    });
});

// cerrar la notificacion despues de 3 segundos
$(document).ready(function() {
    window.setTimeout(function () { 
        $('#notification').fadeOut(300); 
     }, 3000); 
  });
