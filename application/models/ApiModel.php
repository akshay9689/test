<?php
defined('BASEPATH') OR exit("NO direct script access allowed");

    class ApiModel extends CI_Model 
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
      
      
        public function check_data($user_id, $latitude, $longitude)
        {
            $this->db->where('user_id',$user_id);
            $this->db->where('latitude',$latitude);
            $this->db->where('longitude',$longitude);
            return $this->db->get('locations')->row_array();
        }

        

         public function insertData($tbl,$arr)
        {
          $this->db->insert($tbl,$arr);
          $insert_id=$this->db->insert_id();
          return $insert_id;
        }


        public function check_id($id)
        {
            $this->db->where('id',$id);
            return $this->db->get('locations')->row_array();
        }


        public function check_id_with_user_id($id, $user_id)
        {
            $this->db->where('id',$id);
            $this->db->where('user_id',$user_id);
            return $this->db->get('locations')->row_array();
        }


         public function edit_info($tbl,$where,$arr)
        {
            $this->db->where($where);
           
            if ($this->db->update($tbl,$arr)) 
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }


    
        public function get_user_data($u_id)
        {
            $this->db->where('user_id',$u_id);
            $this->db->where('deleted_at =', NULL);
            return $this->db->get('locations')->row_array();
        }


        public function get_user_all_data($u_id)
        {
            $this->db->where('user_id',$u_id);
            $this->db->where('deleted_at =', NULL);
            return $this->db->get('locations')->result_array();
        }
      


















       

       } //main class