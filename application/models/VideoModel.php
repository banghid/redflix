<?php
class VideoModel extends CI_Model {
    
    const TABLE_NAME = 'video';

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

    public function insertData($data){
        $this->db->insert($this::TABLE_NAME, $data);
    }

    
}
?>