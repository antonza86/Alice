$(document).ready(function() {
  $("#see_more_menu").click(function() {
    $('#see_more_menu').hide();
    $('#see_less_menu').show();
    $('.extra_category').show();
  });

  $("#see_less_menu").click(function() {
    $('#see_less_menu').hide();
    $('#see_more_menu').show();
    $('.extra_category').hide();
  });

  $( ".dropdown_city" ).change(function(val) {
    source = $(this).data('source');
    if (source == "other") {
      window.location.href = $('.dropdown_city').val();
    }else{
      $('.target_url').each(function() {
        $(this).attr("href", $('.dropdown_city').val() + $(this).attr("query_string"));
      });
    }
  });
  $('.target_url').each(function() {
    $(this).attr("href", $('.dropdown_city').val() + $(this).attr("query_string"));
  });

  $("#modal").load("assets/javascripts/landing/modal.php", function() {
      $('.btn--social-fb').each(function() {
        $(this).attr("href", $(this).attr("href") + window.location.href);
      });
      $(".js-get-modal").on("click", function(m) {
        m.preventDefault();
        $(".modal-overlay:first").addClass("modal-overlay--open");
        $(".modal").removeClass("modal--open");
        $("." + $(this).attr("data-modal")).addClass("modal--open")
      });
      $(".js-close-modal").on("click", function(m) {
        m.preventDefault();
        $(this).parents(".modal").removeClass("modal--open");
        $(".modal-overlay").removeClass("modal-overlay--open")
      });
      $(window).on("keydown", function() {
        if (event.keyCode == 27) {
          $(".modal").removeClass("modal--open");
          $(".modal-overlay").removeClass("modal-overlay--open");
          $(".modal-constructor").remove()
        }
      });
      if(getURLParameter("s") == "s"){
        window.history.pushState({}, document.title, window.location.pathname);
        $('.logout_user').attr("href", $('.logout_user').attr("href") + "?url=" + window.location.href);
        $(".modal-confirm-email-response a").click();
      }else if(getURLParameter("t"))
        $(".modal-forgot a").click();
      else
        $('.logout_user').attr("href", $('.logout_user').attr("href") + "?url=" + window.location.href);
      
  });

  $(document).on('click', '#new_account', function() {
    $.post("usercontroller/register", $("#form_new_account").serialize(), function(result) {
      $('.error_alert').addClass("hide");
      console.log(result);
      if(result == "error"){
        $('.error_message').removeClass("hide");
      }else if(result == "exists"){
        $('.exists_error_message').removeClass("hide");
      }else if(result.split(":")[0] == "need_confirm"){
        $(".modal-confirm-email a").click();
      }else{
        location.reload();
      }
    });
  });

  $(document).on('click', '#login_user', function() {
    $.post("usercontroller/validate", $("#form_login").serialize(), function(result) {
      $('.error_alert').addClass("hide");
      if(result == "success")
        location.reload();
      else if(result == "need_confirm")
        $('.need_confirm_message').removeClass("hide");
      else if(result == "no_exists")
        $('.no_exists_message').removeClass("hide");
      else 
        $('.login_error_message').removeClass("hide");
    });
  });

  $(document).on('click', '#forgot_btn', function() {
    $.post("usercontroller/forgot", $("#form_forgot").serialize(), function(result) {
      if(result == "error")
        console.log("error");
      else{
        $(".modal-confirm a").click();
        console.log(result);
      }
    });
  });

  $(document).on('click', '#reset_password', function() {
    $.post("usercontroller/reset_password/" + getURLParameter("t"), $("#form_reset_password").serialize(), function(result) {
      if(result == "error")
        $('.some_password_error_message').removeClass("hide");
      else{
        $(".modal-password-recuperada a").click();
        window.history.pushState({}, document.title, window.location.pathname);
        $('.logout_user').attr("href", $('.logout_user').attr("href") + "?url=" + window.location.href);
      }
    });
  });

  $(document).on('click', '#recuperada-success', function() {
    location.reload();
  });


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
      if (!$(h.target).closest(".live-search-box").length) {
        h.stopPropagation();
        $(".setip").remove()
      }
      if (!$(h.target).closest(".header_street").length) {
        h.stopPropagation();
        $(".setip_street").remove()
      }
      if (!$(h.target).closest(".menu-search-box").length) {
        h.stopPropagation();
        $(".setip-menu").remove()
      }
      if (!$(h.target).closest(".address-live-box").length) {
        h.stopPropagation();
        $(".address-live-box").hide()
      }
    }
  });

  function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
  }

  if($.cookie("cart")){
    mobile = ($("#body").data('type') == "mobile");
    data = JSON.parse($.cookie("cart"));
    total_qnt = calculeQnt(data);
    total_price = calculeTotalPrice(data);
    if(!mobile){
      $(".cart-pane").removeClass("hide");
      $(".cart-pane__item > .cart-pane__number").text(total_qnt);
      $(".cart-pane__sum").text(total_price + " €");
    }else{
      $('.cart').html('<span>' + total_price + ' €</span>');
      $("span.count").text(total_qnt);
      $("span.price").text(total_price + " €");
      $('#cart-bottom').removeClass("hide");
    }
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

  if ($(".main-header_user .tooltip").length) {
      /*
      */
      if ($(".tooltip_title--star .notice").length && $(".cart-pane").length) {
        var c = parseInt($(".tooltip_title--star .notice").text());
        if (c > 0) {
          $(".cart-pane .tooltip .cart-pane__number").text(c);
          $(".cart-pane .tooltip_content .scroll").html($(".tooltip_title--star").next(".tooltip_content").html());
          $(".cart-pane .notice-item--empty, .cart-pane .tooltip_content button").remove();
          $(".cart-pane .tooltip").show()
        }
      }
      $(".main-header_user .notice-item--empty, .cart-pane .btn--notice").hide();
      $(".main-header_user .list, .cart-pane .tooltip_content").each(function() {
        var h = $(this).find(".notice-item").length;
        $(this).find(".notice-item:gt(2)").hide();
        if (h > 3) {
          $(this).find(".btn--notice").show()
        }
        if (h == 0) {
          $(this).find(".notice-item--empty").show()
        }
      });
      $(".btn--notice").on("click", function() {
        $(this).hide();
        $(this).closest("div").find(".notice-item:gt(2)").slideDown();
        return false
      });

      $(".js-delete-notice").on("click", function(j) {
        j.preventDefault();
        var h = $(this).attr("data-type"),
          k = $(this).attr("data-id");
        if (h == "org") {
          //setFavorite(k, 0)
          //REMOVER Aqui
          $.get( "favorite/remove_favorite?fav_id=" + k, function(result) {
            if ($(".tooltip_title--star .notice").length) {
              var a = parseInt($(".tooltip_title--star .notice").text()) - 1;
              if (a > 0) {
                $(".tooltip_title--star .notice, .cart-pane .tooltip .cart-pane__number").text(a)
              } else {
                $(".tooltip_title--star .notice").remove();
                $(".cart-pane .tooltip .cart-pane__number").text("0")
              }
            } else {
              if (b == 1) {
                $('<span class="notice">1</span>').appendTo(".tooltip_title--star");
                $(".cart-pane .tooltip .cart-pane__number").text("1")
              }
            }
          });
        } else {
          if (h == "msg") {
            var i = parseInt($(".tooltip_title--message .notice").text());
            if (i > 1) {
              $(".tooltip_title--message .notice").text(i - 1)
            } else {
              $(".tooltip_title--message .notice").remove()
            }
            $.get("/ajax?action=noticeRemove&id=" + k + "&r=" + Math.random())
          }
        }
        $(this).closest(".notice-item").nextAll(".notice-item:hidden").first().slideDown(200);
        $(this).closest(".notice-item").slideUp(200, function() {
          if ($(this).closest(".list").find(".notice-item:visible").length == 0) {
            $(this).closest(".list").find(".notice-item--empty").slideDown()
          }
          if ($(this).closest(".notice-item").nextAll(".notice-item:hidden").length == 0) {
            $(this).closest(".list").find(".btn--notice").slideUp()
          }
          $(this).remove()
        });
        return false
    })
  }

  if(getURLParameter("search")){
    $("#search_restaurant_input").val(getURLParameter("search"));
  }

  $("#search_restaurant_btn").click(function() {
    console.log('Aqui');
    search_text = $("#search_restaurant_input").val();
    city = $('.dropdown_city').val();
    console.log(city);
    //window.location.replace(city + "?search=" + search_text);
    window.location.href = city + "?search=" + search_text;
  });


});
