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