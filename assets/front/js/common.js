$(function(){	
	var duration = 500;
	var offSet = 220;
    $(window).scroll(function() {
		var $this = $(this);
		if ($this.scrollTop() > offSet) {
			$('.header').addClass('cxm-header-fixed');
		} else {
			$('.header').removeClass('cxm-header-fixed');
		}
		
		if ($this.scrollTop() > offSet) {
			$('.back-to-top').fadeIn(duration);
		} else {
			$('.back-to-top').fadeOut(duration);
		}
	});
	
	$('.back-to-top').click(function(ev){
		ev.preventDefault();
		$('html, body').animate({scrollTop: 0}, duration);
		return false;
	});
	
	$('.form-control').focus(function(){
		$(this).parents('.cxm-label').addClass('cxm-focused');
	});
	
	$('.form-control').blur(function(){
		var cxmFldVal = $(this).val();
		if ( cxmFldVal == "" ) {
			$(this).removeClass('cxm-filled');
			$(this).parents('.cxm-label').removeClass('cxm-focused');
		} else {
			$(this).addClass('cxm-filled');
		}
	});
});

function cxm_refresh_quantity_increments() {
    $("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = $(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), $(document).ready(function() {
    cxm_refresh_quantity_increments()
}), $(document).on("updated_wc_div", function() {
    cxm_refresh_quantity_increments()
}), $(document).on("click", ".plus, .minus", function() {
    var a = $(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), $(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});

wow = new WOW({
	boxClass:     'wow',      // default
	animateClass: 'animated', // default
	offset:       0,          // default
	mobile:       true,       // default
	live:         true        // default
})
wow.init();