$(document).ready(function() {
    zeraCampos();
    desativarCampos();

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

    $("#addCFUserProntuario_prontuario").keypress(function() {

                zeraCampos();
                desativarCampos();

    });
    

    $("#btnCriarUsuario").click(function(event) {
        event.preventDefault();
              
        if ($("#addCFUserProntuario_prontuario").val() == "") {

            $("#dialog").dialog("open").html('<br />* Informe o Prontuário !');

        } else if ($("#addCFUserProntuario_senha").val() == "") {

            $("#dialog").dialog("open").html('<br />* Informe a Senha !');

        } else if ($("#addCFUserProntuario_confirmeSenha").val() == "") {

            $("#dialog").dialog("open").html('<br />* Confirme a Senha !');

        } else if ($("#addCFUserProntuario_senha").val() != $("#addCFUserProntuario_confirmeSenha").val()) {

            $("#dialog").dialog("open").html('<br />* Os campos Senha e Confirme a Senha precisam ser iguais !');

        } else {

            $("#FormCFUserProntuario").submit();

        }
    });

});

function ativarCampos() {

    $("#addCFUserProntuario_nome").attr('disabled', false);
    $("#addCFUserProntuario_senha").attr('disabled', false);
    $("#addCFUserProntuario_confirmeSenha").attr('disabled', false);
    $("#btnCriarUsuario").attr('disabled', false);

}
function desativarCampos() {

    $("#addCFUserProntuario_nome").attr('disabled', true);
    $("#addCFUserProntuario_senha").attr('disabled', true);
    $("#addCFUserProntuario_confirmeSenha").attr('disabled', true);
    $("#btnCriarUsuario").attr('disabled', true);

}
function zeraCampos() {

    $("#addCFUserProntuario_nome").val("");
    $("#addCFUserProntuario_senha").val("");
    $("#addCFUserProntuario_confirmeSenha").val("");

}


