$('#btn-submit').click((event)=>{
    let form = document.getElementById('form');
    let formValid = form.checkValidity();
    if (formValid) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
   
    let curPass = $('#current-pass').val();
    let newPass = $('#new-pass').val();
    let repPass = $('#rep-pass').val();
    if(formValid){
        if(newPass != repPass){
            notificacion("Las contraseñas no coinciden","warning")
        }else{
            $.post('./php/cambiar-pass.php',{
                "current-pass" : curPass,
                "new-pass" : newPass
            },(data)=>{
                if(data == 0){
                    notificacion("Ha ocurrido un error","danger");
                }else if(data == 1){
                    notificacion("Contraseña incorrecta","danger");
                }else{
                    console.log(data)
                    $('#form').fadeOut(300,()=>{
                        $('#panel').html(`
                            <div class="text-center">
                                <h5>Contraseña actualizada</h5>
                                <hr>
                                <a href="profile.php" class="btn btn-sm btn-primary">Aceptar</a>
                            </div>
                        `)
                    })
                }
            })
        }
    }
    
})

$('#rep-pass').keyup(()=>{
    let input = document.getElementById('rep-pass');
    let newPass = $('#new-pass').val();
    let repPass = $('#rep-pass').val();

    if(newPass != repPass){
        input.classList.add("border-danger");
    }else{
        input.classList.remove("border-danger");
    }
})

$('#show-pass').change(()=>{
    checked = window.event.target.checked;
    if(checked){
        $('#current-pass').attr("type","text");
    }else{
        $('#current-pass').attr("type","password");
    }
})
