//TOGGLE MENU
jQuery(document).ready(function($) {
    $('.toggle-menu').jPushMenu();
});

$(function() {

    $( '#ri-grid' ).gridrotator( {
        rows : 4,
        columns : 8,
        maxStep : 2,
        interval : 2000,
        w1024 : {
            rows : 5,
            columns : 6
        },
        w768 : {
            rows : 5,
            columns : 5
        },
        w480 : {
            rows : 6,
            columns : 4
        },
        w320 : {
            rows : 7,
            columns : 4
        },
        w240 : {
            rows : 7,
            columns : 3
        },
    } );

});

/*MASK INPUT*/
jQuery(function($){
    $("#novoucher").mask("9999-9999-9999-99");
});
/* TOOLTIP */
$('[data-toggle="tooltip"]').tooltip()


$('#nav').affix({
    offset: {
        top: $('header').height()
    }
});
/* ADD TO CART ANIMASI*/
$('.add-to-cart').on('click', function () {
    var cart = $('.shopping-cart');
    var imgtodrag = $(this).parent('.produk-img').find("img").eq(0);
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
            .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
            .css({
                'opacity': '0.9',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'border':'1px solid #444',
                'z-index': '9999'
            })
            .appendTo($('body'))
            .animate({
                'top': cart.offset().top + 10,
                'left': cart.offset().left + 10,
                'width': 75,
                'height': 75
            }, 1000, 'easeInOutExpo');

        setTimeout(function () {
            cart.effect("shake", {
                times: 2
            }, 200);
        }, 1500);

        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {
            $(this).detach()
        });
    }
});

$(document).ready(function(){
    $(".gantiPin").hide();
    $(".textgantiPin").click(function(){
        $(".gantiPin").show();
        $(".infoAkun").hide();
    });
    $(".textEditAkun").click(function(){
        $(".gantiPin").hide();
        $(".infoAkun").show();
    });

    
    /*login form*/
    var login_options = {  
    		beforeSubmit: function(){
    			$('#frmLoginError').css('display', 'block');
    			$('#frmLoginError>div').css('display', 'none');
    			$('#frmLoginError>img').css('display', 'block');
    		},
    	    success: function(data) { 
    	    	$('#frmLoginError>img').css('display', 'none');
    	    	if(data.responseCode == 200){
    	    		window.location.href = "/home";
    	    	}else{
    	    		$('#frmLoginError>div').text(data.description);
    	    		$('#frmLoginError>div').css('display', 'block');
    	    		$('#frmLoginError').css('display', 'block');
    	    	}
    	    } 
    	};     
    $('#frmLogin').ajaxForm(login_options); 
    
        
});

$('form[name=frmRedeem]').submit(function(ev){	
	var codepluscard = $('#codepluscard').val();
	if(codepluscard == ""){
		alert("code harus diisi");
		return false;
	}else if(codepluscard.length != 14){
		alert("code kurang lengkap");
		return false;
	}else{
		$('form[name=frmRedeem]').submit();
	}	
});

$('form[name=frmForgotPassword]').submit(function(ev){	
	ev.preventDefault();
	var email = $('#txtEmail').val();
	var handphone = $('#txtHandphone').val();
	
	var url = 'http://' + window.location.hostname + '/login/forgot_password';
	$.ajax({ 
	  url : url,
	  method: "POST",
	  dataType : 'json',
	  data : {handphone : handphone, email : email},	  
	  beforeSend : function(){
		  $('#loadingForgot').css('display', 'block');
	  },
	  complete : function(data){
		  $('#loadingForgot').css('display', 'none');
		  alert(data.responseJSON.responseDescription);
		  if(data.responseCode == 200){
			  $('#detailAkun').modal('hide');
		  }
	  }
	});  
});
