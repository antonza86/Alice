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
<div class="side-menu">
	<div class="search-form">
		<form onclick="return false;">
			<input type="text" name="text" autocomplete="off" placeholder="<?php echo $this->lang->line("placeholder_search"); ?>" class="search-form__field" id="search_restaurant_input">
      <button type="submit" class="header_button btn hide" id="search_restaurant_btn"></button>
		</form>
	</div>
	<?php if($this->session->userdata('logged_in')){ ?>
		<div class="user-info">
				<img class="user-info__image" src="<?php echo base_url(); ?>assets/images/no-image.png" alt="avatar">
				<p class="user-info__name"><?php print_r($this->session->userdata('logged_in')['name']); ?></p>
				<p class="user-info__balls"><span>2900</span> <?php echo $this->lang->line("points"); ?></p>	
		</div>
	<?php }else{ ?>
		<div class="user-info">
				<a href="#" onclick="return modal.load('login');" class="btn btn--transparent"><?php echo $this->lang->line("btn_enter"); ?></a>
				<a href="#" onclick="return modal.load('registration');" class="btn btn--blue"><?php echo $this->lang->line("btn_register"); ?></a>
		</div>
	<?php } ?>

	<div class="select-city__label"><?php echo $this->lang->line("city"); ?></div>
	<select name="city" class="tooltip_title dropdown_city" data-source="<?php echo (isset($source) ? $source : 'other'); ?>">
    <?php foreach ($city as $key => $value){ ?>
       <?php if($key == $city_name){ ?>
          <option value="<?php echo $key; ?>" style="color: black;" selected><?php echo $value; ?></option>
       <?php }else{ ?>
          <option value="<?php echo $key; ?>" style="color: black;"><?php echo $value; ?></option>
       <?php } ?>
    <?php } ?>
 	</select>

	<nav class="side-nav">
		<ul class="side-nav__list">
			<li class="side-nav__item">
				<a href="" class="side-nav__link target_url" query_string=""><?php echo $this->lang->line("restaurant_list"); ?></a>
			</li>
			<li class="side-nav__item hide">
				<a href="#" class="side-nav__link"><?php echo $this->lang->line("promotions"); ?></a>
			</li>
			<li class="side-nav__item hide">
				<a href="#" class="side-nav__link"><?php echo $this->lang->line("mobile_application"); ?></a>
			</li>

			<?php if($this->session->userdata('logged_in')){ ?>
				<li class="side-nav__item">
					<a href="/user/profile" class="side-nav__link"><?php echo $this->lang->line("my_profile"); ?></a>
				</li>
				<li class="side-nav__item last">
					<a href="<?php echo base_url(); ?>usercontroller/logout" class="side-nav__link logout_user"><?php echo $this->lang->line("btn_logout"); ?></a>
				</li>
			<?php } ?>
		</ul>
	</nav>
</div>