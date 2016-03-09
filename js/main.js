$(function() {
	var href = window.location.href;
	href = href.substr(href.lastIndexOf('/') + 1);
	href = href.replace(/\.(html|php)/, '');

	InitNavbar(href);
});

function InitNavbar(currentPage) {
	$('.nav li').removeClass('active');
	$('.nav li a[href*=' + currentPage + ']').parent('li').addClass('active');
}

function RefreshValidImg(obj) {
	var src = $(obj).attr("src");
	src = src.replace(/\?t=\d+/, '');
	src += '?t=' + (new Date()).getTime();
	$(obj).attr("src", src);
}

function RenderJSON(jsonURL) {
	$.getJSON(jsonURL, function(data) {
		//clear

		//loop	
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
		temp += '        <a href="data_tbk_url" target="_blank"><img alt="data_title" src="data_img_url" /></a>';
		temp += '        <div class="caption">';
		temp += '            <h3>data_title</h3>';
		temp += '            <p>';
		temp += '                data_price / data_commission';
		temp += '            </p>';
		temp += '            <p>';
		temp += '                月销量:data_month_sold';
		temp += '            </p>';
		temp += '            <p>';
		temp += '                <a class="btn btn-danger" href="data_tbk_url" target="_blank">去看看</a> <a class="btn" href="#">收藏</a>';
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
					.replace('data_title', data[i * 4 + j]['title'])
					.replace('data_img_url', data[i * 4 + j]['img_url'])
					.replace('data_title', data[i * 4 + j]['title'])
					.replace('data_price', data[i * 4 + j]['price'])
					.replace('data_commission', data[i * 4 + j]['commission'])
					.replace('data_month_sold', data[i * 4 + j]['month_sold'])
					.replace('data_tbk_url', data[i * 4 + j]['tbk_url']);
			}
			Row.html(Cols);
			$("#content").append(Row);
		}
	});
}

function ShowByCategory(obj, category, load_order) {
	var load_order = load_order || 1;
	var category = category || '潮装';
	$("#content").data("category", category);
	$("#content").data("load_order", load_order);

	$(".nav.navbar-nav li").removeClass("active");
	$(obj).parents("li").addClass("active");

	//TODO this need better solution
	if (window.location.href.indexOf("index.php") < 0) {
		window.location.href = "http://localhost/boystyle/index.php";
	}
	var JSON_List = $("#content").data("JSONList");
	// "/boystyle/data/BFF7A6473FF23C3C_1_50.json"
	var jsonURL = "/boystyle/data/" + category + "_1_50.json";

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
	if (obj.length == 0) {
		$(".nav.navbar-nav li").removeClass("active");
		$(".nav.navbar-nav li").eq(0).addClass("active");
	}
	ShowByCategory(category, load_order);
}

// category
// load_order
// Data_rows
// File_Name
// $("#content").data("JSONList",JSONList);
// $("#content").data("load_order",1);