$(function(){
  
  $("#tableNcarregados").tablesorter({
    theme: 'blue',
    widthFixed: true,
    widgets: ["zebra", "filter"],
    headers: {
        3:{filter:false},
        4:{filter:false},
        5:{filter:false},
        6:{filter:false}
    },
    widgetOptions : {
      filter_cssFilter   : 'tablesorter-filter',
      filter_childRows   : false,
      filter_hideFilters : false,
      filter_ignoreCase  : true,
      filter_reset : '.reset',
      filter_searchDelay : 300,
      filter_startsWith  : false,
      filter_functions : {
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