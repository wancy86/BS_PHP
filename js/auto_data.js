
var pageData = function() {
    $(":contains(选取)").not(":contains(已选取)").each(function() {
        $(this).click()
    });

    //next page
    $(".pagination li:eq(2) a").click();
    scrollTo(0,50000)
    pages++;
    console.log(pages);
    if (pages == 4) {
        clearInterval(page);
    }
}

var getAll = function() {

    $(":contains(选取)").not(":contains(已选取)").each(function() {
        $(this).click()
    });
}

var pages = 1;
var page = setInterval(pageData, 5000);
