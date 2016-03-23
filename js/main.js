$(function() {
    $(window).scroll(function() {
        if (window.location.href.indexOf("index.php") < 0) {
            return false;
        }
        var scrollTop = $(this).scrollTop();
        var windowHeight = $(window).height();
        var documentHeight = $(document).height();
        if (scrollTop == documentHeight - windowHeight) {
            // console.log('scrollTop:'+scrollTop);
            // console.log('documentHeight-windowHeight:'+(documentHeight-windowHeight));
            ScrollPaging();
        }

        //add / remove backToTop
        if (documentHeight > windowHeight && scrollTop > 300) {
            //add
            if ($("#backtoTop").length == 0) {
                $("body").append($('<div id="backtoTop" style="position:fixed;bottom:200px;right:30px;cursor:pointer;"><img src="./images/top.png"></div>'));
                $("#backtoTop").click(function() {
                    scroll(0, 0);
                    $('#backtoTop').remove();
                });
            }
        } else {
            //remove
            $("#backtoTop").remove();
        }

    });

    //make the menu open onfocus
    $('li.dropdown').mouseover(function() {
        $(this).addClass('open');
    }).mouseout(function() {
        $(this).removeClass('open');
    });

    //add click event to pro link
    $("#content").on("click", 'a.pro', function() {
        // console.log($(this).attr("pro_id"));
        $.ajax({
            url: "ClickHistory_Action.php",
            data: {
                action: "click",
                pro_id: $(this).attr("pro_id")
            },
            success: function(data) {
                console.log(data);
            }
        });
        window.open($(this).attr("url"));
    });
});

function RefreshValidImg(obj) {
    var src = $(obj).attr("src");
    src = src.replace(/\?t=\d+/, '');
    src += '?t=' + (new Date()).getTime();
    $(obj).attr("src", src);
}

//get JSON data from URL then render
function RenderJSON(jsonURL) {
    $.getJSON(jsonURL, function(data) {
        RenderJSONData(data);
    });
}

//render JSON data
function RenderJSONData(data) {
    // data[i]['pro_id']
    // data[i]['title']
    // data[i]['tbk_url']
    // data[i]['price']
    // data[i]['img_url']
    // data[i]['month_sold']
    // data[i]['detail_url']
    // data[i]['comm_percent']
    // data[i]['commission']

    // data[i]['back_BB']
    // data[i]['cat_id']
    // data[i]['disabled']
    // data[i]['earn']
    // data[i]['entrydate']
    // data[i]['img_list']
    // data[i]['seller_ww']
    // data[i]['shop_name']
    // data[i]['short_tbk_url']
    // data[i]['show_order']
    var temp = "";
    temp += '<div class="col-md-3">';
    temp += '    <div class="thumbnail">';
    temp += '        <a class="pro" href="javascript:void(0);" pro_id="data_pro_id" url="data_tbk_url" target="_blank"><img alt="data_title" src="data_img_url" /></a>';
    temp += '        <div class="caption">';
    temp += '            <h3>data_title</h3>';
    temp += '            <p>';
    temp += '                价格: ￥data_price / 返利: data_commission BB / 月销量:data_month_sold';
    temp += '            </p>';
    // temp += '            <p>';
    // temp += '                月销量:data_month_sold';
    // temp += '            </p>';
    temp += '            <p>';
    if (window.location.href.indexOf('user_favorite.php') > 0) {
        temp += '			<a class="btn btn-danger pro" href="javascript:void(0);" pro_id="data_pro_id" url="data_tbk_url" target="_blank">去看看</a> <button tabindex="0" onclick="DelFavorite(data_pro_id)" class="btn" href="#"><span class="glyphicon glyphicon-heart"></span> 取消收藏</button>';
    } else {
        temp += '			<a class="btn btn-danger pro" href="javascript:void(0);" pro_id="data_pro_id" url="data_tbk_url" target="_blank">去看看</a> <button tabindex="0" onclick="AddFavorite(this, data_pro_id)" class="btn"><span class="glyphicon glyphicon-heart-empty"></span> 添加收藏</button>';
    }
    temp += '            </p>';
    temp += '        </div>';
    temp += '    </div>';
    temp += '</div>';
    var row = '<div class="row"></div>';

    var total_rows = Math.ceil(data.length / 4);
    var last_cols = data.length % 4;

    for (var i = 0; i < total_rows; i++) {
        var cols = (last_cols > 0 && i == total_rows - 1) ? last_cols : 4;

        var Row = $('<div class="row"></div>').clone();
        var Cols = "";
        for (var j = 0; j < cols; j++) {
            Cols += temp.replace('data_tbk_url', data[i * 4 + j]['tbk_url'])
                .replace(/data_pro_id/g, data[i * 4 + j]['pro_id'])
                .replace(/data_title/g, data[i * 4 + j]['title'])
                .replace(/data_img_url/g, data[i * 4 + j]['img_url'])
                .replace(/data_title/g, data[i * 4 + j]['title'])
                .replace(/data_price/g, data[i * 4 + j]['price'])
                .replace(/data_commission/g, data[i * 4 + j]['commission'])
                .replace(/data_month_sold/g, data[i * 4 + j]['month_sold'])
                .replace(/data_tbk_url/g, data[i * 4 + j]['tbk_url']);
        }
        Row.html(Cols);
        $("#content").append(Row);
    }
}

function ShowByCategory(obj, category, load_order) {
    var category = category || '潮装';
    var load_order = load_order || 1;
    // console.log(category);
    // console.log(load_order);

    $("#content").data("category", category);
    $("#content").data("load_order", load_order);

    $(".nav.navbar-nav li").removeClass("active");
    $(obj).parents("li").addClass("active");

    //TODO this need better solution
    if (window.location.href.indexOf("index.php") < 0) {
        // console.log('redirect');
        window.location.href = "http://localhost/boystyle/index.php";
    }

    // category // load_order // Data_rows // File_Name
    var JSON_List = $("#content").data("JSONList");
    var JSONFile = "";
    for (var i = 0; i < JSON_List.length; i++) {
        var temp = JSON_List[i];
        // console.log('-----------------');
        // console.log(temp.category);
        // console.log(temp.load_order);
        if (temp.category == category && temp.load_order == load_order) {
            JSONFile = temp;
            break;
        }
    }
    if (JSONFile == "") {
        console.log('没有更多数据');
        if ($("#content .end_list").length == 0) {
            var nomoreData = $('<div class="row end_list well well-lg"> <div class="col-md-12"> <h3 class="text-center"> 没有更多数据 </h3> </div> </div>');
            $("#content").append(nomoreData);
        }
        return false;
    }

    // "/boystyle/data/BFF7A6473FF23C3C_1_50.json"
    var jsonURL = "/boystyle/data/" + JSONFile.File_Name;

    // console.log(jsonURL);

    if (load_order == 1) {
        $("#content").html('');
    }
    RenderJSON(jsonURL);
}

function ScrollPaging() {
    //category, load_order
    var category = $("#content").data("category");
    var load_order = $("#content").data("load_order") + 1;
    var obj = $(".nav.navbar-nav li.active a");
    if (!obj || obj.length == 0) {
        $(".nav.navbar-nav li").removeClass("active");
        $(".nav.navbar-nav li").eq(0).addClass("active");
        obj = $(".nav.navbar-nav li.active a");
    }
    ShowByCategory(obj, category, load_order);
}

function AddFavorite(obj, pro_id) {
    $.ajax({
        url: "favorite_action.php",
        method: "get",
        data: {
            action: "add",
            pro_id: pro_id
        },
        success: function(data) {
            $(obj).attr({
                "title": "收藏成功",
                "data-toggle": "popover",
                "data-trigger": "focus",
                "data-content": "请在我的收藏中查看" 
            }).popover('show');

            // console.log(data);
        }
    });
}

function DelFavorite(pro_id) {
    $.ajax({
        url: "favorite_action.php",
        method: "get",
        data: {
            action: "delete",
            pro_id: pro_id
        },
        success: function(data) {
            // console.log(data);
            window.location.reload();
            //TODO using AJAX
        }
    });
}


function ShowFavorite() {
    $.ajax({
        url: "favorite_action.php",
        method: "get",
        data: {
            action: "show"
        },
        success: function(data) {
            // console.log(data);
            RenderJSONData($.parseJSON(data));
        }
    });
}