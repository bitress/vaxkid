 function isLoggedIn(){
        $.ajax({
            url: 'config/Ajax.php',
            type: 'post',
            data: {
                action: 'isLoggedIn'
            },
            success: function (res) {
                var isLoggedIn = JSON.parse(res);
                if (isLoggedIn.status === false) {
                    window.location.href = 'index.html'
                }
            }
        })
    }

  function setLoginPlaceholders(){


      $.ajax({
          type: 'POST',
          url: 'config/Ajax.php',
          data: {
              action: 'isMidwifeLogin'
          },
          success: function (res){


              if (res === "true"){
                  $(".noMidwifeAccess").addClass('d-none')
              }

          }
      })

    $.ajax({
        url: 'config/Ajax.php',
        type: 'POST',
        data: {
            action: 'fetchLoginUser'
        },
        success: function (res){


            var user = JSON.parse(res);
            $(".userNamePlaceholder").text(user.firstname + ' ' + user.middlename + ' ' + user.lastname);
            $(".emailPlaceholder").text(user.email);

        }
    })



  }

  function fetchNotification(){

    $.ajax({
        url: 'config/Ajax.php',
        type: 'POST',
        data: {
           action: 'fetchNotification'
        }, success: function (data){
            $("#notificationList").html(data);
        }
    })

  }


isLoggedIn();
fetchNotification();
setLoginPlaceholders();



 setInterval(function() {
     isLoggedIn()
     fetchNotification()
     $(".modal-backdrop").remove()
 }, 5000);


console.log("Seems like you know what you are doing. :>!")


