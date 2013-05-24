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

        $("#btnUpdateSenhaProntuario").click(function(event) {

            event.preventDefault();

            reDigits = /^\d+$/;

            if (!reDigits.test($('#updateCFUserProntuario_prontuario').val()) || $('#updateCFUserProntuario_prontuario').val()=="") {
                $('#updateCFUserProntuario_prontuario').val("");
                $("#dialog").dialog("open").html('<br />* O campo prontuário só aceita números e não pode ser vazio!');
            }else if($('#updateCFUserProntuario_senha').val()==""){
                $("#dialog").dialog("open").html('<br />* Preencha o campo Senha Atual!');
            }else if($('#updateCFUserProntuario_senhaNova').val()==""){
                $("#dialog").dialog("open").html('<br />* Preencha o campo Nova Senha!');
            }else if($('#updateCFUserProntuario_confirmeSenha').val()==""){
                $("#dialog").dialog("open").html('<br />* Preencha o campo Confirme a Nova Senha!');
            }else if($('#updateCFUserProntuario_senhaNova').val()!=$('#updateCFUserProntuario_confirmeSenha').val()){
                $("#dialog").dialog("open").html('<br />* Os campos Nova Senha e Confirme Nova Senha não podem ser diferentes!');
            }else {
                $("#FormUpdateSenhaProntuario").submit();
            }
        });
        
        $("#btnResetSenhaProntuario").click(function(event) {

            event.preventDefault();

            reDigits = /^\d+$/;

            if (!reDigits.test($('#resetSenhaProntuario_prontuario').val()) || $('#resetSenhaProntuario_prontuario').val()=="") {
                $('#resetSenhaProntuario_prontuario').val("");
                $("#dialog").dialog("open").html('<br />* O campo prontuário só aceita números e não pode ser vazio!');
            }else {
                $("#FormResetSenhaProntuario").submit();
            }
        });

});

