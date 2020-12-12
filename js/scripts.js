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

// mostrar notificaciones dinamicas
let notificacion = (mensaje,tipo) =>{
    let container = $('#notification-box');
    let notificacion = $(`<div id="notification" class="alert alert-dismissible fade in show alert-${tipo}" role="alert">
                            ${mensaje}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
    container.append(notificacion);
    window.setTimeout(()=>{
        notificacion.fadeOut(300);
    },3000);
}

// cerrar la notificacion de php despues de 3 segundos
$(document).ready(function() {
    window.setTimeout(function () { 
        $('#notification').fadeOut(300); 
     }, 3000); 
  });
