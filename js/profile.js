let globalEncuestas;

function cargarEncuestas(){
    let encuestas_container = document.getElementById("encuestas-container");
    encuestas_container.innerHTML = "";
    encuestas_container.insertAdjacentHTML("beforeend",'<div class="text-center"><div class="spinner-border spinner-border-lg text-secondary my-3" role="status"><span class="sr-only">Loading...</span></div></div>');
    let req = new XMLHttpRequest();
    req.open("GET",'php/getEncuestas.php');
    req.onload = function(e){
        if(req.response == 0){

        }else{
            let data = JSON.parse(req.responseText);
            console.log(data);
            if(data.length > 0){
                globalEncuestas = data.length;
                encuestas_container.innerHTML = "";
                data.map(function(encuesta){
                    encuestas_container.insertAdjacentHTML("beforeend",
                        `<div class='encuesta border rounded bg-secondary text-white d-flex justify-content-between mb-3'>
                            <h6 class='text-white p-3'>${encuesta.descripcion}</h6>
                            <div class='e-buttons d-flex'>
                                <button class='btn btn-dark rounded-0 btn-ver' data-toggle='modal' data-target='#modal-encuesta' onclick='verEncuesta("${encuesta.id}")'>
                                    <i class='fas fa-eye text-white'></i>
                                </button>
                                <button class='btn btn-dark rounded-0 btn-pausa' onclick='pausarEncuesta("${encuesta.id}")'>
                                    ${!encuesta.paused?"<i class='fas fa-play text-white'></i>":"<i class='fas fa-pause text-white'></i>"}
                                </button>
                                <button class='btn btn-danger rounded-0 btn-ask-delete' onclick="swipeEliminar()"><i class='fas fa-trash'></i></button>
                                <button class='btn btn-danger rounded-0 btn-delete' onclick='eliminarEncuesta("${encuesta.id}")'><i class='fas fa-check'></i></button>
                            </div>
                        </div>`);
                });
                $('.btn-delete').hide();
            }else{
                encuestas_container.innerHTML = "<h5 class='text-center'>No hay encuestas creadas</h5>";
            }
        }
    }
    req.send();
}

let swipeEliminar = () =>{
    btn = $(window.event.target);
    btn.next().animate({width:'toggle'},100);
}

let eliminarEncuesta = (id_encuesta) => {
    btn = $(window.event.target);
    $.post('./php/eliminar-encuesta.php',{
        "id_encuesta":id_encuesta
    }, function(data){
        if(data == 1){
            --globalEncuestas;
            let e = btn.parent().parent();
            e.slideUp(300,()=>{e.remove(); if(globalEncuestas < 1){
                $('#encuestas-container').html("<h5 class='text-center'>No hay encuestas creadas</h5>")
            }});
            notificacion("Encuesta eliminada","success");
            
        }
    });
}

let pausarEncuesta = (id_encuesta) => {
    btn = $(window.event.target);
    btn.empty();
    console.log(btn)
    btn.append('<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="sr-only">Loading...</span></div>')
    $.post('./php/pausar.php',{
        "id_encuesta":id_encuesta
    }, function(data){
        console.log(data);
        btn.empty();
        if(data == 'play'){
            btn.append('<i class="fas fa-play text-white"></i>')
        }else if(data=='pause'){
            btn.append('<i class="fas fa-pause text-white"></i>')
        }
    });
}

let verEncuesta = (id_encuesta) => {
    btn = $(window.event.target);
    console.log(btn);
    let req = new XMLHttpRequest();
    req.open("GET",'php/getEncuesta.php?e=' + id_encuesta);
    
    req.onload = (e)=>{
        if(req.response == 0){
            console.log("error")
        }else{
            let data = JSON.parse(req.responseText);
            console.log(data);
            $('#ver-pregunta').html(data.pregunta);
            $('#link').attr('href','index.php?e=' + data.id);
            $('#link').html(window.location.host + '/?e=' + data.id);
            let opciones_container = $('#ver-opciones-container');
            opciones_container.empty();
            let total = Math.max(data.opciones.map((op)=>{return op.votos}).reduce((a,b)=>{return a+b}),1);
            console.log(total);
            data.opciones.map((opcion)=>{
                opciones_container.append(`<div class="fila-opcion">
                        <p class="opcion">${opcion.opcion}</p>
                        <p><b>${opcion.votos}</b></p>
                        <div class="progress op-progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: ${opcion.votos * 100 / total}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>`);
            })
        }
    }
    req.send();
    
}



