$(document).ready(function() {
    $('.prodImage').click( function(){
    	//$('[prodDesc=' + $(this).attr('id') + ']').show();
    	$(this).find('div').css('display', function(_, value){return value=='none'?'block':'none'})
    });

    function teste(){
    	console.log("teste bem feito");
    }
    $("#theBody").on('click', function () {
        $('.collapse.in').collapse('hide');
    });

    $("#selectedProduct").on('click', function (e) {
        e.stopPropagation();
    });

    $(".plusProd").on('click', function (e) {
        e.stopPropagation();
    });


    $('#selectedProduct').on('click', '.minusProd', function(){
    	if(parseInt($('[selectedcountprod="' + $(this).attr("forMinus") + '"]').text()) == 1){
    		//$('#table"' + $(this).attr("forMinus") + '"').remove();
            $("[id='table" + $(this).attr("forMinus") + "']").remove();
    	}
    	else{
    		$('[selectedcountprod="' + $(this).attr("forMinus") + '"]').text((parseInt($('[selectedcountprod="' + $(this).attr("forMinus") + '"]').text())-1));
    	}
    });

    $('#clean_all').click( function(){
        $('.table_prod').remove();
        $('#clean_all').hide();
        $('.navbar-collapse.in').collapse('hide');
        $('#prod_notification').hide();
    });

    $('.plusProd').click( function(){
        var name = $(this).attr("value");
        //var name = $(this).parent().text().trim();
        $('#prod_notification').show();
        $('#clean_all').show();
        $('#prod_notification').css("background-color", "rgb(" + (Math.floor(Math.random() * 255) + 1) + "," + (Math.floor(Math.random() * 255) + 1) + "," + (Math.floor(Math.random() * 255) + 1) + ")")
    	if($('[selectedcountprod="' + name + '"]').size() > 0){
    		value = parseInt($('[selectedcountprod="' + name + '"]').text()) + 1;
    		$('[selectedcountprod="' + name + '"]').text(value);
    	}
    	else{
    		value = 1;
	    	$('#selectedProduct').append(
				'<table align="center" class="table_prod" style="width:90%; margin-bottom:15px;" id="table' + name + '">'
			       + '<tr style="color:#aaa;margin-bottom:-1px;font-size:19px;">'
			         + '<td style="width:10%;"><p style="margin:0">-</p></td>'
			         + '<td style="width:80%;"><p style="margin:0">' + name + '</p></td>'
			         + '<td style="width:10%;"><p style="margin:0" selectedCountProd="' + name +'">' + value + '</p></td>'
			         + '<td style="width:10%;"><span class="glyphicon glyphicon-minus-sign minusProd" style="font-size:30px;" forMinus="' + name + '"</span></td>'
			       + '</tr>'
			     + '</table>'
	        );
	    }

    });

    $('.separador').click( function(){
        father = $(this).attr("father");
        $('.' + father).not("." + $(this).attr("id")).hide();
        $('.' + $(this).attr("id")).toggle();
    });

    $('.image_menu').css("height",$(window).width()/2);
    $('.image_menu_especial2').css("height",$(window).width()/2);
    $('.category_menu .especial2 .image_menu_especial2').css("height",$(window).width()/2);
    $('.category_menu .especial3 .image_menu_especial3').css("height",$(window).width());
    // Logotipos na pagina index
    $('.logo_rest').css("height",$(window).width()/4);

    $('.image_click').click(function(){
        var destino = $(this).attr("redirect");
        var origem = $(this).attr("father");
        var oldName = $(".title_menu").text();
        var name = $(this).attr("name");
        var back = $("#back");
        
        //$('#' + origem).addClass('flipped');
        //$('#' + destino).removeClass('flipped');

        $('#' + origem).hide();
        $('#' + destino).show();

        $(".title_menu").text(name);
        back.attr("redirect", origem);
        back.attr("father", destino);
        back.attr("name", oldName);
        back.show();

        //$('html, body').animate({ scrollTop: 0 }, 'fast');
        scroll(0,0);
    });

    $("#back").click(function(){
        var back = $("#back");
        var destino = back.attr("redirect");
        var origem = back.attr("father");
        $(".title_menu").text(back.attr("name"));

        $('#' + origem).hide();
        $('#' + destino).show();


        if(destino == "main")
            back.hide();

        $('html, body').animate({ scrollTop: 0 }, 'fast');
    });

    $("#back_from_prod").click(function(){
        var back = $("#back");
        var back_from_prod = $("#back_from_prod");
        var destino = back_from_prod.attr("redirect");
        var origem = back_from_prod.attr("father");
        $(".title_menu").text(back_from_prod.attr("name"));

        $('#' + origem).addClass('flip');
        $('#' + destino).show();
        $('#' + destino).removeClass('flip');

        back.show();
        back_from_prod.hide();

        //$('html, body').animate({ scrollTop: 0 }, 'fast');
    });

    $('.to_prod').click(function(){
        var destino = $(this).attr("redirect");
        var origem = $(this).attr("father");
        var oldName = $(".title_menu").text();
        var back = $("#back");
        var back_from_prod = $("#back_from_prod");
        var image = $(this).find('div').css("background");
        var prod_name = $(this).find('div').eq(1).text().trim();
        var prod_desc = $(this).attr("desc");
        var prod_price = $(this).attr("price");

        $('#' + origem).addClass('flip');
        $('#' + origem).hide();
        $('#' + destino).removeClass('flip');
        $('#' + destino + " #cover_image").css('background', image);
        $('#cover_image').css("height",$('#cover_image').width());
        $('#prod_name').text(prod_name);
        $('#prod_desc').text(prod_desc);
        $('#prod_price').text("Preço: " + prod_price + "€");
        $('#produto .plusProd').attr("value", prod_name);

        $(".title_menu").text(prod_name);
        back_from_prod.attr("redirect", origem);
        back_from_prod.attr("father", destino);
        back_from_prod.attr("name", oldName);
        back_from_prod.show();
        back.hide();

        $('html, body').animate({ scrollTop: 0 }, 'fast');
        //scroll(0,0);
    });

    function getElement(id) {
        return document.getElementById(id)
    }

    $('#changeBGColor').change( function(){
        $('.bg_color').css("background-color", $( "select option:selected").val());
    });

    $('#changeLang').change( function(){
        window.location.href = $(this).val();
    });

    $(window).load(function() {
        $('#hideAll').hide();
    });

    $('#novidades').click(function(){
        $('.btn').removeClass("active");
        $(this).addClass("active");
        $('.btns').hide();
        $('.' + $(this).attr('id')).show();
    });

    $('#info').click(function(){
        $('.btn').removeClass("active");
        $(this).addClass("active");
        $('.btns').hide();
        $('.' + $(this).attr('id')).show();
    });

    $('#menu').click(function(){
        $('.btn').removeClass("active");
        $(this).addClass("active");
        $('.btns').hide();
        $('.' + $(this).attr('id')).show();
    });

});





/*navigator.geolocation.getCurrentPosition(showPosition);
function showPosition(position) {
	$('#cenas').text("Latitude: " + position.coords.latitude + " | Longitude: " + position.coords.longitude);  
}*/