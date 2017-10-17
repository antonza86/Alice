$(document).ready(function() {
    ///////////////// MENU OPEN //////////////////////
    if ($(".sort-block--interactive").length) {
        $(".sort-block--interactive").find(".sort-block_header").on("click", function(i) {
            i.preventDefault();
            var h = $(this).parents(".sort-block--interactive");
            if ($(h).hasClass("sort-block--interactive--open")) {
                $(h).find(".sort-block_content").slideUp("fast", function() {
                    $(h).removeClass("sort-block--interactive--open")
                })
            } else {
                $(h).find(".sort-block_content").slideDown("fast", function() {
                    $(h).addClass("sort-block--interactive--open")
                })
            }
            return false
        });
        $(".sort-block--interactive .active").closest(".sort-block--interactive").addClass("sort-block--interactive--open")
    }

    ///////////////// TAB'S //////////////////////
    $("#see_more_info_box").click(function() {
      $('#more_info_box').removeClass("hide");
      $('#menu_box').addClass("hide");
      $("#see_more_info_box").addClass("active");
      $(".see_menu_box").removeClass("active");
      if(!$(this).data('type'))
        enable_maps();
    });

    $(".see_menu_box").click(function() {
        $('#more_info_box').addClass("hide");
        $('#menu_box').removeClass("hide");
        $("#see_more_info_box").removeClass("active");
        $(".see_menu_box").addClass("active");
    });

    ///////////////// MAPS //////////////////////
    var js = document.createElement("script");
    js.type = "text/javascript";
    js.src = "http://maps.google.com/maps/api/js?key=AIzaSyBOV4nf3IiNffrfETQuyW8oGIzGpUu5Gho&sensor=false";
    document.body.appendChild(js);

    function enable_maps(){
        google.maps.event.addDomListener(window, 'load', init());
    }
    
    function init() {
        var location = $('#map_location').text()
        var location_arr = location.split(", ");
        var name = $('.restoran-item_title').text();
        
        var myCenter=new google.maps.LatLng(location_arr[0], location_arr[1]);
        var myCenter2=new google.maps.LatLng(location_arr[0], location_arr[1]);
        //var myCenter=new google.maps.LatLng(37.100865, -8.357047);
        //var myCenter2=new google.maps.LatLng(37.100865, -8.35708);
        var mapOptions = {
            zoom: 16,
            scrollwheel: false,
            center: myCenter2, // Convivio
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker=new google.maps.Marker({
            position:myCenter,
        	//url: '/',
        	animation:google.maps.Animation.DROP,
        	map: map
        });

        var infowindow = new google.maps.InfoWindow();

        infowindow.setContent('<strong>' + name + '</strong><p>GPS: N:' + location_arr[0] + ' W:' + location_arr[0] + '<p>');

        infowindow.open(map, marker);
    }

    /*
    $(".js-toggle-tooltip").on("click", function(h) {
        h.preventDefault();
        var i = $(this).parents(".tooltip");
        if (i.hasClass("tooltip--open")) {
            i.removeClass("tooltip--open")
        } else {
            $(".tooltip").removeClass("tooltip--open");
            i.addClass("tooltip--open")
        }
    });

    $(document).on("click", function(h) {
        if (!$(h.target).closest(".ingredients-box").length) {
            if (!$(h.target).closest(".tooltip--open").length) {
                h.stopPropagation();
                $(".tooltip--open").removeClass("tooltip--open")
            }
        }
    });
    */

    ////////////////////////////// Load menu products /////////////////////77
    $('.parent').click(function(){
        if($(this).hasClass("all")){
            setOffsetLimtit();
            $(window).bind('scroll', bindScroll);
        }
        else
            $('.loader').hide();
        $(".see_menu_box").click();
        $('.parent').removeClass('active');
        $(this).addClass('active');
        var cat_id = $(this)[0]["attributes"].cat_id.value;
        var sub_cat_id = $(this)[0]["attributes"].sub_cat_id.value;       
        $.ajax({
            type: "post",
            url: "restaurants/" + $(".restoran-item_title").attr("url_name") + "/category/" + cat_id + "/" + sub_cat_id,
            cache: false,
            data: '',
            success: function(response) {
                if(response != ""){
                    $('.products').empty();
                    $('.products').append(response);
                    itemButton();
                }else{
                    console.log("ERROR");
                }
            },
            error: function() {
                console.log('Error while request..');
            }
        });
    });

    /////////////////////////////// SCROLL LOADING DATA /////////////////
    var offset = 0;
    var limit = 0;
    function setOffsetLimtit(){
        offset = 6;
        limit = 6;
    }
    setOffsetLimtit();

    function bindScroll(){
      if($('.parent.active:not(.all)').length == 0 && $(window).scrollTop() + $(window).height() > $(document).height() - 500) {
        $(window).unbind('scroll');
        loadData();
      }
    }
    $(window).scroll(bindScroll);

    function loadData() {
      mobile = ($("#body").data('type') == "mobile");
      if(!mobile){
        $('.loader').show();
        $.ajax({
            type: "post",
            url: "restaurants/" + $(".restoran-item_title").attr("url_name") + "/get_more_product?offset=" + offset + "&limit=" + limit,
            cache: false,
            data: '',
            success: function(response) {
                if(response != ""){
                    $('.products').append(response);
                    offset += limit;
                    itemButton();
                    $(window).bind('scroll', bindScroll);
                }else{
                    $('.loader').hide();
                }
            },
            error: function() {
                console.log('Error while request..');
            }
        });
      }
    }


    itemButton();
    function itemButton() {
      if ($(".product-item").length) {
        $(".product-item button.btn--green").off("click").on("click", function(a) {
          a.stopPropagation();
          if($(this).data("extras") == "1"){
            console.log('Tem extras');
            product_id = $(this).closest(".product-item").data("id");
            modal.load('extras', 'product_id=' + product_id);
            //$.get("restaurants/" + $(".restoran-item_title").attr("url_name") + "/get_extras?product_id=" + extras.id, function(c) {
            //  extras.box = $(extras.item).closest(".items").find("#" + extras.id).parent();
            //  var b = $(extras.box).find(".product-item").index(extras.item);
            //  $(extras.box).append(c);
            //  $(extras.box).find(".ingredients-box").slideDown();
            //  $(extras.box).find(".box").addClass("index" + b);
            //  $(extras.box).find(".catalog input").change(extras.select)
            //});
          }else
            addToCart($(this).closest(".product-item"))
        })
      }
    }

    function addToCart(f) {
      mobile = ($("#body").data('type') == "mobile");

      var b = $(f).attr("data-id"),
          i = $(f).attr("data-type"),
          k = $(f).attr("data-constructor"),
          p = $(f).attr("data-price");

      if(!mobile)
        $(".cart-pane").removeClass("hide");

      addToCartGlobal(b, p);
      
      if(!mobile){
        $(".cart-pane").slideDown();
        var g = $(f).find("img:first").clone().addClass("move-img");
        $("body").append(g);
        var h = $(f).find("img").offset(),
            c = $(".cart-pane__logo").offset();
        g.css({
            position: "absolute",
            top: h.top,
            left: h.left,
            opacity: 0.8,
            "border-radius": "0",
            "z-index": 1000
        });
        g.animate({
            left: c.left,
            top: c.top,
            opacity: 0,
            width: 50,
            height: 50,
            borderRadius: "50%"
        }, 500, function() {
            $(".move-img").remove()
        });
        /*
        if (i == "bonus") {
            $("#bonus-items").slideUp();
            $(".cart-pane").attr("data-score", "1")
        }
        if (i == "item") {
            if (typeof __GetI === "undefined") {
                __GetI = []
            }
            var d = {
                type: "CART_ADD",
                site_id: "479",
                product_id: b,
                product_price: $(f).find(".product-item_bonus span").text()
            };
            __GetI.push(d);
            var e = (typeof __GetI_domain) == "undefined" ? "px.adhigh.net" : __GetI_domain;
            d.forward_tag = d.forward_tag || false;
            var a = ("https:" == document.location.protocol ? "https://" : "http://") + e + "/p.js";
            var j = document.createElement("script");
            j.type = "text/javascript";
            j.src = a;
            var l = document.getElementsByTagName("script")[0];
            l.parentNode.insertBefore(j, l)
        }
        */
      }
    }

    /////////////////////////////////////////////////////////////////////////
    //////////////////////////////FAVORITOS//////////////////////////////////
    $('.add_favorite').click(function(){
        rest_id = $('.restoran-item_title').attr("rest_id");
        if($(this).children("i").hasClass("sprite-fav-off") == true){
            $.get( "favorite/add_favorite?rest_id=" + rest_id, function(result) {
                applyFavoriteStatus(1);
                $(".add_favorite").children("i").removeClass("sprite-fav-off");
                $(".add_favorite").children("i").addClass("sprite-fav-on");
                $(".add_favorite").children("a").text("Adicionado aos favoritos");
            });
        }else{
            $.get( "favorite/remove_favorite_by_restid?rest_id=" + rest_id, function(result) {
                applyFavoriteStatus(-1);
                $(".add_favorite").children("i").removeClass("sprite-fav-on");
                $(".add_favorite").children("i").addClass("sprite-fav-off");
                $(".add_favorite").children("a").text("Adicionar aos favoritos");
            });
        }
    });

    function applyFavoriteStatus(type){
        if ($(".tooltip_title--star .notice").length) {
            var a = parseInt($(".tooltip_title--star .notice").text()) + type;
            if (a > 0) {
                $(".tooltip_title--star .notice, .cart-pane .tooltip .cart-pane__number").text(a)
            } else {
                $(".tooltip_title--star .notice").remove();
                $(".cart-pane .tooltip .cart-pane__number").text("0")
            }
        } else {
            if (type == 1) {
                $('<span class="notice">1</span>').appendTo(".tooltip_title--star");
                $(".cart-pane .tooltip .cart-pane__number").text("1")
            }
        }
    }
    /////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////


});

function addToCartGlobal(id, price, extra = [], qnt = 1){
    mobile = ($("#body").data('type') == "mobile");
    var data = {}
    var rest_id = $('.restoran-item_title').attr("rest_id");
    //var rest_id = 2;
    var city_id = $(".city_info").attr("id");
    //var city_id = "2";
    if($.cookie("cart")){
      data = JSON.parse($.cookie("cart"));
      if(!(city_id in data)){
        data = {}
        $.removeCookie("cart");
        data = addNewRest(city_id, data, rest_id, id, price, extra, qnt);
      }else{
        if(!(rest_id in data[city_id])){
          data = addNewRest(city_id, data, rest_id, id, price, extra, qnt);
        }else{
          rest_data = data[city_id][rest_id];
          price_total = parseFloat(rest_data["price"]) + parseFloat(price);
          products = check_exist_product(rest_data["products"], id, extra, qnt);
          qnt = parseInt(rest_data["qnt"]) + qnt;
          rest_data["products"] = products;
          rest_data["qnt"] = qnt;
          rest_data["price"] = price_total.toFixed(2);
          data[city_id][rest_id] = rest_data;
        }
      }
    }else{
      data = addNewRest(city_id, data, rest_id, id, price, extra, qnt);
    }
    $.cookie("cart", JSON.stringify(data), { expires: 7 });

    total_qnt = calculeQnt(data);
    total_price = calculeTotalPrice(data);
    if(!mobile){
      $(".cart-pane__item > .cart-pane__number").text(total_qnt);
      $(".cart-pane__sum").text(total_price + " €");
    }else{
      $('.cart').html('<span>' + total_price + ' €</span>');
      $("span.count").text(total_qnt);
      $("span.price").text(total_price + " €");
      $('#cart-bottom').removeClass("hide");
    }
}

function check_exist_product(products, id, extra, qnt){
    exist = false;
    $.each(products, function(index, product) {
        if(product["id"] == id && JSON.stringify(product["extra"]) === JSON.stringify(extra)){
            product["qnt"] = parseInt(product["qnt"]) + qnt;
            products[index] = product;
            exist = true;
        }
    });
    if(!exist){
        product = {};
        product['index'] = products.length;
        product['id'] = id;
        product['extra'] = extra;
        product['qnt'] = qnt;
        products.push(product);
    }

    return products;
}

/*
cart = 
    "Aveiro": {
        "fusoes": {
              "products":
               [
                  {
                  "index": 1,
                  "id": 1,
                  "extra": [3,6],
                  "qnt": 3
                  }
               ],
              "price": 100,
              "qnt": 3
            }
        }
*/

function addNewRest(city_id, data, rest_id, id, price, extra, qnt){
    rest_info = {};
    rest_info["qnt"] = qnt;
    rest_info["price"] = price;
    product = {};
    product['index'] = 0;
    product['id'] = id;
    product['extra'] = extra;
    product['qnt'] = qnt;
    products = [];
    products.push(product);
    rest_info["products"] = products;
    if(city_id in data){
        rest_list = data[city_id]
    }else{
        rest_list = {};
    }
    rest_list[rest_id] = rest_info;

    data[city_id] = rest_list;
    return data;
}

function calculeTotalPrice(data){
    price = 0;
    city_id = Object.keys(data)[0];
    for (var rest in data[city_id]) {
        price += parseFloat(data[city_id][rest]["price"]);
    }
    return price;
}

function calculeQnt(data){
    qnt = 0;
    city_id = Object.keys(data)[0];
    for (var rest in data[city_id]) {
        qnt += parseFloat(data[city_id][rest]["qnt"]);
    }
    return qnt;    
}

var constructors = {
    id: 0,
    load: function(a) {
        constructors.id = $(a).closest(".product-item").attr("data-id");
        $.get("/objects?action=get.constructor&id=" + constructors.id + "&r=" + Math.random(), function(b) {
            if (b == "") {
                return
            }
            if (b    != "false") {
                $(b).appendTo("#modal");
                $(".modal-overlay:first").addClass("modal-overlay--open");
                $(".modal-constructor").css("top", $(window).scrollTop() + "px").addClass("modal--open");
                $(".modal-constructor").find(".catalog input").change(constructors.select);
                constructors.select()
            }
        });
        return false
    },
    inc: function(c) {
        var a = $(".modal-constructor .item-count");
        var b = parseInt($(a).val());
        if (c == -1 && b == 1) {
            return false
        }
        $(a).val(b + c)
    },
    close: function() {
        $(".modal-constructor").remove();
        $(".modal-overlay").removeClass("modal-overlay--open");
        return false
    },
    select: function() {
        var a = parseInt($(".constructor-box").attr("data-price"));
        $(".constructor-box .catalog input:checked").each(function() {
            a += parseInt($(this).attr("data-price"))
        });
        $(".modal-constructor .footer .price").text(a)
    },
    order: function() {
        var a = {};
        a.id = constructors.id;
        a.count = $(".constructor-box .item-count").val();
        a.addons = [];
        $(".constructor-box .catalog input:checked").each(function() {
            a.addons.push($(this).val())
        });
        $.post("/ajax?action=addConstructorToCart", a, function(b) {
            if (b != "false") {
                a = b.split(":");
                if (a.length > 1) {
                    $(".cart-pane__item > .cart-pane__number").text(a[0]);
                    $(".cart-pane__sum").text(a[1] + " P")
                }
            }
        });
        $(".cart-pane").slideDown();
        constructors.close()
    },
};

var extras = {
    box: null,
    id: 0,
    item: null,
    load: function(a) {
      extras.item = $(a).closest(".product-item");
      extras.id = $(extras.item).attr("data-id");
      if (extras.box != null) {
        extras.close();
        if ($(extras.box).find(".ingredients-box").attr("data-id") == extras.id) {
            return false
        }
      }
      //$.get("/objects?action=get.extras&id=" + extras.id + "&r=" + Math.random(), function(c) {
      $.get("restaurants/" + $(".restoran-item_title").attr("url_name") + "/get_extras?product_id=" + extras.id, function(c) {
        if (c == "") {
            $(a).remove();
            return
        }
        if (c != "false") {
          extras.box = $(extras.item).closest(".items").find("#" + extras.id).parent();
          var b = $(extras.box).find(".product-item").index(extras.item);
          $(extras.box).append(c);
          $(extras.box).find(".ingredients-box").slideDown();
          $(extras.box).find(".box").addClass("index" + b);
          $(extras.box).find(".catalog input").change(extras.select)
        }
      });
      return false
    },
    inc: function(c) {
      mobile = ($("#body").data('type') == "mobile");
      if(!mobile){
        var a = $(extras.box).find(".item-count");
        var b = parseInt($(a).val());
        if (c == -1 && b == 1) {
            return false
        }
        $(a).val(b + c)
      }else{
        var input = $('.modal--constructor .item-count');
        var count = parseInt($(input).val());
        if (c == -1 && count == 1) {
          modal.remove();
        }
        $(input).val(count + c);
      }
    },
    close: function() {
        $(extras.box).find(".ingredients-box").slideUp("slow", function() {
            this.remove()
        });
        return false
    },
    select: function() {
      mobile = ($("#body").data('type') == "mobile");
      if(!mobile){
        var b = parseFloat($(this).attr("data-price")),
          a = parseFloat($(extras.box).find(".footer .price").text());
        if (b > 0) {
          if ($(this).is(":checked")) {
              a += b
          } else {
              a -= b
          }
          $(extras.box).find(".footer .price").text(a)
        }
      }else{
        var price = parseInt($('.modal--constructor .total-price').attr('data-price'));
        $('.modal--constructor .basket-item__extra input:checked').each(function() {
          price += parseFloat($(this).attr('data-price'));
        });
        console.log(price);
        $('.modal--constructor .total-price').text(price);
      }


    },
    order: function() {
        //var a = {};
        mobile = ($("#body").data('type') == "mobile");
        id = extras.id;
        addons = [];
        if(!mobile){
          count = parseInt($(extras.box).find(".item-count").val());
          $(extras.box).find(".ingredients-box .catalog input:checked").each(function() {
            addons.push($(this).val());
          });
          price = parseFloat($(extras.box).find(".price_total").text());
        }else{
          count = parseInt($('.modal--constructor .item-count').val());
          $('.modal--constructor .basket-item__extra input:checked').each(function() {
            addons.push($(this).val());
          });
          price = parseFloat($(".price_total").text());
          id = $('.modal').data('id').toString();
        }
        //for (i = 0; i < count; i++) {
        addToCartGlobal(id, price*count, addons, count);
        //}

        if(!mobile){
          $(".cart-pane").slideDown();
          extras.close()
        }else{
          modal.hide();
          modal.remove();
        }
    },
};