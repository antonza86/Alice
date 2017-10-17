<div class="catalog container">
   <div class="new-header"><i class="sprite sprite-catalog"></i> <?php echo $this->lang->line('choose_category'); ?></div>
   <div class="row">
      <?php foreach ($menu_list as $key => $value){ ?>
         <?php if($key < 6){ ?>
            <div class="col s-4">
         <?php }else{ ?>
            <div class="col s-4 extra_category" style="display: none;">
         <?php } ?>
               <div class="catalog-item">
                  <a query_string="<?php echo $value['target'] ?>" class="target_url" href="">
                     <img src="<?php echo $value['img_link'] ?>" alt="<?php echo $value['name'] ?>">
                     <div class="shadow"></div>
                     <div class="title">
                        <?php echo $value['name'] ?>
                        <div class="<?php echo $value['icon'] ?>"></div>
                     </div>
                  </a>
               </div>
            </div>
         <?php } ?>
   </div>
</div>
<?php if(count($menu_list) > 6){ ?>
   <div class="index-control">
         <a id="see_more_menu"><?php echo $this->lang->line('see_more'); ?></a>
         <a style="display: none;" id="see_less_menu"><?php echo $this->lang->line('see_less'); ?></a>
   </div>
<?php } ?>
