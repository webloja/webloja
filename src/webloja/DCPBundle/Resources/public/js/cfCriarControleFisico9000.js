$(document).ready(function() {

  $("#linha-materiais").hide();
  $("#erro").hide();
  $("#dialogErro").hide();
  $("#btnEnviarPrincipal").attr("disabled", "true");
  $("#qtdDefinida").attr("disabled", "true");

  
  $("table").tablesorter({
    theme: 'blue',
    widthFixed: true,
    widgets: ["zebra", "filter"],
    headers: {
      0: {filter: false},
      1: {filter: false},
      2: {filter: false},
      3: {filter: false}
    },
    widgetOptions: {
      filter_cssFilter: 'tablesorter-filter',
      filter_childRows: false,
      filter_hideFilters: false,
      filter_ignoreCase: true,
      filter_reset: '.reset',
      filter_searchDelay: 300,
      filter_startsWith: false,
      filter_functions: {
        0: true
      }
    }
  }).tablesorterPager(
          {
            container: $(".pager"),
            output: '{startRow} to {endRow} ({totalRows})',
            updateArrows: true,
            page: 0,
            size: 10,
            fixedHeight: false
          });


$("#modalResultado").dialog({
    autoOpen: false,    
    width: 500,
    buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $(this).dialog("close");
                    }
                }
            ]
  });

  $("#dialogErro").dialog({
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

  $("#btnEnviarPrincipal").click(function() {

    if ($("#qtdDefinida").is(':checked')) {
      var vazio = 0;
      if ($("#qtdDefinida").attr("checked", true)) {
        $(".qtd_material").each(function() {
          if ($(this).val() == "") {
            vazio++;
          }
        })

        if (vazio > 0) {
          $("#dialogErro").show();
          $("#dialogErro").html('* Não pode haver material sem quantidade definida !');
          return false;
        }
        $("#dialogErro").html("");
        $("#dialogErro").hide();
      }
    }
  })

});


