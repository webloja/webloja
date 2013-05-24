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

    $("#i_data").click(function() {
        $("#data_mes").val("");
    });

    $("#ma_data").click(function() {
        $("#data_d").val("");
    });

    $('#data_dia').datetimepicker({
        pickTime: false,
        maskInput: true
    });
    $('#data_mes_ano').datetimepicker({
        pickTime: false,
        maskInput: true
    });

    $("#btnCarregados").click(function(event) {
        event.preventDefault();
        if($("#data_mes").val()=="" && $("#data_d").val()==""){
            $("#dialog").dialog("open").html('<br />* Informe o Dia ou um Mês/ano para realizar a busca !');
        }else{
            $("#FormRelatorioAbastecimetoDiario").submit();
        }
    });
});





