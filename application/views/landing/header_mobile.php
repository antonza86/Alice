<header class="main-header">
   <div class="row">
      <div class="col-md-12">
         <figure class="logo" style="">
            <a href="/"><img src="assets/images/logo.png" alt="Rabbeat - Serviço gratuito de encomenda da comida"></a>
            <p>Serviço gratuito de encomenda da comida</p>
         </figure>
      </div>
   </div>
   <div class="main-header_bottom">
      <div class="container">
         <div class="header_text">
            Para onde levar?
         </div>
         <form class="header_box" onsubmit="return inputedAddress();">
            <div class="header_city tooltip">
               <a href="#" class="tooltip_title js-toggle-tooltip" id="current-city">Aveiro</a>
            </div>
            <div class="header_street">
               <input name="street" tabindex="1" placeholder="Indique a rua..." data-value="" value="" type="text">
            </div>
            <div class="header_house">
               <input name="house" tabindex="2" placeholder="Porta" data-value="" value="" type="text">
            </div>
            <button type="submit" class="header_button btn">Procurar restaurantes</button>
         </form>
      </div>
   </div>
</header>