<?php
class my_loader extends CI_Loader {
  public function template($template_name, $vars = array(), $return = FALSE)
  {
    if($return):
      $content  = $this->view('layouts/header', $vars, $return);
      $content .= $this->view($template_name, $vars, $return);
      $content .= $this->view('layouts/footer', $vars, $return);

      return $content;
    else:
      $this->view('layouts/header', $vars);
      $this->view($template_name, $vars);
      $this->view('layouts/footer', $vars);
    endif;
  }

  public function template_mobile($template_name, $vars = array(), $return = FALSE)
  {
    if($return):
      $content  = $this->view('layouts/header-mobile', $vars, $return);
      $content .= $this->view($template_name, $vars, $return);
      $content .= $this->view('layouts/footer-mobile', $vars, $return);

      return $content;
    else:
      $this->view('layouts/header-mobile', $vars);
      $this->view($template_name, $vars);
      $this->view('layouts/footer-mobile', $vars);
    endif;
  }
}