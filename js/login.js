$(document).ready(function (){

    $("#md_loginForm").on('submit', function (e) {
        e.preventDefault();
        var notyf = new Notyf({
            duration: 1000,
            position: {
                x: 'right',
                y: 'top',
            }});

        let role = $("#midwife_role").val();
        let un = $("#midwife_username").val();
        let pass = $("#midwife_password").val();

        $.ajax({
            url: 'config/Ajax.php',
            type: 'POST',
            data: {
                action: 'userLogin',
                username: un,
                password: pass,
                role: role
            },
            beforeSend: function (){
                $("#midwife_login").addClass("disabled");
            },
            success: function (res){
                if(res === "true"){
                    notyf.success("Login success");
                    setTimeout(function(){
                        window.location.href = 'dashboard.php';
                    }, 3000);
                    $("#midwife_login").removeClass("disabled");
                } else {
                    notyf.error(res);
                    $("#midwife_login").removeClass("disabled");
                }
            }
        })

    });




})

$(document).ready(function (){

    $("#mho_loginForm").on('submit', function (e) {
        e.preventDefault();

        var notyf = new Notyf({
            duration: 1000,
            position: {
                x: 'right',
                y: 'top',
            }});

        let role = $("#mho_role").val();
        let un = $("#mho_username").val();
        let pass = $("#mho_password").val();

        $.ajax({
            url: 'config/Ajax.php',
            type: 'POST',
            data: {
                action: 'userLogin',
                username: un,
                password: pass,
                role: role
            },
            beforeSend: function (){
                $("#mho_login").addClass("disabled");
            },
            success: function (res){
                if(res === "true"){
                    notyf.success("Login success");
                    setTimeout(function(){
                        window.location.href = 'dashboard.php';
                    }, 3000);
                    $("#mho_login").removeClass("disabled");
                } else {
                    notyf.error(res);
                    $("#mho_login").removeClass("disabled");
                }
            }
        })

    });




})
isLoggedIn();

function isLoggedIn(){

    $.ajax({
        url: 'config/Ajax.php',
        type: 'post',
        data: {
            action: 'isLoggedIn'
        },
        success: function (res){

            let response = JSON.parse(res);
            if (response.status === false){
                // window.location.href = 'index.html'
            }
        }
    })

}

setInterval(function() {
    isLoggedIn()
}, 5000);


window.addEventListener('popstate', function (event) {
    location.reload()
});





