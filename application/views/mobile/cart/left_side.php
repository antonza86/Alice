<div class="col s-8">
  <?php $total_price = 0; ?>
  <?php foreach ($cart as $key_rest => $value_rest){ ?>
    <div class="restoran-cart" id="<?php echo $key_rest; ?>">
        <h2 class="restoran-cart_title">
          <a href="<?php echo $clean_restaurants[$key_rest]['url_name']; ?>"><?php echo $clean_restaurants[$key_rest]['name']; ?></a>
          <button class="restoran-cart_delete btn--delete js-cart-restoran-delete" rest_id="<?php echo $key_rest; ?>">Remover</button>
        </h2>
        <?php foreach ($value_rest["products"] as $key => $value){ ?>
          <div class="product-cart row" prod_index="<?php echo $value['index']; ?>" rest_id="<?php echo $key_rest; ?>">
            <div class="col s-6">
              <div class="product-cart_image">
                <img src="<?php echo base_url().'assets/images/restaurant/'.$clean_restaurants[$key_rest]['url_name'].'/'.$clean_products[$value['id']]['url']; ?>" height="50" width="50" alt="<?php echo $clean_products[$value['id']]['name']; ?>">
                <div class="product-cart_tooltip">
                  <img src="<?php echo base_url().'assets/images/restaurant/'.$clean_restaurants[$key_rest]['url_name'].'/'.$clean_products[$value['id']]['url']; ?>" height="200" width="200" alt="<?php echo $clean_products[$value['id']]['name']; ?>">
                  <p></p>
                </div>
              </div>
              <p class="product-cart_title"><?php echo $clean_products[$value['id']]['name']; ?></p>
              <?php $total_extras = 0; ?>
              <?php if($value["extra"]){ ?>
                <div class="ingredients-cart">
                  <div class="title">Extras:</div>
                  <?php foreach ($value["extra"] as $value_extra){ ?>
                    <div class="item">
                      <span>+<?php echo $clean_product_extras[$value_extra]['price']; ?> €</span>
                      <?php $total_extras += $clean_product_extras[$value_extra]['price']; ?>
                      <?php echo $clean_product_extras[$value_extra]['name']; ?>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
            <div class="col s-3 product-cart_top js-cart-calc">
              <button class="product-cart_calc btn--minus" prod_index="<?php echo $value['index']; ?>" rest_id="<?php echo $key_rest; ?>">-</button>
              <input type="text" class="product-cart_calc-result" prod_index="<?php echo $value['index']; ?>" rest_id="<?php echo $key_rest; ?>" disabled value="<?php echo $value['qnt']; ?>">
              <button class="product-cart_calc btn--plus" prod_index="<?php echo $value['index']; ?>" rest_id="<?php echo $key_rest; ?>">+</button>
            </div>
            <div class="col s-2 product-cart_top text-right">
              <p class="product-cart_price" prod_index="<?php echo $value['index']; ?>" price="<?php echo $clean_products[$value['id']]['price'] + $total_extras; ?>"><?php echo $clean_products[$value['id']]['price'] + $total_extras; ?> €</p>
              <?php $total_price += ($clean_products[$value['id']]['price'] + $total_extras) * $value['qnt']; ?>
            </div>
            <div class="col s-1">
              <button class="product-cart_delete btn--delete js-cart-tovar-delete" prod_index="<?php echo $value['index']; ?>" rest_id="<?php echo $key_rest; ?>">Remover</button>
            </div>
          </div>
        <?php }?>
        <div class="product-cart product-cart--delivery row">
          <div class="col s-6">
            <p class="product-cart_title">Entrega</p>
          </div>
          <div class="col s-2"></div>
          <?php foreach ($clean_zonas[$key_rest] as $key_zona => $value_zona){ ?>
            <div class="col s-3 product-cart_top text-right delivery_count hide" price="<?php echo $value_zona['price']; ?>" bonus="<?php echo $value_zona['bonus']; ?>" discount="<?php echo $value_zona['discount']; ?>" zona="<?php echo $key_zona; ?>">
              <b class="product-cart_price"><?php echo (float)$value_zona["price"]; ?></b> €
            </div>
          <?php } ?>
          <div class="col s-1"></div>
        </div>
        <?php //$total_price += $delivery_price_first; ?>
        <div class="row cart-summary">
          <div class="col s-6">
            <a href="<?php echo $clean_restaurants[$key_rest]['url_name']; ?>" class="btn btn--grey">Voltar ao menu</a>
          </div>
          <div class="col s-3 text-right">
            Total:
          </div>
          <div class="col s-3 cart-summary_price">
            <b class="cart-summary_price_value" value="<?php echo number_format((float)$total_price, 2); ?>"><?php echo number_format((float)$total_price, 2); ?></b> €
          </div>
        </div>
    </div>
  <?php }?>
</div>