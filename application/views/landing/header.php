<?php
$city = array(
            "aveiro" => "Aveiro", //1
            "lisboa" => "Lisboa", //2
            "porto" => "Porto", //3
            "maia" => "Maia", //4
            "cascais" => "Cascais", //5
            "seixal" => "Seixal", //6
            "almada" => "Almada", //7
            "figueira_da_foz" => "Figueira da Foz", //8
            "oeiras" => "Oeiras", //9
            "linda_a_velha" => "Linda-a-Velha", //10
            "sintra" => "Sintra", //11
            "odivelas" => "Odivelas" //12
            );
?>
<header class="main-header">
   <div class="main-header_top container row">
      <div class="col s-4">
         <figure class="logo" style="">
            <a href="<?php echo base_url(); ?>?city_name=<?php echo $city_name; ?>" class="city_info" id="<?php echo $city_id; ?>" value="<?php echo $city_name; ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Rabbeat - Serviço gratuito de encomenda da comida"></a>
            <p><?php echo $this->lang->line('slogan'); ?></p>
         </figure>
      </div>
      <div class="col s-4 hide">
         <form class="main-header_form live-search-box" action="/search">
            <input type="text" name="text" class="search live-search" autocomplete="off" placeholder="Pesquisar">
         </form>
      </div>
      <?php if(!$this->session->userdata('logged_in')){ ?>
         <div class="col s-8 text-right">
            <a href="<?php echo base_url(); ?>login" class="btn btn--enter js-get-modal" data-modal="modal-login"><?php echo $this->lang->line('btn_enter'); ?></a>
            <a href="" class="btn btn--reg js-get-modal" data-modal="modal-registration"><?php echo $this->lang->line('btn_register'); ?></a>
         </div>
      <?php }else{ ?>
         <?php $this->load->view('landing/login_user_data'); ?>
         <div class="col s-4 text-right hide">
            <a href="<?php echo base_url(); ?>login/logout" class="btn btn--logout"><?php echo $this->lang->line('btn_logout'); ?></a>
         </div>
      <?php } ?>
   </div>

   <div class="main-header_bottom">
      <div class="container">
         <div class="header_text">
            <?php echo $this->lang->line('where_take'); ?>
         </div>
         <form class="header_box" id="search_restaurant_form" onclick="return false;">
            <div class="header_city tooltip">
              <select name="city" class="tooltip_title dropdown_city" data-source="<?php echo (isset($source) ? $source : 'other'); ?>">
                <?php foreach ($city as $key => $value){ ?>
                  <?php if($key == $city_name){ ?>
                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                  <?php }else{ ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
            <div class="header_street hide">
               <input name="street" tabindex="1" placeholder="Indique a rua..." data-value="" value="" type="text">
            </div>
            <div class="header_search">
               <input name="search" tabindex="1" placeholder="<?php echo $this->lang->line('placeholder_search'); ?>" data-value="" value="" type="text" id="search_restaurant_input">
            </div>
            <button type="submit" class="header_button btn" id="search_restaurant_btn"><?php echo $this->lang->line('search_restaurants'); ?></button>
         </form>
      </div>
   </div>
</header>