<?php
Class User extends CI_Model
{
    public $status;
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->status = $this->config->item('status');
    }
    
    function login($email, $password)
    {
        $this->load->library('password');
        $this->db->select('id, name, email, username, tel, nif, points, password, status');
        $this->db->from('user');
        $this->db->where('email', $email);
        //$this->db->where('password', hash('sha256', $password));
        $this->db->limit(1);
        
        $query = $this->db->get();

        $userInfo = $query->row();
        if ($query->num_rows() == 1) {
            if(!$this->password->validate_password($password, $userInfo->password)){
                return false; 
            }else
                return $query->result()[0];
        } else {
            return false;
        }
    }
    
    public function insertUser($d)
    {
        $this->load->library('password');
        $string = array(
            'name' => $d['name'],
            'email' => $d['email'],
            'password' => $this->password->create_hash($d['password']),
            'status' => $this->status[0],
            'creation_date' => date('Y/m/d - H:i')
        );
        $q      = $this->db->insert_string('user', $string);
        $this->db->query($q);
        $this->insertPhone($this->db->insert_id(), $d['tel']);
        return $this->db->insert_id();
    }

    public function insertPhone($id, $phone){
        $string = array(
            'refUser' => $id,
            'number' => $phone,
            'default_phone' => true
        );
        $q      = $this->db->insert_string('user_phone', $string);
        $this->db->query($q);
    }

    public function insertFBUser($d)
    {
        $string = array(
            'name' => $d['name'],
            'email' => $d['email'],
            'last_login' => $d['last_login'],
            'facebook' => $d['facebook'],
            'status' => $this->status[0],
            'creation_date' => date('Y/m/d - H:i')
        );
        $q      = $this->db->insert_string('user', $string);
        $this->db->query($q);
        return $this->db->insert_id();
    }
    
    public function isDuplicate($email)
    {
        $this->db->get_where('user', array(
            'email' => $email
        ), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    public function isLocalUser($email)
    {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->limit(1);
        
        $query = $this->db->get();

        $userInfo = $query->row();
        if ($query->num_rows() == 1) 
            return $userInfo->password == "" ? FALSE : TRUE;
        else
            return FALSE;
    }
    
    public function insertToken($user_id)
    {
        $token = substr(sha1(rand()), 0, 30);
        $date  = date('Y-m-d');
        
        $string = array(
            'token' => $token,
            'user_id' => $user_id,
            'created' => $date
        );
        $query  = $this->db->insert_string('tokens', $string);
        $this->db->query($query);
        return $token . $user_id;
        
    }

    public function isTokenValid($token)
    {
       $tkn = substr($token,0,30);
       $uid = substr($token,30);      
       
        $q = $this->db->get_where('tokens', array(
            'tokens.token' => $tkn, 
            'tokens.user_id' => $uid), 1);      
        
        if($this->db->affected_rows() > 0){
            $row = $q->row();             
            
            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);
            
            if($createdTS != $todayTS){
                return false;
            }
            
            $user_info = $this->getUserInfo($row->user_id);
            return $user_info;
            
        }else{
            return false;
        }
        
    } 

    public function updateUserInfo($post)
    {
        $data = array(
               'password' => $post['password'],
               'last_login' => date('Y/m/d - H:i'), 
               'status' => $this->status[1]
            );
        $this->db->where('id', $post['user_id']);
        $this->db->update('user', $data); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to updateUserInfo('.$post['user_id'].')');
            return false;
        }
        
        $user_info = $this->getUserInfo($post['user_id']); 
        return $user_info; 
    }

    public function updateUserInfoByEmail($post)
    {
        $data = array(
               'password' => $post['password'],
               'last_login' => date('Y/m/d - H:i'), 
               'status' => $this->status[2]
            );
        $this->db->where('email', $post['email']);
        $this->db->update('user', $data); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to updateUserInfo('.$post['email'].')');
            return false;
        }
        
        $user_info = $this->getUserInfoByEmail($post['email']); 
        return $user_info; 
    }

    public function getUserInfoByEmail($email)
    {
        $q = $this->db->get_where('user', array('email' => $email), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$email.')');
            return false;
        }
    }

    public function getUserInfo($id)
    {
        $q = $this->db->get_where('user', array('id' => $id), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }

    public function updatePassword($post)
    {   
        $this->db->where('id', $post['user_id']);
        $this->db->update('user', array('password' => $post['password'])); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to updatePassword('.$post['user_id'].')');
            return false;
        }        
        return true;
    } 

    public function updateLoginTime($email)
    {
        $this->db->where('email', $email);
        $this->db->update('user', array('last_login' => date('Y/m/d - H:i')));
        return;
    }

    public function updateStatus($email)
    {
        $this->db->where('email', $email);
        $this->db->update('user', array('last_login' => date('Y/m/d - H:i'), 'status' => $this->status[1]));
        return;
    }
}
?>