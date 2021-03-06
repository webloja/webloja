
$(function(){

  $("table").tablesorter({
    theme: 'blue',
    widthFixed: true,
    widgets: ["zebra", "filter"],
    headers: {

    },
    widgetOptions : {
      filter_cssFilter   : 'tablesorter-filter',
      filter_childRows   : false,
      filter_hideFilters : false,
      filter_ignoreCase  : true,
      filter_reset : '.reset',
      filter_searchDelay : 300,
      filter_startsWith  : false,
      filter_hideFilters : false,
      filter_functions : {
        0 : true
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

});
