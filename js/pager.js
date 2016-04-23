/*
*Name: BootStrap Pager 
*Author: CooMark
*version: 1.0
*/

function InitBootPager(options) {
    var pagerdiv = options.pagerdiv;
    var json_url = options.json_url;
    var totalRecords = options.totalRecords;
    var pageSize = options.pageSize;
    var datafields = options.datafields;
    var extracolumns = options.extracolumns;

    pagerdiv = $(pagerdiv);
    pageSize = pageSize || 20;
    var pages = Math.ceil(totalRecords / pageSize);
    var header = "<nav> <ul class='pagination'><li class='disabled previous'><a href='#' aria-label='Next'><span aria-hidden='true'>&laquo;</span></a></li><li class='active'><a href='#'>1</a></li>";
    var pagers = "";

    for (i = 2; i <= pages; i++) {
        pagers = pagers + "<li><a href='#'>" + i + "</a></li>";
    }

    var footer = "<li class='next'><a href='#' aria-label='Previous'><span aria-hidden='true'>&raquo;</span></a></li></ul> </nav>";

    pagerdiv.find('#pagerbar').html(header + pagers + footer);
    pagerdiv.data({
        totalrows: totalRecords,
        pagesize: pageSize,
        currentpage: 1,
        dataurl: json_url,
        totalpages: pages,
        datafields: datafields,
        extracolumns: extracolumns
    });

    pagerdiv.find('li').on("click", function() {
        var page_index = pagerdiv.data('currentpage');
        console.log(page_index);
        if ($(this).hasClass('previous')) {
            page_index = page_index - 1;
        } else if ($(this).hasClass('next')) {
            page_index = page_index + 1;
        } else {
            page_index = $(this).find('a').html();
        }

        $('li.next').removeClass('disabled');
        $('li.previous').removeClass('disabled');
        if (page_index <= 0) {
            page_index = 1;
            $('li.previous').addClass('disabled');
        }
        if (page_index > pagerdiv.data('totalpages')) {
            page_index = pagerdiv.data('totalpages');
            $('li.next').addClass('disabled');
        }

        if (page_index == pagerdiv.data('currentpage') && page_index != 1) {
            return false;
        }
        pagerdiv.find('li').removeClass('active');
        pagerdiv.find('li').eq(page_index).addClass('active');
        pagerdiv.data('currentpage', page_index);

        ClickPage(pagerdiv);
    });

    pagerdiv.find('li').eq(1).click();

}

function ClickPage(pagerdiv) {
    var pagerdiv = $(pagerdiv)
    var page_index = pagerdiv.data('currentpage');

    var url = pagerdiv.data('dataurl') + '?' + $.param({
            currentpage: pagerdiv.data('currentpage'),
            pagesize: pagerdiv.data('pagesize')
        })

    $.ajax({
        url: url,
        method: 'get',
        success: function(data) {
            var table = pagerdiv.find('table');
            var columns = table.find("tr:eq(0) th").length;
            var datafields = pagerdiv.data('datafields');
            var extracolumns = pagerdiv.data('extracolumns');

            table.find('tr:gt(0)').remove();

            for (var i = data.length - 1; i >= 0; i--) {
                var RowData = data[i];

                var tds = '';
                for (var j = 0; j < datafields.length; j++) {
                    tds += '<td>' + RowData[datafields[j]] + '</td>';
                }
                for (var c = 0; c < columns - datafields.length; c++) {
                    tds += '<td>' + extracolumns[c] + '</td>';
                }

                table.append($('<tr>' + tds + '</tr>'));
            };
        }
    });
}