$('#btn-submit').click((event)=>{
    let form = document.getElementById('form');
    let formValid = form.checkValidity();
    if (formValid) {
        event.preventDefault();
        event.stopPropagation();
        let pass = $('#pass').val();
        $.post('./php/eliminar-usuario.php',{
            "pass":pass
        },(data)=>{
            if(data == 0){
                notificacion("Ha ocurrido un error", "danger");
            }else if(data == 1){
                notificacion("Contraseña incorrecta", "warning");
            }else if(data == 2){
                window.location = 'login.php';
            }else{
                console.log("error")
            }
        })

    }
})