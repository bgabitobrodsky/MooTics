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
        $('#fila-mas').fadeOut(300);
    }
}

$('#btn-crear').click(()=>{
    console.log("asd")
    btn = $(window.event.target);
    btn.attr("disabled",true)
    $('#form-crear').submit();
})