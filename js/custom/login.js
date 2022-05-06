$(document).ready(function(){
    $("#add_err").css('display', 'none', 'important');
     $("#loginbtn").click(function(){  
          username=$("#usuario").val();
          password=$("#pass").val();
          $.ajax({
           type: "POST",
           url: "login.php",
            data: "user="+username+"&pass="+password,
           success: function(html){ 
            if(html=='true')    {
             //$("#add_err").html("right username or password");
             window.location="principal.php";
            }
            else    {
            $("#add_err").css('display', 'inline', 'important');
             $("#add_err").html("<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Usuario/Password incorrectos");
            }
           },
           beforeSend:function()
           {
            $("#add_err").css('display', 'inline', 'important');
            $("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
           }
          });
        return false;
    });
}); 