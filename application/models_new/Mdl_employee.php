<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/08/2017
 * Time: 11:49
 */
class Mdl_employee extends CI_Model{

    public function saveemployee ($post)
    {
        
        if(empty($_POST['employee_name']))
            $employee_name="";
        else
            $employee_name=$_POST['employee_name'];
        if(empty($_POST['consignor_id']))
            $consignor_id="";
        else
            $consignor_id=$_POST['consignor_id'];

        
        $user_id=$this->session->userdata('user_id');
        $datetime=date('Y-m-d h:i:s');

         //`employee_name`, `mobile_no`, `mobile_no1`, `address`, `city`, `pincode`, `bank_name`, `branch`, `account_no`, `ifsc_code`
        $data=array("employee_name"=>$employee_name,
            "created_by"=>$user_id,
            "created_datetime"=>$datetime);
        $this->db->insert('tbl_employee',$data);
        $lastid=$this->db->insert_id();        
        return $lastid;


    }
    public function getemployee($start="",$length="",$searchstr="",$column,$type)
    {
        $col = (int)$column;
        if($start=='' && $length=='' && $searchstr=='')
        {
            $query=$this->db->select('`employee_id`, `employee_name`')
                ->from('tbl_employee')
                ->where('is_deleted','0')
                ->get();
            return $query->result_array();
        }
        else
        {

            $arr=array("employee_id", "employee_name");

            $this->db->select('`employee_id`, `employee_name`');
            if(!empty($searchstr))
            {
                $this->db->or_like('employee_name', $searchstr);
                
            }
             $this->db->where('is_deleted','0');
            $tempdb = clone $this->db;
            $this->db->order_by($arr[$col],$type);
            $num_rows = $tempdb->from('tbl_employee')->count_all_results();
            if($length>0)
                $this->db->limit($length, $start);
            $this->db->from('tbl_employee');
            $this->db->order_by('employee_id','desc');
            $query=$this->db->get();
            $response['count']=$num_rows;
            $response['data']=$query->result_array();
            return $response;
        }
    }
    public function getemployeebyid($employeeid)
    {
        $query=$this->db->select('`employee_id`, `employee_name`')
            ->from('tbl_employee')
            ->where(array("employee_id"=>$employeeid))
            ->get();
        $record['employee']=$query->result_array();
        return $record;
    }
    public function updateemployee($post)
    {
        if(empty($_POST['employee_name']))
            $employee_name="";
        else
            $employee_name=$_POST['employee_name'];
        
        $user_id=$this->session->userdata('user_id');
        $datetime=date('Y-m-d h:i:s');

         //`employee_name`, `mobile_no`, `mobile_no1`, `address`, `city`, `pincode`, `bank_name`, `branch`, `account_no`, `ifsc_code`
       $data=array("employee_name"=>$employee_name,
            "updated_datetime"=>$datetime,"updated_by"=>$user_id);
        $lastid=encryptor("decrypt",$post['employee_id']);
        $this->db->where('employee_id', encryptor("decrypt",$post['employee_id']));
        $this->db->update('tbl_employee',$data);
        return $lastid;
    }
    public function deletebyid($employeeid)
    {
        $data=array("is_deleted"=>'1');
        $this->db->where('employee_id', $employeeid);
        $this->db->update('tbl_employee',$data);
        return $this->db->affected_rows();
    }
    public function getEmployeeByConsignor($consignor_id)
    {
        $query=$this->db->select('`employee_id`, `employee_name`')
            ->from('tbl_employee')
            ->where(array("consignor_id"=>$consignor_id))
            ->get();
        return $query->result_array();
    }
}
?>