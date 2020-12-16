// agregar una opcion más al crear la encuesta (max 5)
var cantOpciones = 3;
function agregarOpcion(){
    cantOpciones++;
    var body = document.getElementById('panel-body-crear');
    var opcion = document.createElement('div');
    opcion.className = "fila-opcion";
    opcion.innerHTML = '<input name="opciones[]" type="text" class="opcion" placeholder="' + cantOpciones + '.">';
    $(opcion).hide();
    body.appendChild(opcion);
    $(opcion).slideDown();
}

$('#panel-body-crear').keyup(()=>{
    let opciones = $('.opcion');
    let unaVacia = false;
    for(let i = 0; i < opciones.length; i++){
        if($(opciones[i]).val() == "")
            unaVacia = true;
    }
    if(!unaVacia && cantOpciones < 10)
        agregarOpcion();
})

$('#btn-crear').click(()=>{
    console.log("asd")
    btn = $(window.event.target);
    btn.attr("disabled",true)
    $('#form-crear').submit();
})