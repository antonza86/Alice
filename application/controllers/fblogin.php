<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fblogin extends CI_Controller {


	function __construct()
	{
		parent::__construct();
    $this->status = $this->config->item('status');
    require_once APPPATH.'vendor/autoload.php';
    
	}

	function login()
	{
    // Facebook API Configuration
    $appId = '227653974321811';
    $appSecret = '4256a5b3f8ea9b05da966d59cda7018a';

    //Call Facebook API
    $fb = new Facebook\Facebook(array(
      'app_id'  => $appId,
      'app_secret' => $appSecret,
      'default_graph_version' => 'v2.2'
    ));
    
    $go_to = $this->input->get('go_to');

    $redirectUrl = 'http://localhost/Alice/fblogin/finish_login?go_to='.$go_to;

    $helper = $fb->getRedirectLoginHelper();

		$permissions = ['email'];

		$loginUrl = $helper->getLoginUrl($redirectUrl, $permissions);

		redirect($loginUrl);
	}

  public function finish_login(){
      // Facebook API Configuration
      $appId = '227653974321811';
      $appSecret = '4256a5b3f8ea9b05da966d59cda7018a';

      //Call Facebook API
      $fb = new Facebook\Facebook(array(
        'app_id'  => $appId,
        'app_secret' => $appSecret,
        'default_graph_version' => 'v2.2'
      ));

      $helper = $fb->getRedirectLoginHelper();

      try {
        $accessToken = $helper->getAccessToken();
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      if (! isset($accessToken)) {
        if ($helper->getError()) {
          header('HTTP/1.0 401 Unauthorized');
          echo "Error: " . $helper->getError() . "\n";
          echo "Error Code: " . $helper->getErrorCode() . "\n";
          echo "Error Reason: " . $helper->getErrorReason() . "\n";
          echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
          header('HTTP/1.0 400 Bad Request');
          echo 'Bad request';
        }
        exit;
      }

      // Logged in
      echo '<h3>Access Token</h3>';
      var_dump($accessToken->getValue());

      // The OAuth 2.0 client handler helps us manage access tokens
      $oAuth2Client = $fb->getOAuth2Client();

      // Get the access token metadata from /debug_token
      $tokenMetadata = $oAuth2Client->debugToken($accessToken);
      echo '<h3>Metadata</h3>';
      var_dump($tokenMetadata);

      // Validation (these will throw FacebookSDKException's when they fail)
      $tokenMetadata->validateAppId($appId); // Replace {app-id} with your app id
      // If you know the user ID this access token belongs to, you can validate it here
      //$tokenMetadata->validateUserId('123');
      $tokenMetadata->validateExpiration();

      if (! $accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
        try {
          $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
          echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
          exit;
        }

        echo '<h3>Long-lived</h3>';
        var_dump($accessToken->getValue());
      }

      $this->session->set_userdata('fb_access_token', (string) $accessToken);

      try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me?fields=id,name,email', (string) $accessToken);
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $user = $response->getGraphUser();

      $user_id = 0;

      $this->load->model('User', 'user', TRUE);
      if ($this->user->isDuplicate($user['email'])) {
          $user_info = $this->user->getUserInfoByEmail($user['email']);
          $user_id = $user_info->id; 
          $this->db->where('email', $user['email']);
          if($user_info->status == $this->status[1]){
            $this->db->update('user', array('last_login' => date('Y/m/d - H:i')));
          }else{
            $this->db->update('user', array('last_login' => date('Y/m/d - H:i'), 'status' => $this->status[2]));
          }
      }else{
          $user_data = array(
              'email' => $user['email'],
              'name' => $user['name'],
              'last_login' => date('Y/m/d - H:i'),
              'facebook' => $user['id']
          );
          $user_id = $this->user->insertFBUser($user_data);
      }

      $sess_array = array(
          'id' => $user_id,
          'email' => $user['email'],
          'name' => $user['name']
      );
      $this->session->set_userdata('logged_in', $sess_array);
      

      $go_to = $this->input->get('go_to');
      redirect($go_to);

      // User is logged in with a long-lived access token.
      // You can redirect them to a members-only page.
      //header('Location: https://example.com/members.php');
  }

}

?>