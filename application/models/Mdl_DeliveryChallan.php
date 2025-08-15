<?php
class Mdl_DeliveryChallan extends CI_Model{

    public function saveconsignment($post)
    {
        // var_dump($post); exit();

        // START INPUT VARIABLES STARTS HERE...
        if(empty($_POST['consignment_date']))
            $consignment_date="";
        else
            $consignment_date=date("Y-m-d", strtotime($_POST['consignment_date']));

        if(empty($_POST['consignor_id']))
            $consignor_id="";
        else
            $consignor_id=$_POST['consignor_id'];

        if(empty($_POST['consignee_id']))
            $consignee_id="";
        else
            $consignee_id=$_POST['consignee_id'];

        if(empty($_POST['source_id']))
            $source_id="";
        else
            $source_id=$_POST['source_id'];

        if(empty($_POST['destination_id']))
            $destination_id="";
        else
            $destination_id=$_POST['destination_id'];

        if(empty($_POST['bill_type']))
            $bill_type="";
        else
            $bill_type=$_POST['bill_type'];
        if(empty($_POST['consignment_value']))
            $consignment_value="";
        else
            $consignment_value=$_POST['consignment_value'];
        if(empty($_POST['d_c_no']))
            $d_c_no="";
        else
            $d_c_no=$_POST['d_c_no'];

        if(empty($_POST['vehicle_id']))
            $vehicle_id="";
        else
            $vehicle_id=$_POST['vehicle_id'];

        if(empty($_POST['way_bill_no']))
            $way_bill_no="";
        else
            $way_bill_no=$_POST['way_bill_no'];

        if(empty($_POST['driver_name']))
            $driver_name="";
        else
            $driver_name=$_POST['driver_name'];

        if(empty($_POST['advance']))
            $advance="";
        else
            $advance=$_POST['advance'];

        if(empty($_POST['due']))
            $due="";
        else
            $due=$_POST['due'];

        if(empty($_POST['driver_price']))
            $driver_price="";
        else
            $driver_price=$_POST['driver_price'];

        if(empty($_POST['consignment_type']))
            $consignment_type="";
        else
            $consignment_type=$_POST['consignment_type'];

        $consignment_warehouse_id=$_POST['warehouse_id'];

        // ENDS INPUT VARIABLES STARTS HERE...
        $user_id=$this->session->userdata('user_id');
        $datetime=date('Y-m-d h:i:s');
        $data=array("consignment_date"=>$consignment_date,"source_id"=>$source_id,"destination_id"=>$destination_id,"consignor_id"=>$consignor_id,"consignee_id"=>$consignee_id,"bill_type"=>$bill_type,"consignment_value"=>$consignment_value,"d_c_no"=>$d_c_no,"vehicle_id"=>$vehicle_id,"way_bill_no"=>$way_bill_no,"driver_name"=>$driver_name,"advance"=>$advance,"due"=>$due,"driver_price"=>$driver_price,"consignment_status"=>"0","consignment_type"=>$consignment_type,"created_by"=>$user_id,"created_datetime"=>$datetime,"consignment_warehouse_id"=>$consignment_warehouse_id);
        //print_r($data); exit();
        $this->db->insert('tbl_dcrental_consignment',$data);
        //echo $this->db->last_query(); exit();
        $consignment_id=$this->db->insert_id();
       // $consignment_no=$this->db->insert_id();

        // UPDATING DC CONSIGNMENT ACCORDING TO FINANCIAL YEAR CHANGE STARTS HERE.
        $date1="2020-03-31";
        $curdate=date('Y-m-d');
        if(strtotime($date1)< strtotime($consignment_date))
        {
            $qry=$this->db->select('max(consignment_no) as consignment_no')
            ->from('tbl_dcrental_consignment')
            ->where('consignment_date >',"2021-03-31")
            ->where('consignment_id >',"01")
            ->get();
            $row=$qry->row();
            if(is_null($row->consignment_no) || $row->consignment_no<=0){
                $consignment_no="1";
            }
            else
            {
                $consignment_no=$row->consignment_no+1;
            }
        }
        $data=array("consignment_no"=>$consignment_no);
        $this->db->where('consignment_id',$consignment_id);
        $this->db->update('tbl_dcrental_consignment',$data);
      // echo $this->db->last_query(); exit();
      // UPDATING DC CONSIGNMENT ACCORDING TO FINANCIAL YEAR CHANGE ENDS HERE.

       // echo 1; exit();
       // print_r($_POST['']); exit();
       // echo $_POST['item_name']; exit();

      // ADDING DC CONSIGNMENT ITEMS ACCORDING TO FINANCIAL YEAR CHANGE STARTS HERE.
        $data=array();
        for($i=0;$i<sizeof($_POST['item_name']);$i++)
        {
            if(trim($_POST['item_name'][$i]," ")!="")
            {
                $temp = array('consignment_id' => $consignment_id,'item_name' => $_POST['item_name'][$i],'qty' => $_POST['other_qty'][$i]);
                //print_r($temp); exit();
                array_push($data,$temp);
            }
        }
        
        if(sizeof($data)>0){ $this->db->insert_batch('tbl_dcrental_consignment_item', $data);
            // echo $this->db->last_query(); exit();
        }
        // ADDING DC CONSIGNMENT ITEMS ACCORDING TO FINANCIAL YEAR CHANGE ENDS HERE.
       // echo 2; exit();

        $data=array();
        for($i=0;$i<sizeof($_POST['item_id']);$i++)
        {
            if(!empty($_POST['qty'][$i]))
            {
                $temp = array('consignment_id' => $consignment_id,'item_id' => $_POST['item_id'][$i],'qty' => $_POST['qty'][$i]);
                array_push($data,$temp);
            }
        }

        $rentdata=array();
        for($i=0;$i<sizeof($_POST['rent_stock_item_id']);$i++)
        {
            if(!empty($_POST['rent_stock_item_qty'][$i]))
            {
                $warehouse_id=$_POST['warehouse_id'];
                $temp = array('consignment_id' => $consignment_id,'item_id' => $_POST['rent_stock_item_id'][$i],'qty' => $_POST['rent_stock_item_qty'][$i],"warehouse_id"=>$warehouse_id);
                array_push($rentdata,$temp);
            }
        }
        //print_r($temp);
       // echo 3; exit();

        if(sizeof($data)>0){
            if($_POST['consignment_type']=="0")
            {
                $this->db->insert_batch('tbl_dc_rental_consignment_stock_item', $data);
              //  echo $this->db->last_query();
            }
            else
            {
                $this->db->insert_batch('tbl_dc_rental_consignment_rent_item', $data);
               //echo $this->db->last_query();
            }
        }

        //exit();

        if(sizeof($rentdata)>0)
            $this->db->insert_batch('tbl_dc_rental_consignment_rent_stock_item', $rentdata);
        //echo $this->db->last_query();
        //echo 5;
      //  exit();
    }

    public function getconsignment($start="",$length="",$searchstr="",$column,$type)
    {
        $col = (int)$column;
        $arr=array("consignment_no", "consignment_date", "consignor_name", "consignee_name", "bill_type", "vehicle_inward_no","tbl_consignment.driver_name","consignment_status");
        if($start=='' && $length=='' && $searchstr=='')
        {
            $query=$this->db->select('`consignment_id`,
             `consignment_no`, `consignment_date`,
              tbl_dcrental_consignment.consignor_id, tbl_dcrental_consignment.consignee_id,
              `source_id`, `destination_id`, tbl_dcrental_consignment.vehicle_id,
              `total_amount`,,
              consignor_name,consignee_name,
              p.place_name as source,
              pa.place_name as destination')
                ->from('tbl_dcrental_consignment')
                ->join('tbl_consignor', 'tbl_consignor.consignor_id = tbl_dcrental_consignment.consignor_id', 'left')
                ->join('tbl_consignee', 'tbl_consignee.consignee_id = tbl_dcrental_consignment.consignee_id', 'left')
                ->join('tbl_vehicle_inward', 'tbl_vehicle_inward.vehicle_inward_id = tbl_dcrental_consignment.vehicle_id', 'left')
                ->join('place p', 'p.place_id = tbl_dcrental_consignment.source_id', 'left')
                ->join('place pa', 'pa.place_id = tbl_dcrental_consignment.destination_id', 'left')
                ->get();
            //echo $this->db->last_query();
            //exit;
            return $query->result_array();
        }
        else
        {
            $this->db->select('consignment_id,consignment_no, consignment_date, consignor_name, consignee_name, bill_type, vehicle_inward_no,tbl_dcrental_consignment.driver_name,consignment_status');
            if(!empty($searchstr))
            {
                $this->db->or_like('consignment_no', $searchstr);
                $this->db->or_like('consignment_date', $searchstr);
                $this->db->or_like('consignor_name', $searchstr);
                $this->db->or_like('consignee_name', $searchstr);
                $this->db->or_like('vehicle_inward_no', $searchstr);
                $this->db->or_like('tbl_dcrental_consignment.driver_name', $searchstr);
            }
            
            $tempdb = clone $this->db;
            $this->db->order_by($arr[$col],$type);
            $num_rows = $tempdb->from('tbl_dcrental_consignment')
            ->join('tbl_consignor', 'tbl_consignor.consignor_id = tbl_dcrental_consignment.consignor_id', 'left')
                ->join('tbl_consignee', 'tbl_consignee.consignee_id = tbl_dcrental_consignment.consignee_id', 'left')
                ->join('tbl_vehicle_inward', 'tbl_vehicle_inward.vehicle_inward_id = tbl_dcrental_consignment.vehicle_id', 'left')
                ->count_all_results();
            if($length>0)
                $this->db->limit($length, $start);
            $this->db->from('tbl_dcrental_consignment');
            $this->db->join('tbl_consignor', 'tbl_consignor.consignor_id = tbl_dcrental_consignment.consignor_id', 'left');
            $this->db->join('tbl_consignee', 'tbl_consignee.consignee_id = tbl_dcrental_consignment.consignee_id', 'left');
            $this->db->join('tbl_vehicle_inward', 'tbl_vehicle_inward.vehicle_inward_id = tbl_dcrental_consignment.vehicle_id', 'left');
            $this->db->order_by('consignment_no','desc');
            $query=$this->db->get();
            $response['count']=$num_rows;
            $response['data']=$query->result_array();
            //echo $this->db->last_query();
            //exit;
            return $response;
        }
    }


    public function getconsignmentbyid($consignmentid,$action="")
    {
        $query=$this->db->select('consignment_id,`consignment_no`, `consignment_date`, `source_id`, `destination_id`, `consignor_id`, `consignee_id`, `bill_type`, `consignment_value`, `d_c_no`, `vehicle_id`, `way_bill_no`, `driver_name`, `advance`, `due`,driver_price,consignment_type,consignment_warehouse_id')
            ->from('tbl_consignment')
            ->where(array("consignment_id"=>$consignmentid))
            ->get();
        $record['consignment']=$query->row();

        if(empty($action))
        {
            $query=$this->db->select('`employee_id`, `amount`')
            ->from('tbl_consignment_details')
            ->where(array("consignment_id"=>$consignmentid))
            ->get();
            $record['consignment_details']=$query->result_array();

             $query=$this->db->select('`item_name`, `qty`')
                ->from('tbl_consignment_item')
                ->where(array("consignment_id"=>$consignmentid))
                ->get();
            $record['consignment_item']=$query->result_array();
            if($record['consignment']->consignment_type=="0")
            {
                $query=$this->db->select('`item_id`, `qty`')
                ->from('tbl_consignment_stock_item')
                ->where(array("consignment_id"=>$consignmentid))
                ->get();
            }
            else
            {
                $query=$this->db->select('`item_id`, `qty`')
                ->from('tbl_consignment_rent_item')
                ->where(array("consignment_id"=>$consignmentid))
                ->get();
                $stockquery=$this->db->select('`item_id`, `qty`')
                ->from('tbl_consignment_rent_stock_item')
                ->where(array("consignment_id"=>$consignmentid))
                ->get();
                $record['rent_stock_item']=$stockquery->result_array();
            }
            $record['consignment_stock_item']=$query->result_array();
        }
        else
        {

        }
        return $record;
    }
    public function updateconsignment($post)
    {
        if(empty($_POST['consignment_date']))
            $consignment_date="";
        else
            $consignment_date=date("Y-m-d", strtotime($_POST['consignment_date']));

        if(empty($_POST['consignor_id']))
            $consignor_id="";
        else
            $consignor_id=$_POST['consignor_id'];

        if(empty($_POST['consignee_id']))
            $consignee_id="";
        else
            $consignee_id=$_POST['consignee_id'];

        if(empty($_POST['source_id']))
            $source_id="";
        else
            $source_id=$_POST['source_id'];

        if(empty($_POST['destination_id']))
            $destination_id="";
        else
            $destination_id=$_POST['destination_id'];

        if(empty($_POST['bill_type']))
            $bill_type="";
        else
            $bill_type=$_POST['bill_type'];
        if(empty($_POST['consignment_value']))
            $consignment_value="";
        else
            $consignment_value=$_POST['consignment_value'];
        if(empty($_POST['d_c_no']))
            $d_c_no="";
        else
            $d_c_no=$_POST['d_c_no'];

        if(empty($_POST['vehicle_id']))
            $vehicle_id="";
        else
            $vehicle_id=$_POST['vehicle_id'];

        if(empty($_POST['way_bill_no']))
            $way_bill_no="";
        else
            $way_bill_no=$_POST['way_bill_no'];

        if(empty($_POST['driver_name']))
            $driver_name="";
        else
            $driver_name=$_POST['driver_name'];

        if(empty($_POST['advance']))
            $advance="";
        else
            $advance=$_POST['advance'];

        if(empty($_POST['due']))
            $due="";
        else
            $due=$_POST['due'];

        if(empty($_POST['driver_price']))
            $driver_price="";
        else
            $driver_price=$_POST['driver_price'];

        if(empty($_POST['consignment_type']))
            $consignment_type="";
        else
            $consignment_type=$_POST['consignment_type'];

        $consignment_warehouse_id=$_POST['warehouse_id'];

        $user_id=$this->session->userdata('user_id');
        $datetime=date('Y-m-d h:i:s');

        $data=array("consignment_date"=>$consignment_date,"source_id"=>$source_id,"destination_id"=>$destination_id,"consignor_id"=>$consignor_id,"consignee_id"=>$consignee_id,"bill_type"=>$bill_type,"consignment_value"=>$consignment_value,"d_c_no"=>$d_c_no,"vehicle_id"=>$vehicle_id,"way_bill_no"=>$way_bill_no,"driver_name"=>$driver_name,"advance"=>$advance,"due"=>$due,"driver_price"=>$driver_price,"consignment_status"=>"0","consignment_type"=>$consignment_type,"created_by"=>$user_id,"created_datetime"=>$datetime,"consignment_warehouse_id"=>$consignment_warehouse_id);
        $consignment_id=encryptor('decrypt',$_POST['consignment_id']);
        $this->db->where('consignment_id',$consignment_id);
        $this->db->update('tbl_consignment',$data);

        $this->db->where('consignment_id',$consignment_id);
        $this->db->delete('tbl_consignment_details');

        $this->db->where('consignment_id',$consignment_id);
        $this->db->delete('tbl_consignment_item');

        $this->db->where('consignment_id',$consignment_id);
        $this->db->delete('tbl_consignment_stock_item');

        $this->db->where('consignment_id',$consignment_id);
        $this->db->delete('tbl_consignment_rent_item');

        $this->db->where('consignment_id',$consignment_id);
        $this->db->delete('tbl_consignment_rent_stock_item');

        if(empty($_POST['employee_rate']))
            $employee_rate="";
        else
            $employee_rate=$_POST['employee_rate'];
        $data=array();
        if(isset($_POST['employee_id']))
        {
            for($i=0;$i<sizeof($_POST['employee_id']);$i++)
            {
                $temp = array('consignment_id' => $consignment_id,'employee_id' => $_POST['employee_id'][$i],'amount' => $employee_rate );
                array_push($data,$temp);
            }
            $this->db->insert_batch('tbl_consignment_details', $data);
        }
        
        $data=array();
        for($i=0;$i<sizeof($_POST['item_name']);$i++)
        {
            if(trim($_POST['item_name'][$i]," ")!="")
            {
                $temp = array('consignment_id' => $consignment_id,'item_name' => $_POST['item_name'][$i],'qty' => $_POST['other_qty'][$i]);
                array_push($data,$temp);
            }
            
        }
        if(sizeof($data)>0)
            $this->db->insert_batch(' tbl_consignment_item', $data);

        $data=array();
        for($i=0;$i<sizeof($_POST['item_id']);$i++)
        {
            if(!empty($_POST['qty'][$i]))
            {
                $temp = array('consignment_id' => $consignment_id,'item_id' => $_POST['item_id'][$i],'qty' => $_POST['qty'][$i]);
                array_push($data,$temp);
            }
            
        }

        $rentdata=array();
        for($i=0;$i<sizeof($_POST['rent_stock_item_id']);$i++)
        {
            if(!empty($_POST['rent_stock_item_qty'][$i]))
            {
                $warehouse_id=$_POST['warehouse_id'];
                $temp = array('consignment_id' => $consignment_id,'item_id' => $_POST['rent_stock_item_id'][$i],'qty' => $_POST['rent_stock_item_qty'][$i],"warehouse_id"=>$warehouse_id);
                array_push($rentdata,$temp);
            }
            
        }
        if(sizeof($data)>0){
            if($_POST['consignment_type']=="0")
            {
                $this->db->insert_batch('tbl_consignment_stock_item', $data);
            }
            else
            {
                $this->db->insert_batch('tbl_consignment_rent_item', $data);
                
            }
            
        }
        if(sizeof($rentdata)>0)
                    $this->db->insert_batch('tbl_consignment_rent_stock_item', $rentdata);
        
    }
    public function deletebyid($consignmentid)
    {
        $data=array("is_deleted"=>'1');
        $this->db->where('consignment_id', $consignmentid);
        $this->db->update('consignment',$data);
        return $this->db->affected_rows();
    }


    function getconsignmentforprint($consignmentid)
    {
        $query=$this->db->select('consignment_id,`consignment_no`, `consignment_warehouse_id`, `warehouse_name`,`warehouse_address`, `warehouse_city`,`consignment_date`, `consignor_name`,tbl_consignor.address,tbl_consignor.city,tbl_consignor.state,tbl_consignor.pincode,tbl_consignor.mobile_no,tbl_consignor.gstin as consignor_gstin,`consignee_name`,tbl_consignee.address as c_address,tbl_consignee.city as c_city,tbl_consignee.state as c_state,tbl_consignee.pincode as c_pincode,tbl_consignee.mobile_no as c_mobile_no,tbl_consignee.gstin, `consignment_value`, `d_c_no`,tbl_vehicle_inward.vehicle_inward_no,tbl_vehicle_inward.driver_name,tbl_vehicle_inward.mobile_no as v_mobile_no, `way_bill_no`,tbl_source.place_name as source, tbl_destination.place_name as destination,consignment_type')
            ->from('tbl_dcrental_consignment')
            ->join('tbl_consignor', 'tbl_consignor.consignor_id = tbl_dcrental_consignment.consignor_id', 'left')
            ->join('tbl_consignee', 'tbl_consignee.consignee_id = tbl_dcrental_consignment.consignee_id', 'left')
            ->join('tbl_warehouse', 'tbl_warehouse.warehouse_id = tbl_dcrental_consignment.consignment_warehouse_id', 'left')
            ->join('tbl_vehicle_inward', 'tbl_vehicle_inward.vehicle_inward_id = tbl_dcrental_consignment.vehicle_id', 'left')
            ->join('place as tbl_source', 'tbl_source.place_id = tbl_dcrental_consignment.source_id', 'left')
            ->join('place as tbl_destination', 'tbl_destination.place_id = tbl_dcrental_consignment.destination_id', 'left')
            ->where(array("consignment_id"=>$consignmentid))
            ->get();
        $record['consignment']=$query->row();
        //print_r($record);
        //exit;

        $query=$this->db->select('`employee_id`, `amount`')
            ->from('tbl_dcrental_consignment_details')
            ->where(array("consignment_id"=>$consignmentid))
            ->get();
        $record['consignment_details']=$query->result_array();
        //echo $this->db->last_query();
        //print_r($record['consignment_details']);
        //exit;

         $query=$this->db->select('`item_name`, `qty`')
            ->from('tbl_dcrental_consignment_item')
            ->where(array("consignment_id"=>$consignmentid))
            ->get();
        $record['consignment_item']=$query->result_array();
        //echo $this->db->last_query();
        //print_r($record['consignment_item']);
       // exit;


        if($record['consignment']->consignment_type=="0"){
            $query=$this->db->select('`qty`,item_name,tbl_dcrental_consignment_stock_item.item_id')
            ->from('tbl_dcrental_consignment_stock_item')
            ->join('tbl_item', 'tbl_item.item_id = tbl_dcrental_consignment_stock_item.item_id', 'left')
            ->where(array("consignment_id"=>$consignmentid))
            ->get();
//            echo $this->db->last_query();
//           print_r($record['consignment_item']);
//            exit();
        }
        else
        {
            $query=$this->db->select('`qty`,rent_item_name as item_name,tbl_dc_rental_consignment_rent_item.item_id')
            ->from('tbl_dc_rental_consignment_rent_item')
            ->join('tbl_rent_item', 'tbl_rent_item.rent_item_id = tbl_dc_rental_consignment_rent_item.item_id', 'left')
            ->where(array("consignment_id"=>$consignmentid))
            ->get();
            //echo $this->db->last_query();
            //exit();
        }
        $record['consignment_stock_item']=$query->result_array();

        if($record['consignment']->consignment_type=="1"){
            $query=$this->db->select('`qty`,item_name,tbl_dc_rental_consignment_rent_stock_item.item_id')
                ->from('tbl_dc_rental_consignment_rent_stock_item')
                //->join('tbl_item', 'tbl_item.item_id = tbl_dc_rental_consignment_rent_stock_item.item_id', 'left')
                ->join('tbl_rent_item_master', 'tbl_rent_item_master.master_item_id = tbl_dc_rental_consignment_rent_stock_item.item_id', 'left')
                ->where(array("consignment_id"=>$consignmentid))
                ->get();
         $record['consignment_rent_stock_item']=$query->result_array();
//       echo $this->db->last_query();
        // print_r($record['consignment_rent_stock_item']);
       //  exit();
        }
        return $record;
    }


    
    public function getPendingRentConsignment($consignee_id)
    {
        $query=$this->db->select('tbl_consignment.consignment_id,consignment_date,sum(qty*price) as price')
        ->from('tbl_consignment')
        ->join('tbl_consignment_rent_item', 'tbl_consignment_rent_item.consignment_id = tbl_consignment.consignment_id', 'left')
        ->join('tbl_rent_item', 'tbl_rent_item.rent_item_id = tbl_consignment_rent_item.item_id', 'left')
        ->where(array('consignment_type' => 1,'invoice_id' => 0,'`tbl_consignment`.`consignee_id`' => $consignee_id, 'tbl_rent_item.rent_type'=>'0'))
        ->group_by('tbl_consignment.consignment_id')->get();
        return $query->result_array();
    }
    public function getPendingTransportConsignment($consignee_id)
    {
        //SELECT OrderID, Quantity, IF(Quantity>10, "MORE", "LESS")
    }
    public function getRentItemForInvoice($consignmentIdArray)
    {
        $query=$this->db->select('sum(qty) as qty,rent_item_name as item_name')
            ->from('tbl_consignment_rent_item')
            ->join('tbl_rent_item', 'tbl_rent_item.rent_item_id = tbl_consignment_rent_item.item_id', 'left')
            ->where_in('consignment_id',$consignmentIdArray)
             ->group_by('tbl_consignment_rent_item.item_id')->get();
             return $query->result_array();
    }
    public function getConsignmentByInvoiceID($invoice_id)
    {
        $query=$this->db->select('tbl_consignment.consignment_id,consignment_date,sum(qty*price) as price')
        ->from('tbl_consignment')
        ->join('tbl_consignment_rent_item', 'tbl_consignment_rent_item.consignment_id = tbl_consignment.consignment_id', 'left')
        ->join('tbl_rent_item', 'tbl_rent_item.rent_item_id = tbl_consignment_rent_item.item_id', 'left')
        ->where(array('consignment_type' => 1,'invoice_id' => $invoice_id))
        ->group_by('tbl_consignment.consignment_id')->get();
        
        return $query->result_array();
    }
	
	public function getreportByconsigneeId()
    {
        $date_from=date("Y-m-d", strtotime($_POST['date_from']));
        $date_to=date("Y-m-d", strtotime($_POST['date_to']));
        $consignee_id=$_POST['consignee_id'];
        
		$this->db->select('consignment_id,consignment_no, consignment_date, consignor_name, consignee_name, bill_type, vehicle_inward_no,owner_name,tbl_inward_owner.mobile_no,consignment_status');
		$this->db->from('tbl_consignment');
		$this->db->join('tbl_consignor', 'tbl_consignor.consignor_id = tbl_consignment.consignor_id', 'left');
		$this->db->join('tbl_consignee', 'tbl_consignee.consignee_id = tbl_consignment.consignee_id', 'left');
		$this->db->join('tbl_vehicle_inward', 'tbl_vehicle_inward.vehicle_inward_id = tbl_consignment.vehicle_id', 'left');
		$this->db->join('tbl_inward_owner', 'tbl_vehicle_inward.owner_id = tbl_inward_owner.owner_id', 'left');
		$this->db->where(array('tbl_consignment.consignee_id' => $consignee_id,'consignment_date >=' => $date_from,'consignment_date <=' => $date_to));
		$this->db->order_by('consignment_no','asc');
		$query=$this->db->get();
		$response=$query->result_array();
		//echo $this->db->last_query();
		//exit;
		return $response;
        
    }
    public function getrecentconsignment()
    {
        $date=date("Y-m-d", strtotime('-4 days') );
        $query=$this->db->select('consignment_id,consignment_no')
                ->from('tbl_consignment')
                ->where('consignment_date >=',$date)
                ->get();
                return $query->result_array();
    }
}
?>