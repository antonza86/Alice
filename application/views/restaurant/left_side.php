<div class="col s-3">
 <aside class="list-org_sidebar">
    <div class="sort-block">
       <div class="sort-block_content">
          <form action="/restaurants" method="get" class="menu-live-box">
             <input type="text" name="s" class="search menu-live-search" value="" autocomplete="off" placeholder="Pesquisar pratos" />
             <button type="submit"></button>
          </form>
       </div>
    </div>
    <div class="sort-block">
    	<a class="sort-block_header parent active all" cat_id="0" sub_cat_id="0">Tudo</a>		
	</div>
    <?php for($i = 0; $i < count($categories); $i++){ ?>
	    <?php if($categories[$i]["sub_cat"] == -1){?>
	    	<div class="sort-block">
		    	<a class="sort-block_header parent" cat_id="<?php echo $categories[$i]['cat']; ?>" sub_cat_id="<?php echo $categories[$i]['sub_cat']; ?>"><?php echo $categories[$i]['name']; ?></a>		
	    	</div>
		<?php }else{ ?>
			<div class="sort-block sort-block--interactive">
		    	<a class="sort-block_header parent" cat_id="<?php echo $categories[$i]['cat']; ?>" sub_cat_id="<?php echo $categories[$i]['sub_cat']; ?>"><?php echo $categories[$i]['name']; ?></a>		
			    <div class="sort-block_content">
			    	<?php if($categories[$i]["sub_cat"] == 0){ ?>
			    		<?php $i++; ?>
			    		<?php while(array_key_exists($i, $categories) && $categories[$i]["sub_cat"] > 0){ ?>
					      <a class="parent" cat_id="<?php echo $categories[$i]['cat']; ?>" sub_cat_id="<?php echo $categories[$i]['sub_cat']; ?>"><?php echo $categories[$i]['name']; ?></a>
			    			<?php $i++; ?>
			    		<?php } ?>
			    		<?php $i--; ?>
    				<?php } ?>
			    </div>
	    	</div>
    	<?php } ?>
    <?php } ?>
 </aside>
</div>