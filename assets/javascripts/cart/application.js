$(document).ready(function() {
    $('.restoran-cart_delete').click(function(){
        rest_id = $(this).attr("rest_id");
        data = JSON.parse($.cookie("cart"));
        city_id = Object.keys(data)[0];
        delete data[city_id][rest_id];
        if(jQuery.isEmptyObject(data[city_id])){
            $.removeCookie("cart")
            javascript:history.back()
        }else{
            $(this).closest(".restoran-cart").remove();
            $.cookie("cart", JSON.stringify(data), { expires: 7 });
        }
        
    });

    $('.product-cart_delete').click(function(){
      rest_id = $(this).attr("rest_id");
      prod_index = $(this).attr("prod_index");
      prod_price = parseFloat($('.product-cart_price[prod_index=' + prod_index + ']').attr("price"));
      total_price = parseFloat($('.cart-summary_price_value').attr("value"));
      prod_qnt = parseInt($('.product-cart_calc-result[prod_index=' + prod_index + '][rest_id=' + rest_id + ']').val());
      product_row = $('.product-cart[prod_index=' + prod_index + '][rest_id=' + rest_id + ']');

      data = JSON.parse($.cookie("cart"));
      city_id = Object.keys(data)[0];
      
      data[city_id][rest_id]['products'].some(function(product, index, object) {
        if(product['index'] == prod_index){
          object.splice(index, 1);
          $('.cart-summary_price_value').text((total_price-(prod_price*prod_qnt)).toFixed(2));
          $('.cart-summary_price_value').attr("value", (total_price-(prod_price*prod_qnt)).toFixed(2));
          calcule_price();
          data[city_id][rest_id]['price'] = parseFloat(data[city_id][rest_id]['price']) - (parseFloat(prod_price) * parseFloat(prod_qnt));
          data[city_id][rest_id]['qnt'] -= prod_qnt;
          product_row.remove();
          return true;
        }
      });

      if(data[city_id][rest_id]['products'].length == 0){
        delete data[city_id][rest_id];
        if(jQuery.isEmptyObject(data[city_id])){
          $.removeCookie("cart");
          javascript:history.back();
        }else
          $.cookie("cart", JSON.stringify(data), { expires: 7 });
        $("#" + city_id).closest(".restoran-cart").remove();
      }else
        $.cookie("cart", JSON.stringify(data), { expires: 7 });
        
    });
        

    $('.product-cart_calc.btn--minus').click(function(){
        rest_id = $(this).attr("rest_id");
        prod_index = $(this).attr("prod_index");
        data = JSON.parse($.cookie("cart"));
        city_id = Object.keys(data)[0];
        prod_price = parseFloat($('.product-cart_price[prod_index=' + prod_index + ']').attr("price")).toFixed(1);
        total_price = parseFloat($('.cart-summary_price_value').attr("value")).toFixed(1);
        product_row = $('.product-cart[prod_index=' + prod_index + '][rest_id=' + rest_id + ']');
        prod_qnt = parseInt($('.product-cart_calc-result[prod_index=' + prod_index + '][rest_id=' + rest_id + ']').val());

        data[city_id][rest_id]['products'].some(function(product, index, object) {
            if(product['index'] == prod_index){
                $('.cart-summary_price_value').text((total_price-prod_price).toFixed(2));
                $('.cart-summary_price_value').attr("value", (total_price-prod_price).toFixed(2));
                calcule_price();
                data[city_id][rest_id]['price'] = parseFloat(data[city_id][rest_id]['price']) - parseFloat(prod_price);

                data[city_id][rest_id]['qnt'] -= 1;
                if(product['qnt'] == 1){
                    object.splice(index, 1);
                    product_row.remove();
                }else{
                    product['qnt'] -= 1;
                    $('.product-cart_calc-result[prod_index=' + prod_index + '][rest_id=' + rest_id + ']').val(prod_qnt-1);
                }
                return true;
            }
        });

        if(data[city_id][rest_id]['products'].length == 0){
            delete data[city_id][rest_id];
            if(jQuery.isEmptyObject(data[city_id])){
                $.removeCookie("cart")
                javascript:history.back()
            }else
                $.cookie("cart", JSON.stringify(data), { expires: 7 });
            $("#" + city_id).closest(".restoran-cart").remove();
        }else
            $.cookie("cart", JSON.stringify(data), { expires: 7 });

    });

    $('.product-cart_calc.btn--plus').click(function(){
        rest_id = $(this).attr("rest_id");
        prod_index = $(this).attr("prod_index");
        data = JSON.parse($.cookie("cart"));
        city_id = Object.keys(data)[0];
        prod_price = parseFloat($('.product-cart_price[prod_index=' + prod_index + ']').attr("price")).toFixed(1);
        total_price = parseFloat($('.cart-summary_price_value').attr("value")).toFixed(1);
        product_row = $('.product-cart[prod_index=' + prod_index + '][rest_id=' + rest_id + ']');
        prod_qnt = parseInt($('.product-cart_calc-result[prod_index=' + prod_index + '][rest_id=' + rest_id + ']').val());

        data[city_id][rest_id]['products'].some(function(product, index, object) {
            if(product['index'] == prod_index){
                $('.cart-summary_price_value').text((parseFloat(total_price)+parseFloat(prod_price)).toFixed(2));
                $('.cart-summary_price_value').attr("value", (parseFloat(total_price)+parseFloat(prod_price)).toFixed(2));
                calcule_price();
                data[city_id][rest_id]['price'] = parseFloat(data[city_id][rest_id]['price']) + parseFloat(prod_price);
                data[city_id][rest_id]['qnt'] = parseFloat(parseFloat(data[city_id][rest_id]['qnt']) + parseFloat(1)).toFixed(0);
                product['qnt'] = parseFloat(parseFloat(product['qnt']) + parseFloat(1)).toFixed(0);
                $('.product-cart_calc-result[prod_index=' + prod_index + '][rest_id=' + rest_id + ']').val(prod_qnt+1);

                return true;
            }
        });

        $.cookie("cart", JSON.stringify(data), { expires: 7 });

    });

    //////////////////////////////////
    // Calcule zone
    selected_zone = $('.city_zone_select').val();
    $('.delivery_count[zona=' + selected_zone + ']').removeClass("hide");

    calcule_price();

    $( ".city_zone_select" ).change(function(e) {
        selected_zone = $('.city_zone_select').val();
        $('.delivery_count').addClass("hide");
        $('.delivery_count[zona=' + selected_zone + ']').removeClass("hide");

        calcule_price();
    });

    function calcule_price(){
        display_price = $('.delivery_count:visible').children(".product-cart_price");
        total_price = parseFloat($('.cart-summary_price_value').attr("value")).toFixed(1);
        price = parseFloat($('.delivery_count:visible').attr("price")).toFixed(1);
        bonus = parseFloat($('.delivery_count:visible').attr("bonus")).toFixed(1);
        discount = parseFloat($('.delivery_count:visible').attr("discount")).toFixed(1);
        
        if(parseFloat(total_price) > parseFloat(bonus))
            to_show = parseFloat(price) - parseFloat(price)*parseFloat(discount)/100;
        else
            to_show = parseFloat(price);

        to_show = parseFloat(to_show).toFixed(2);

        display_price.text(to_show);

        $('.cart-summary_price_value').text((parseFloat(total_price)+parseFloat(to_show)).toFixed(2));

    }

    $('.finish_cart').click(function(){
        $.post("cart/finish_cart", $("#cart_form").serialize(), function(result) {
            if(result == "success"){
                data = JSON.parse($.cookie("cart"));
                city_id = Object.keys(data)[0];
                rest_id = Object.keys(data[city_id])[0];
                delete data[city_id][rest_id];
                if(jQuery.isEmptyObject(data[city_id])){
                    $.removeCookie("cart")
                    javascript:history.back()
                }else{
                    $(this).closest(".restoran-cart").remove();
                    $.cookie("cart", JSON.stringify(data), { expires: 7 });
                }
            }
            else 
                console.log(result);
        });
    });

});