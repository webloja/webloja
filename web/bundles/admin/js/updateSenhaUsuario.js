$(document).ready(function() {

    $("#dialog").dialog({
            autoOpen: false,
            width: 400,
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $(this).dialog("close");
                    }
                }
            ]
        });

        $("#btnUpdateUsuario").click(function(event) {
            event.preventDefault();
            if($("#updateSenhaUser_senha").val() == ""){
                $("#dialog").dialog("open").html('<br />* Informe sua senha atual !');
            }else if($("#updateSenhaUser_senhaNova").val() == ""){
                $("#dialog").dialog("open").html('<br />* Informe a nova senha !');
            }else if($("#updateSenhaUser_confirmeSenha").val() == ""){
                $("#dialog").dialog("open").html('<br />* Confirme a senha !');
            }else if($("#updateSenhaUser_confirmeSenha").val() != $("#updateSenhaUser_senhaNova").val()){
                $("#dialog").dialog("open").html('<br />* Os campos Nova Senha e Confirme Nova Senha não estão iguais !');
            }else{
                $("#FormUpdateSenhaUser").submit();
            }
        });

});

