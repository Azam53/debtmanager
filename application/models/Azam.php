<?php
class Azam extends CI_Model{
        public function __construct()
        {
                $this->load->database();
                
        }

       public function data_service()
       {
                        $result = $this->db->get('info')->result_array();
                        return $result;
       }
}
