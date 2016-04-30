/*
 *Name: BootStrap Pager 
 *Author: CooMark
 *version: 2.0
 *BootStrap version: 3.0
 */
(function($) {
    $.fn.pagingTable = function(options) {
        var table = $(this);
        var settings = $.extend({
            json_url: null,
            pageSize: 10
        }, options);

        if (!table.is("table")) {
            return this;
        }

        table.data({
            pagesize: settings.pageSize,
            currentpage: 1,
            dataurl: settings.json_url
        });

        var load_json = function(currentpage) {
            var currentpage = currentpage || 1;
            $.ajax({
                url: settings.json_url,
                method: 'get',
                data: 'pagesize=' + settings.pageSize + '&currentpage=' + currentpage,
                success: function(resp) {
                        var re_pagebar = table.data('totalrecords') == resp.totalrecords ? 0 : 1;
                        table.data('totalrecords', resp.totalrecords);
                        var data = resp.data;
                        table.data('totalpages', Math.ceil(resp.totalrecords / settings.pageSize));
                        table.find('tbody tr').remove();

                        //re-generate the paging bar
                        var template = table.find("thead tr[template]");
                        var pk_field = template.attr('pk-field');
                        var tds = template.find('td');

                        var datarow = (template.clone())
                            .removeAttr('template')
                            .removeAttr('pk-field')
                            .removeAttr('style');

                        for (var dr = 0; dr < data.length; dr++) {
                            var newrow = datarow.clone()
                            for (var c = 0; c < tds.length; c++) {
                                var datafield = template.find('td').eq(c).attr('data-field');
                                if (datafield) {
                                    newrow.find('td').eq(c).html(data[dr][datafield]);
                                }
                            }
                            if (pk_field) {
                                newrow.attr('pk', data[dr][pk_field]);
                            }
                            table.find('tbody').append(newrow);
                        }
                        if (re_pagebar) {
                            getPageBar(currentpage);
                        }
                    } //end success
            });
        }
        load_json(1);

        var getPageBar = function(currentpage) {
            var currentpage = currentpage || 1;
            totalpages = table.data('totalpages');
            var tmp = '';
            tmp += "<nav>";
            tmp += "    <ul class='pagination'>";
            tmp += "        <li class='disabled first'><a href='#' aria-label='First'><span class='glyphicon glyphicon-step-backward'></span></a></li>";
            tmp += "        <li class='disabled previous'><a href='#' aria-label='Next'><span class='glyphicon glyphicon-chevron-left'></span></a></li>";
            tmp += "        <li class='active'><a href='#'>1</a></li>";

            var header = tmp;
            var pagers = "";

            for (i = 2; i <= totalpages; i++) {
                pagers = pagers + "<li><a href='#'>" + i + "</a></li>";
            }

            tmp = ''
            tmp += "        <li class='next'><a href='#' aria-label='Previous'><span class='glyphicon glyphicon-chevron-right'></span></a></li>";
            tmp += "        <li class='last'><a href='#' aria-label='First'><span class='glyphicon glyphicon-step-forward'></span></a></li>";
            tmp += "    </ul>";
            tmp += "</nav>";
            var footer = tmp;

            var barName = 'pagerbar_' + table.attr("id");
            $("#" + barName).remove();

            var pagerbar = $("<div></div>").attr("id", barName);
            pagerbar.html(header + pagers + footer).insertAfter(table);

            pagerbar.find('li').on("click", function() {
                page_click(this);
            });

        };

        var page_click = function(obj) {
            if ($(obj).hasClass('disabled')) {
                return false;
            }

            var pagerbar = $(obj).parents('ul');
            var page_index = table.data('currentpage');

            if ($(obj).hasClass('previous')) {
                page_index = page_index - 1;
            } else if ($(obj).hasClass('next')) {
                page_index = page_index + 1;
            } else if ($(obj).hasClass('first')) {
                page_index = 1;
            } else if ($(obj).hasClass('last')) {
                page_index = table.data('totalpages');
            } else {
                page_index = $(obj).find('a').html();
            }

            pagerbar.find('li').removeClass('disabled').removeClass('active');

            if (page_index <= 1) {
                page_index = 1;
                pagerbar.find('li.previous, li.first').addClass('disabled');
            }
            if (page_index >= table.data('totalpages')) {
                page_index = table.data('totalpages');
                pagerbar.find('li.next, li.last').addClass('disabled');
            }

            page_index = parseInt(page_index);
            table.data('currentpage', page_index);
            pagerbar.find('li').eq(page_index + 1).addClass('active');

            load_json(page_index);
        };


        return this;
    };

})($);