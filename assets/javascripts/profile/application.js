$(document).ready(function() {
	$(document).on('click', '#save_profile', function() {
        $.post("profile/save_profile", $("#form_profile_data").serialize(), function(result) {
            $('.save_profile_error_message').addClass("hide");
            if(result == "success")
                location.reload();
            else if(result == "required_fields")
                console.log(result);
            else 
                $('.save_profile_error_message').removeClass("hide");
        });
    });

    $(document).on('click', '#profile_data', function() {
        $('.history_data').addClass("hide");
        $('.profile_data').removeClass("hide");
        $("#history_data").removeClass("active");
        $("#profile_data").addClass("active");
    });

    $(document).on('click', '#history_data', function() {
        $('.history_data').removeClass("hide");
        $('.profile_data').addClass("hide");
        $("#history_data").addClass("active");
        $("#profile_data").removeClass("active");
    });

    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
    }

    if(getURLParameter("target") == "history")
        $("#history_data").click();

    $(document).on('click', '.repeat_order', function() {
        order_id = $(this).attr("order_id");
        data = {};
        data["order_id"] = order_id;
        $.post("profile/repeat_order", data, function(result) {
            if(result == "error")
              console.log(result);
            else{ 
              result_parse = JSON.parse(result);
              if($.cookie("cart")){
                console.log("Tem coisas");
                cart = JSON.parse($.cookie("cart"));
                city_cart_id = Object.keys(cart)[0];
                city_result_id = Object.keys(result_parse)[0];
                if(city_cart_id != city_result_id){
                  $.removeCookie("cart");
                  $.cookie("cart", JSON.stringify(result_parse), { expires: 7 });
                }else{
                  rest_result_id = Object.keys(result_parse[city_result_id])[0];
                  rest_array_cart_id = Object.keys(cart[city_cart_id]);

                  if(jQuery.inArray(rest_result_id, rest_array_cart_id) > -1){
                    console.log("========")
                    rest_result_qnt = result_parse[city_result_id][rest_result_id]["qnt"];
                    rest_result_price = result_parse[city_result_id][rest_result_id]["price"];
                    rest_result_products = result_parse[city_result_id][rest_result_id]["products"];
                    rest_cart_products = cart[city_cart_id][rest_result_id]["products"];
                    next_product_index = 0;
                    $.each(rest_cart_products, function(index, product_cart) {
                      if(next_product_index < product_cart['index'])
                        next_product_index = product_cart['index'];
                    });
                    next_product_index += 1;

                    cart[city_cart_id][rest_result_id]["qnt"] += rest_result_qnt;
                    cart[city_cart_id][rest_result_id]["price"] += rest_result_price;

                    $.each(rest_result_products, function(index, product_result) {
                      not_found = true;
                      $.each(rest_cart_products, function(index, product_cart) {
                        var is_same = product_cart["extra"].length == product_result["extra"].length && product_cart["extra"].every(function(element, index) {
                            return element === product_result["extra"][index]; 
                        });
                        console.log(is_same);
                        if(product_result["id"] == product_cart["id"] && is_same){
                          cart[city_cart_id][rest_result_id]["products"][index]["qnt"] = parseInt(cart[city_cart_id][rest_result_id]["products"][index]["qnt"]) + parseInt(product_result['qnt']);
                          not_found = false;
                          return false;
                        }
                      });
                      console.log("not_found: ", not_found);
                      if(not_found){
                          product = {};
                          product['qnt'] = product_result["qnt"];
                          product['extra'] = product_result["extra"];
                          product['id'] = product_result["id"];
                          product['index'] = next_product_index;
                          cart[city_cart_id][rest_result_id]["products"].push(product);
                          next_product_index += 1;
                      }
                    });
                    
                    console.log("========")
                  }else{
                    rest_result_data = result_parse[city_result_id][rest_result_id];
                    cart[city_cart_id][rest_result_id] = rest_result_data;
                  }
                  $.cookie("cart", JSON.stringify(cart), { expires: 7 });
                }
                console.log("cart:");
                console.log(cart);
              }else{
                $.cookie("cart", JSON.stringify(result_parse), { expires: 7 });
              }
              document.location.replace("cart");
            }
        });
    });
    
});