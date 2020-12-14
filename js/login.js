$('#btn-login').click((event)=>{
    //event.preventDefault();
    //event.stopPropagation();
    let form = document.getElementById('form-login');
    let formValid = form.checkValidity();
    if (formValid) {
        let btn = $(event.target);
        console.log(btn);
        let user = $('#user').val();
        let pass = $('#pass').val();
        btn.attr("disabled",true);
        btn.html(`<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="sr-only">Loading...</span></div>`)
        $.post('./php/login.php',{
            "user":user,
            "pass":pass
        },(data)=>{
            btn.attr("disabled",false);
            btn.html("Ingresar");
            if(data == 0){
                notificacion("Ha ocurrido un error","danger");
            }else if(data == 1){
                notificacion("Usuario o contraseña incorrectos","warning");
            }else{
                window.location = 'profile.php';
            }
        })
    }
});

$('#btn-register').click((event)=>{
    //event.preventDefault();
    //event.stopPropagation();
    let form = document.getElementById('form-register');
    let formValid = form.checkValidity();
    if(formValid){
        event.preventDefault();
        event.stopPropagation();
        let btn = $(event.target);
        let user = $('#reg-user').val();
        let mail = $('#reg-mail').val();
        let pass = $('#reg-pass').val();
        let validPass = $('#rep-pass').val();
        if(pass != validPass){
            notificacion("Las contraseñas deben coincidir", "warning");
            event.preventDefault();
            event.stopPropagation();
        }else{
            console.log("enviado")
            btn.attr("disabled",true);
            btn.html(`<div class="spinner-border spinner-border-sm text-secondary" role="status"><span class="sr-only">Loading...</span></div>`)
            $.post('./php/register.php',{
                "user":user,
                "mail":mail,
                "pass":pass,
                "validPass":validPass
            },(data)=>{
                console.log("recibido");
                btn.attr("disabled",false);
                btn.html("Registrar");
                if(data == 0){
                    notificacion("Ha ocurrido un error","danger");
                }else if(data == 1){
                    notificacion("Nombre de usuario invalido","danger");
                }else if(data == 2){
                    notificacion("Email invalido","danger");
                }else if(data == 3){
                    notificacion("Las contraseñas no coinciden","danger");
                }else if(data == 4){
                    notificacion("El usuario ya se encuentra registrado","danger");
                }else if(data == 5){
                    notificacion("El mail ya se encuentra asociado a un usuario","danger");
                }else if(data == 6){
                    window.location = 'profile.php';
                }else{
                    console.log("error");
                }
            })
        }
    }
})


$('#btn-to-register').click(()=>{
    $('#form-login').fadeOut(300,()=>{
        $('#form-register').fadeIn(300);
    })
})

$('#btn-to-login').click(()=>{
    $('#form-register').fadeOut(300,()=>{
        $('#form-login').fadeIn(300);
    })
})