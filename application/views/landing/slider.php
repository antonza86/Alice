<div class="container">
  <!-- Jssor Slider Begin -->
  <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
  <!-- ================================================== -->
  <div id="slider1_container">

      <!-- Loading Screen -->
      <div u="loading" class="loading_slider">
          <div class="loading_div1"></div>
          <div class="loading_div2"></div>
      </div>

      <!-- Slides Container -->
      <div u="slides" class="slider_info">
        <?php foreach ($slider as $value){ ?>
          <div>
              <img u="image" src2="<?php echo $value['img_link'] ?>" />
          </div>
        <?php } ?>
      </div>
      
      <!--#region Bullet Navigator Skin Begin -->
      <!-- Help: http://www.jssor.com/tutorial/set-bullet-navigator.html -->
      <!-- bullet navigator container -->
      <div u="navigator" class="jssorb05">
          <!-- bullet navigator item prototype -->
          <div u="prototype"></div>
      </div>
      <!--#endregion Bullet Navigator Skin End -->
      
  </div>
  <!-- Jssor Slider End -->
</div>