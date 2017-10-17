<footer class="main-footer">
   <div class="container">
      <div class="row main-footer_top">
         <div class="col s-8">
            <figure class="main-footer_logo">
               <a href="/"><img src="<?php echo base_url(); ?>assets/images/logo.png" height="47" width="50" alt="Rabbeat - Restaurantes existe muitos, site é único."></a>
            </figure>
            <p><?php echo $this->lang->line('rabbeat'); ?> <strong><?php echo $this->lang->line('slogan_v2'); ?></strong></p>
            <p><span><?php echo $this->lang->line('all_rights_reserved'); ?></span></p>
         </div>
         <!--noindex-->
         <div class="col s-4 text-right socio-footer">
            <a href="https://instagram.com/rabbeat" rel="nofollow" target="_blank" class="socio-btn socio-btn--instagram">Instagram</a>
            <a href="https://twitter.com/rabbeat" rel="nofollow" target="_blank" class="socio-btn socio-btn--twitter">twitter</a>
            <a href="https://facebook.com/rabbeat" rel="nofollow" target="_blank" class="socio-btn socio-btn--facebook">facebook</a>
         </div>
         <!--/noindex-->
      </div>
      <div class="row main-footer_top">
         <div class="col s-6">
            <ul class="main-footer_nav">
               <!--noindex-->
               <li><a rel="nofollow" href="/about"><?php echo $this->lang->line('about_us'); ?></a></li>
               <li><a rel="nofollow" href="/contacts"><?php echo $this->lang->line('contacts'); ?></a></li>
               <li><a rel="nofollow" href="/partners"><?php echo $this->lang->line('info_for_clients'); ?></a></li>
               <li><a rel="nofollow" href="/agreement"><?php echo $this->lang->line('contract'); ?></a></li>
               <!--/noindex-->
               <li><a href="/freefood"><?php echo $this->lang->line('points'); ?></a></li>
            </ul>
         </div>
         <div class="col s-6 text-right">
            <a href="#" class="btn btn--grey btn--footer" data-modal="modal-support"><i class="ico-convert"></i><?php echo $this->lang->line('contact_us'); ?></a>
         </div>
      </div>
   </div>
</footer>
<div id="modal"></div>