<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/08/2017
 * Time: 11:49
 */
class Mdl_place extends CI_Model{

    public function saveplace($post)
    {
        //`id`, `place_name`, `mobile`, `mobile2`, `phone`, `phone2`
        if(empty($_POST['place_name']))
            $place_name="";
        else
            $place_name=$_POST['place_name'];
        $user_id=$this->session->userdata('user_id');
        $datetime=date('Y-m-d h:i:s');

        $data=array("place_name"=>$place_name,"created_by"=>$user_id,"created_datetime"=>$datetime);
        $this->db->insert('place',$data);
        return $this->db->insert_id();

    }
    public function getplace($start="",$length="",$searchstr="",$column,$type)
    {
         $col = (int)$column;
         $arr=array("place_id","place_name");
        if($start=='' && $length=='' && $searchstr=='')
        {
            
            $query=$this->db->select('place_id,`place_name`')
                ->from('place')
                ->where('is_deleted', '0')
                ->get();
            return $query->result_array();
        }
        else
        {
            $this->db->select('place_id,`place_name`');
            $this->db->where('is_deleted', '0');
            if(!empty($searchstr))
            {
                $this->db->or_like('place_name', $searchstr);

            }
            $tempdb = clone $this->db;
            $this->db->order_by($arr[$col],$type);
            $num_rows = $tempdb->from('place')->count_all_results();
            if($length>0)
                $this->db->limit($length, $start);
            $this->db->from('place');
            $this->db->order_by('place_id','desc');
            $query=$this->db->get();
            $response['count']=$num_rows;
            $response['data']=$query->result_array();
            return $response;
        }
    }
    public function getplacebyid($placeid)
    {
        $query=$this->db->select('`place_name`,place_id')
            ->from('place')
            ->where(array("place_id"=>$placeid))
            ->get();
        $record['place']=$query->result_array();

        return $record;
    }
    public function updateplace($post)
    {
        if(!empty($post['place_name']))
            $place_name=$post['place_name'];
        else
            $place_name='';
        $user_id=$this->session->userdata('user_id');
        $datetime=date('Y-m-d h:i:s');
        $data=array("place_name"=>$place_name,"updated_datetime"=>$datetime,"updated_by"=>$user_id);
        $lastid=encryptor("decrypt",$post['place_id']);
        $this->db->where('place_id', encryptor("decrypt",$post['place_id']));
        $this->db->update('place',$data);
       
    }
    public function deletebyid($placeid)
    {
        $data=array("is_deleted"=>'1');
        $this->db->where('place_id', $placeid);
        $this->db->update('place',$data);
        return $this->db->affected_rows();
    }
    public function getnotification()
    {
         $query=$this->db->select('`notification_text`,notification_heading')
                ->from('tbl_notification')
                ->where('is_sent', '1')
                ->get();
            return $query->result_array();
    }

}
?>