
<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');



header("Access-Control-Allow-Headers: Authorization");
header("Access-Control-Allow-Origin: *");

class ApiController extends CI_Controller
{ 
    function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('ApiModel');

    }


    public function check_lat($lat){

    
    return preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $lat);


    }


    public function check_lon($lon){


    return preg_match('/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $lon);

        
    }


    public function user_add_location()
    {


        if(!empty($this->input->post('user_id')) && !empty($this->input->post('latitude')) && !empty($this->input->post('longitude')) )
        {
            $user_id  = $this->input->post('user_id');
            $latitude  = $this->input->post('latitude');
            $longitude  = $this->input->post('longitude');

            $user_data = $this->ApiModel->check_data($user_id, $latitude, $longitude);

            
            if(!$user_data)
            {


               $is_lat_validate  =  $this->check_lat($latitude);
               $is_lon_validate  =  $this->check_lat($longitude);


               if($is_lat_validate !== 1 && $is_lon_validate !== 1){

                  $response['error_code'] = "406";
                  $response['message'] = "please fill correct latitude and longitude";
                  echo json_encode($response);
                  exit();

               }


                $arr = array(

                    'user_id' => $user_id,
                    'latitude' => $latitude,                                       
                    'longitude' => $longitude,
                    'created_at' => date('Y-m-d H:i:s')

                );

                $add = $this->ApiModel->insertData('locations',$arr);

                if($add)
                {

                 $response['error_code'] = "200";
                 $response['message'] = "location added successfully. ";
                 $response['data'] = $arr;
                 echo json_encode($response);
                 exit();
             }
             else
             {
                 $response['error_code'] = "403";
                 $response['message'] = "Something went wrong";
                 echo json_encode($response);
                 exit();
             }

         }
         else
         {
            $response['error_code'] = "404";
            $response['message'] = "this longitude and latitude already present. please try another.";
            echo json_encode($response);
            exit();
        }

    } 
    else
    {
        $response['error_code'] = "406";
        $response['message'] = "Please fill in all the required fields";
        echo json_encode($response);
        exit();
    } 
}



public function user_update_location()
{


    if(!empty($this->input->post('id')) && !empty($this->input->post('user_id')) && !empty($this->input->post('latitude')) && !empty($this->input->post('longitude')) )
    {
        $id  = $this->input->post('id');
        $user_id  = $this->input->post('user_id');
        $latitude  = $this->input->post('latitude');
        $longitude  = $this->input->post('longitude');

        $user_data = $this->ApiModel->check_data($user_id, $latitude, $longitude);
        $check_id = $this->ApiModel->check_id($id);
        $check_id_with_user_id = $this->ApiModel->check_id_with_user_id($id, $user_id);

        if($check_id && $check_id_with_user_id) {

            if(!$user_data)
            {

               $is_lat_validate  =  $this->check_lat($latitude);
               $is_lon_validate  =  $this->check_lat($longitude);


               if($is_lat_validate !== 1 && $is_lon_validate !== 1){

                  $response['error_code'] = "406";
                  $response['message'] = "please fill correct latitude and longitude";
                  echo json_encode($response);
                  exit();

               }


                $data = array(

                    'user_id' => $user_id,
                    'latitude' => $latitude,                                       
                    'longitude' => $longitude,
                    'updated_at' => date('Y-m-d H:i:s')

                );

                $where_id = '(id="'.$id.'")';
                $update_id = $this->ApiModel->edit_info($tbl="locations",$where_id,$data);

                if($update_id)
                {

                 $response['error_code'] = "200";
                 $response['message'] = "location updated successfully. ";
                 $response['data'] = $data;
                 echo json_encode($response);
                 exit();
             }
             else
             {
                 $response['error_code'] = "403";
                 $response['message'] = "Something went wrong";
                 echo json_encode($response);
                 exit();
             }

         }
         else
         {
            $response['error_code'] = "404";
            $response['message'] = "this longitude and latitude already present. please try another.";
            echo json_encode($response);
            exit();
        }


                // data start

    }

    else {

      $response['error_code'] = "404";
      $response['message'] = "record not found to update";
      echo json_encode($response);
      exit();

  } 

                // start ends

} 


else
{
    $response['error_code'] = "406";
    $response['message'] = "Please fill in all the required fields";
    echo json_encode($response);
    exit();
} 
}


     // soft delete
public function user_delete_location()
{


    if(!empty($this->input->post('id')) && !empty($this->input->post('user_id')) )
    {
        $id  = $this->input->post('id');
        $user_id  = $this->input->post('user_id');


        $check_id = $this->ApiModel->check_id($id);
        $check_id_with_user_id = $this->ApiModel->check_id_with_user_id($id, $user_id);

        if($check_id && $check_id_with_user_id) {


            $data = array(

                'deleted_at' => date('Y-m-d H:i:s')

            );
            

            $where_id = '(id="'.$id.'")';
            $update_id = $this->ApiModel->edit_info($tbl="locations",$where_id,$data);

            if($update_id)
            {

             $response['error_code'] = "200";
             $response['message'] = "location delete successfully. ";
             echo json_encode($response);
             exit();
         }
         else
         {
             $response['error_code'] = "403";
             $response['message'] = "Something went wrong";
             echo json_encode($response);
             exit();
         }


     }

     else {

        $response['error_code'] = "404";
        $response['message'] = "record not found to delete";
        echo json_encode($response);
        exit();

    } 

} 


else
{
    $response['error_code'] = "406";
    $response['message'] = "Please fill in all the required fields";
    echo json_encode($response);
    exit();
} 
}


       // get user location
        public function get_user_location()
        {
            if(!empty($this->input->post('user_id')))
            {
              
                
              
                $u_id = $this->input->post('user_id');
               
                $user = $this->ApiModel->get_user_data($u_id);

                if($user)
                { 
                    $all_data = $this->ApiModel->get_user_all_data($u_id);
                    $data=array();

                    if($all_data)
                    {
                        foreach($all_data as $w_h)
                        {
                           

                            $data[] = array(
                                                'id' =>  $w_h['id'],
                                                'latitude' => $w_h['latitude'],
                                                'longitude' => $w_h['longitude'],
                                               
                                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $data;
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "User Not Found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                $response['error_code'] = "406";
                $response['message'] = "Please fill in all the required fields";
                echo json_encode($response);
                exit();
            }
        }



         public function get_distance()
        {
            if(!empty($this->input->post('user_id')) && !empty($this->input->post('lat1')) && !empty($this->input->post('lon1')) && !empty($this->input->post('lat2')) && !empty($this->input->post('lon2')) && !empty($this->input->post('unit')))
            {
              
                
              
                $u_id = $this->input->post('user_id');

                $lat1 = $this->input->post('lat1');
                $lon1 = $this->input->post('lon1');
                $lat2 = $this->input->post('lat2');
                $lon2 = $this->input->post('lon2');
                $unit = $this->input->post('unit');
               
                $user = $this->ApiModel->get_user_data($u_id);

                if($user)
                { 



               $is_lat1_validate  =  $this->check_lat($lat1);
               $is_lon1_validate  =  $this->check_lat($lon1);
               $is_lat2_validate  =  $this->check_lat($lat2);
               $is_lon2_validate  =  $this->check_lat($lon2);


               if($is_lat1_validate !== 1 && $is_lon1_validate !== 1 && $is_lat2_validate !== 1 && $is_lon2_validate !== 1){

                  $response['error_code'] = "406";
                  $response['message'] = "please fill correct latitude and longitude";
                  echo json_encode($response);
                  exit();

               }

                    
                    $data=array();

                    $theta = $lon1 - $lon2;
                    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                   $dist = acos($dist);
                   $dist = rad2deg($dist);
                   $miles = $dist * 60 * 1.1515;
                   $unit = strtoupper($unit);

                   if ($unit == "K") {
                    $d = $miles * 1.609344." kms";
                   } 
                   else {
                    $d = $miles. " miles";
                   }


                            $data = array(
                                                'distance' =>  $d,
                                                
                                               
                                            );
                        

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $data;
                        echo json_encode($response);
                        exit();
                   
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "User Not Found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                $response['error_code'] = "406";
                $response['message'] = "Please fill in all the required fields";
                echo json_encode($response);
                exit();
            }
        }




}

?>



















