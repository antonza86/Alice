<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usercontroller extends CI_Controller
{
    
    public $status;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('User', 'user', TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status');
    }

    function validate()
    {
        //This method will have the credentials validation
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        
        $result = $this->user->getUserInfoByEmail($this->input->post('email'));
        if ($result) {
            if($result->status == "need_confirm"){
                echo "need_confirm";
            }else if($result->password == ""){
                echo "no_exists";
            }else{
                if ($this->form_validation->run() == TRUE) {
                    //Field validation failed.  User redirected to login page
                    echo "success";
                } else{
                    echo "error";
                }
            }
        }
        else
            echo "no_exists";

    }
    
    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $email  = $this->input->post('email');
        //query the database
        $result = $this->user->login($email, $password);
        
        if ($result) {
            $sess_array = array(
                'id' => $result->id,
                'email' => $result->email,
                'name' => $result->name,
                'status' => $result->status
            );

            $this->session->set_userdata('logged_in', $sess_array);
            $this->user->updateLoginTime($email);
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid email or password');
            return FALSE;
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('fb_access_token');
        session_destroy();
        $url = $this->input->get('url');
        redirect($url, 'refresh');
    }
    
    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('tel', 'Tel');
        
        if ($this->form_validation->run() == FALSE) {
            echo "error";
        } else {
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            if ($this->user->isDuplicate($email)) {
                if($this->user->isLocalUser($email)) {
                    echo "exists";
                }else{
                    $this->load->library('password');
                    $hashed                = $this->password->create_hash( $this->input->post('password'));
                    $cleanPost['password'] = $hashed;
                    $cleanPost['email'] = $email;
                    $user_info = $this->user->updateUserInfoByEmail($cleanPost);
                    $message = $this->create_token($user_info->id);

                    echo "need_confirm:".$message;
                }
            } else {
                $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));

                $id    = $this->user->insertUser($clean);
                $message = $this->create_token($id);

                $this->user->updateLoginTime($email);
                $sess_array = array(
                    'id' => $id,
                    'email' => $email,
                    'name' => $name
                );
                $this->session->set_userdata('logged_in', $sess_array);
                echo $message;
                //exit;
            }
        }
    }

    public function create_token($id){
        $token = $this->user->insertToken($id);
        
        $qstring = $this->base64url_encode($token);
        $url     = site_url() . 'Usercontroller/complete/' . $qstring;
        $link    = '<a href="' . $url . '">' . $url . '</a>';
        
        $message = '';
        $message .= '<strong>You have signed up with our website</strong><br>';
        $message .= '<strong>Please click:</strong> ' . $link;
        
        return $message; //send this in email
    }
    
    public function complete()
    {
        $token      = base64_decode($this->uri->segment(3));
        $cleanToken = $this->security->xss_clean($token);
        
        $user_info = $this->user->isTokenValid($cleanToken); //either false or array();           
        
        if (!$user_info) {
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            echo "error";
        }else{
            $this->user->updateStatus($user_info->email);
            $sess_array = array(
                'id' => $user_info->id,
                'email' => $user_info->email,
                'name' => $user_info->name
            );
            $this->session->set_userdata('logged_in', $sess_array);
            
            echo "success";
            redirect(site_url()."?s=s");
        }
    }

    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        
        if($this->form_validation->run() == FALSE) {
            echo "error";
        }else{
            $email = $this->input->post('email');  
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->user->getUserInfoByEmail($clean);
            
            if(!$userInfo){
              echo "no_exists";
              exit;
                //$this->session->set_flashdata('flash_message', 'We cant find your email address');
                //redirect(site_url().'main/login');
            }   
            
            //if($userInfo->status != $this->status[1]){ //if status is not approved
            //    $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
            //    redirect(site_url().'main/login');
            //}
            
            //build token 
    
            $token = $this->user->insertToken($userInfo->id);                    
            $qstring = $this->base64url_encode($token);                      
            $url = site_url() . "?t=" . $qstring;
            $link = '<a href="' . $url . '">' . $url . '</a>'; 
            
            $message = '';                     
            $message .= '<strong>A password reset has been requested for this email account</strong><br>';
            $message .= '<strong>Please click:</strong> ' . $link;             
            echo $message; //send this through mail
            //exit;
        }
    }

    public function reset_password()
    {
        $token = $this->base64url_decode($this->uri->segment(3));
        $cleanToken = $this->security->xss_clean($token);
        
        $user_info = $this->user->isTokenValid($cleanToken); //either false or array();               
        
        if(!$user_info){
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            //redirect(site_url());
            echo "invalid_token";
            exit;
        }            
        $data = array(
            'name'=> $user_info->name, 
            'email'=>$user_info->email,                
            'token'=>$this->uri->segment(3),
            'user_id' => $user_info->id
        );
       
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
        
        if ($this->form_validation->run() == FALSE) {   
            echo "error";
            //redirect(site_url());
        }else{
            $this->load->library('password');                 
            $post = $this->input->post(NULL, TRUE);                
            $cleanPost = $this->security->xss_clean($post);                
            $hashed = $this->password->create_hash($cleanPost['password']);
            //$hashed = hash('sha256', $cleanPost['password']);
            $cleanPost['password'] = $hashed;
            $cleanPost['user_id'] = $user_info->id;
            unset($cleanPost['passconf']);                
            if(!$this->user->updatePassword($cleanPost)){
                $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
                echo "update_error";
            }else{
                $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
                echo "success";
                $this->user->updateLoginTime($user_info->email);
            
                $sess_array = array(
                    'id' => $user_info->id,
                    'email' => $user_info->email,
                    'name' => $user_info->name
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
        }
    }
    
    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

}
?>