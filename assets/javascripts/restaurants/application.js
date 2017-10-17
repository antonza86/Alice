$(document).ready(function() {
    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
    }

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

    ///////////////////////////// SCROLL ACTION ///////////////////////
    var offset = 0;
    var limit = 0;
    function setOffsetLimit(){
        offset = 2;
        limit = 2;
    }
    function resetOffsetLimit(){
        offset = 0;
        limit = 2;
    }
    setOffsetLimit();

    function bindScroll(){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 500) {
            $(window).unbind('scroll');
            loadData();
        }
    }
    $(window).scroll(bindScroll);

    function loadData() {
      $('.loader').show();
      var data = createData();
      //var type = $('#body').data('type');
      //data['type'] = type;
      
      $.ajax({
        type: "get",
        url: "restaurants/get_more_data",
        cache: false,
        data: data,
        success: function(response) {
          if(response != ""){
            $('#finalResult').append(response);
            offset += limit;
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

    $('.sort_restaurant').on('change', function() {
        resetOffsetLimit();
        $(window).unbind('scroll');
        var data = createData();
        $.ajax({
            type: "get",
            url: "restaurants/filter",
            cache: false,
            data: data,
            success: function(response) {
                if(response != ""){
                    $('#finalResult').empty();
                    setOffsetLimit();
                    $(window).scroll(bindScroll);
                    $('#finalResult').append(response);
                }else{
                    console.log("ERROR");
                }
            },
            error: function() {
                console.log('Error while request..');
            }
        });
    });

    $('.sort_restaurant_mobile').on('click', function() {
      resetOffsetLimit();
      $(window).unbind('scroll');
      var data = createData();
      //var type = $('#body').data('type');
      //data['type'] = type;
      /*
        if(type == "desktop"){
          $.ajax({
            type: "get",
            url: "restaurants/filter",
            cache: false,
            data: data,
            success: function(response) {
              if(response != ""){
                $('#finalResult').empty();
                setOffsetLimit();
                $(window).scroll(bindScroll);
                $('#finalResult').append(response);
              }else{
                console.log("ERROR");
              }
            },
            error: function() {
              console.log('Error while request..');
            }
          });
        }else{
      */
        $.ajax({
          type: "get",
          url: "restaurants/filter",
          cache: false,
          data: data,
          success: function(response) {
            if(response != ""){
              $('#finalResult').empty();
              setOffsetLimit();
              $(window).scroll(bindScroll);
              $('#finalResult').append(response);
            }else{
              console.log("ERROR");
            }
          },
          error: function() {
            console.log('Error while request..');
          }
        });
      //}
    });

    var block_filter = false;
    function createData(all = false){
      if($(".sort_restaurant option:selected").val())
        var orderby = $(".sort_restaurant option:selected").val();
      else if($('.sort_restaurant_mobile.active').size() == 0)
        var orderby = "normal";
      else
        var orderby = $('.sort_restaurant_mobile.active').data('order');
      
      console.log(orderby);
      var city_name = $(".city_info").attr("value");
      var search_text = $("#search_restaurant_input").val();
      var filter_cuisine = [];
      var checkbox_filter = [];
      if(!all && !block_filter){
        $(".cuisine:checked,.cuisine_alt:checked").each(function () {
          filter_cuisine.push($(this).attr("cuisine"));
        });
      }
      if(!block_filter){
        $(".checkbox_filter:checked").each(function () {
          checkbox_filter.push(this.name);
        });
      }

      var data = {};
      data["orderby"] = orderby;
      data["offset"] = offset;
      data["limit"] = limit;
      data['filter_cuisine'] = filter_cuisine;
      data['checkbox_filter'] = checkbox_filter;
      data['city_name'] = city_name;
      data['search'] = search_text;

      var type = $('#body').data('type');
      data['type'] = type;
      
      return data;
    }

    $(".cuisine, .cuisines, .cuisine_alt, .checkbox_filter").change(function() {
      var type = $('#body').data('type');
      if(!$(this).hasClass("cuisine_alt") && !$(this).hasClass("checkbox_filter") ){
        if(this.value == "all" && !this.checked ) {
          this.checked = true;
        }else if(this.value == "all" && this.checked ){
          $(".cuisine").prop( "checked", false );
        }else if(this.value != "all" && this.checked ){
          $(".cuisines").prop( "checked", false );
        }else if(this.value != "all" && !this.checked && $(".cuisine:checked").length == 0){
          $(".cuisines").prop( "checked", true );
        }
      }

      resetOffsetLimit();
      $(window).unbind('scroll');
      block_filter = false;
      var data = createData();
      //var type = $('#body').data('type');
      //data['type'] = type;

      $.ajax({
        type: "get",
        url: "restaurants/filter",
        cache: false,
        data: data,
        success: function(response,x,y) {
          if(y.status == 201)
            block_filter = true;
          else
            block_filter = false;
          $('#finalResult').empty();
          if(response != ""){
            setOffsetLimit();
            $(window).scroll(bindScroll);
            $('#finalResult').append(response);
          }else{
            console.log("Vazio");
          }
        },
        error: function() {
          console.log('Error while request..');
        }
      });
    });

    if(getURLParameter("filter")){
        $('.cuisine[value="' + getURLParameter("filter") + '"]').click();
    }

    $(".restaurant_list").click(function() {
        console.log("restaurant_list click");
        $(".restaurant_list_data").removeClass("hide");
        $(".product_list_data").addClass("hide");
        $(".left_side_restaurant").removeClass("hide");
        $(".left_side_product").addClass("hide");
        $(".restaurant_list").addClass("active");
        $(".product_list").removeClass("active");
    });

    $(".product_list").click(function() {
        console.log("product_list click");
        $(".product_list_data").removeClass("hide");
        $(".restaurant_list_data").addClass("hide");
        $(".left_side_product").removeClass("hide");
        $(".left_side_restaurant").addClass("hide");
        $(".product_list").addClass("active");
        $(".restaurant_list").removeClass("active");
    });

});
