$(document).ready(function() {

  $("#linha-materiais").hide();
  $("#erro").hide();
  $("#dialogErro").hide();
  $("#btnEnviarPrincipal").attr("disabled", "true");
  $("#qtdDefinida").attr("disabled", "true");

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

  $('#qtdDefinida').click(function() {

    $(".qtd_material").attr("disabled", false);

  });

  $('#qtdTotal').click(function() {

    $(".qtd_material").val("");
    $(".qtd_material").attr("disabled", true);

  });
  
});


