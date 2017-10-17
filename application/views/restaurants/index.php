<?php if(!$mobile){ ?>
	<?php $this->load->view('landing/header'); ?>
<?php }else{ ?>
	<?php $this->load->view('landing/header_mobile'); ?>
<?php } ?>
<div class="container list-page" id="orgs" data-type="restaurants">
	<?php $this->load->view('restaurants/header'); ?>
	<div class="list-page_top row">
			<div class="row">
               <div class="col s-12 text-center">
                  <div class="restoran-item_tabs" style="margin-top: 0px;">
                     <a class="active restaurant_list">Restaurantes</a>
                     <a class="product_list">Produtos</a>
                  </div>
               </div>
            </div>
		<?php $this->load->view('restaurants/left_side_restaurant'); ?>	
		<?php $this->load->view('restaurants/left_side_product'); ?>	
		<?php $this->load->view('restaurants/right_side', $restaurant_list); ?>	
		<?php $this->load->view('restaurants/product_list'); ?>
	</div>
</div>
<?php $this->load->view('restaurant/cart'); ?>
<?php $this->load->view('landing/footer'); ?>