function copiarLink(){
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById("link").innerHTML);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}

var cantOpciones = 2;

function agregarOpcion(){
    cantOpciones++;
    var body = document.getElementById('panel-body');
    var opcion = document.createElement('div');
    opcion.className = "fila-opcion";
    opcion.innerHTML = '<input name="opciones[]" type="text" class="opcion" placeholder="' + cantOpciones + '.">'
    body.appendChild(opcion);

    if(cantOpciones>=5){
        document.getElementById('fila-mas').parentNode.removeChild(document.getElementById('fila-mas'));
    }
}

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
    })
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
})