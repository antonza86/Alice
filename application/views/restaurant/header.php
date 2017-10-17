<div class="org-page" style="background-image: url(assets/images/bg-org-pizza.jpg);">
   <div class="container list-page">
      <?php echo $this->breadcrumbs->show(); ?>
      <div class="restoran-item restoran-item--big row" id="restoran-page" data-work="1" data-id="625">
         <div class="col s-3">
            <figure class="restoran-item_image">
               <a href="">
               <img src="<?php echo base_url().'assets/images/restaurant/'.$restaurant_info['url_name'].'/'.$restaurant_info['logo'] ?>" height="160" width="160" alt="<?php echo $restaurant_info['name'] ?>">
               </a>
            </figure>
         </div>
         <div class="col s-9">
            <div class="restoran-item_top row">
               <div class="col s-9">
                  <h1 class="restoran-item_title" url_name="<?php echo $restaurant_info['url_name'] ?>" rest_id="<?php echo $restaurant_info['id'] ?>"><?php echo $restaurant_info['name'] ?></h1>
                  <p class="restoran-item_description"><span>Cozinha:</span> <?php echo $restaurant_info['cuisine'] ?></p>
               </div>
               <div class="col s-3 text-right hide">
                  <div class="rate rate--5">
					<?php for ($i = 0; $i < $restaurant_info['rate']; $i++) { ?>
						<i></i>
					<?php } ?>
                  </div>
                  <p class="restoran-item_star-col"><?php echo $restaurant_info['num_rate'] ?> classificações</p>
               </div>
            </div>
            <div class="restoran-item_bottom row">
               <div class="col s-3">
                  <p class="restoran-item_sub-titile">Valor min:</p>
                  <p class="restoran-item_big need_minimum_summa"><i class="sprite sprite-ico-stack"></i>
                     <?php echo $restaurant_info['min_price'] ?> €
                  </p>
               </div>
               <div class="col s-3">
                  <p class="restoran-item_sub-titile">Valor entrega:</p>
                  <p class="restoran-item_big"><i class="sprite sprite-ico-rocket-w"></i>
                     <?php if($restaurant_info['delivery_price'] == '0')
							echo "Grátis";
						  else
						  	echo $restaurant_info['delivery_price']." €";	
					 ?>
                  </p>
               </div>
               <div class="col s-3">
                  <p class="restoran-item_sub-titile">Tempo entrega:</p>
                  <p class="restoran-item_big"><i class="sprite sprite-ico-timer-2"></i> <?php echo $restaurant_info['delivery_time'] ?> min.</p>
               </div>
               <div class="col s-3">
                  <p class="restoran-item_sub-titile">Pagamento c/cartão:</p>
                  <p class="restoran-item_big"><i class="sprite sprite-ico-viza"></i>
                     <?php if($restaurant_info['card_payment'] == 1)
                        echo "Sim";
                     else
                        echo "Não";	
                     ?> 
                  </p>
               </div>
            </div>
            <div class="row">
               <div class="col s-9 left">
                  <div class="restoran-item_tabs">
                     <a class="active see_menu_box">Menu</a>
                     <a style="display: none;">Feedback</a>
                     <a id="see_more_info_box">Sobre nós</a>
                  </div>
               </div>
               <?php if($this->session->userdata('logged_in')){ ?>
                  <?php
                  $in_favorite = false; 
                  foreach ($favorite as $key => $value){ 
                     if($value["rest_id"] == $restaurant_info['id']){
                        $in_favorite = true; 
                     }
                  } ?>
                  <div class="col s-3 text-right">
                     <div class="favorite add_favorite">
                        <?php if($in_favorite){ ?>
                           <a href="#">Adicionado aos favoritos</a>
                           <i class="sprite sprite-fav-on"></i>
                        <?php }else{ ?>
                           <a href="#">Adicionar aos favoritos</a>
                           <i class="sprite sprite-fav-off"></i>
                        <?php } ?>
                     </div>
                  </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>