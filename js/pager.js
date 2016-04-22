function ShowBSPage(totalRecords, pageSize) {
    var pageSize = pageSize || 20;
    var pages = Math.ceil(totalRecords / pageSize);
    var header = "<nav> <ul class='pagination'><li class='disabled'><a href='#' aria-label='Next'><span aria-hidden='true'>&laquo;</span></a></li><li class='active'><a href='#'>1</a></li>";
    var pagers = "";

    for (i = 2; i <= pages; i++) {
        pagers = pagers + "<li><a href='#'>"+i+"</a></li>";
    }

    var footer = "<li><a href='#' aria-label='Previous'><span aria-hidden='true'>&raquo;</span></a></li></ul> </nav>";
    return header + pagers + footer;
}

function ClickPage(page_index) {

}