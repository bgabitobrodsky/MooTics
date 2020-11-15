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