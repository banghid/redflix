<?php
class UserModel extends CI_Model {
    
    const TABLE_NAME = 'user';

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getData($where=false){
        if($where){
            $query = $this->db->select('*')
                              ->from($this::TABLE_NAME)
                              ->where($where)
                              ->get();
            
        }else{
            $query = $this->db->select('*')
                              ->from($this::TABLE_NAME)
                              ->get();
        }

        return $query->result_array();
    }

    public function authenticate($where){

        $email = array(
            'email' => $where['email']
        );

        $users = $this->getData($email);
        foreach($users as $user){
            if($user){
                return $user;
            }else return false;
        }
        
        

    }

    public function insertData($data){
        $this->db->insert($this::TABLE_NAME, $data);
    }

    public function updateData($data){
        $this->db->update($this::TABLE_NAME, $data)
                 ->where('user_id',$data->user_id);
    }
    
}
?>