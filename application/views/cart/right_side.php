<div class="col s-4">
  <div class="cart-form">
     <div class="cart-form_title">Confirmação do pedido</div>
     <form onSubmit="return false;" id="cart_form">
        <input type="text" name="name" placeholder="Nome" value="<?php echo $userDetails['name']; ?>" required>
        <input type="tel" name="phone" placeholder="Telemóvel" value="<?php echo $userDetails['number']; ?>" required>
        <div class="cart-form_title"><?php echo get_city($city_id); ?></div>
        <input name="city" value="<?php echo get_city($city_id); ?>" class="hide">
        <select name="zone" class="city_zone_select">
          <?php foreach ($clean_city_zone as $key => $value){ ?>
             <?php if($key == $userDetails['id_zone']){ ?>
                <option value="<?php echo $key; ?>"  name="zone" selected><?php echo $value; ?></option>
             <?php }else{ ?>
                <option value="<?php echo $key; ?>" name="zone"><?php echo $value; ?></option>
             <?php } ?>
          <?php } ?>
        </select>
        <div class="address-form__input-wrapper">
           <input type="text" name="street" data-value="" value="<?php echo $userDetails['address']; ?>" placeholder="Endereço" required>
        </div>
        <textarea name="comment" value="" placeholder="Comentario"></textarea>
        <ul class="cart-switch">
           <li>
              <input id="cart-switch1" name="payment_type" value="0" type="radio" checked="checked">
              <label for="cart-switch1">Dinheiro</label>
           </li>
           <li>
              <input id="cart-switch2" name="payment_type" value="1" type="radio">
              <label for="cart-switch2">Multibanco</label>
           </li>
        </ul>
        <button type="submit" class="btn btn--green finish_cart">Encomendar</button>
     </form>
  </div>
</div>