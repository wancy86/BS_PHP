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


	$('li.dropdown').mouseover(function() {
		$(this).addClass('open');
	}).mouseout(function() {
		$(this).removeClass('open');
	});
});

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
		temp += '                价格: ￥data_price / 返利: data_commission BB / 月销量:data_month_sold';
		temp += '            </p>';
		// temp += '            <p>';
		// temp += '                月销量:data_month_sold';
		// temp += '            </p>';
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

	console.log(jsonURL);

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

function AddFavorite (uid,pro_uid) {
	$.ajax({
		url:"",
		method:"get",
		data:{
			
		},
		success:function  (data){
			
		}
	});	
}