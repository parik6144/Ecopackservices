<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/08/2017
 * Time: 11:49
 */
class Mdl_barcode extends CI_Model {

    public function getbarcodeitems($start="",$length="",$searchstr="",$column,$type)
    {
        $col = (int)$column;
        $arr=array("item_id","COUNT(`barcode_no`)  as countbarcodes");
        if($start=='' && $length=='' && $searchstr=='')
        {
            $query=$this->db->select('barcode_id,`item_name`,item_id,COUNT(barcode_no) AS Countempbarcodes`')
                ->from('tbl_item_barcodes')
                ->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left')
                ->get();
            //echo $this->db->last_query(); exit;
            return $query->result_array();
        }
        else
        {
            $this->db->select('`barcode_id`,`item_name`, `item_id`,count(`barcode_no`) as countbarcodes');
            if(!empty($searchstr))
            {
                $this->db->or_like('item_id', $searchstr);
            }
            $tempdb = clone $this->db;
            //$this->db->order_by($arr[$col],$type);
            $num_rows = $tempdb->from('tbl_item_barcodes')->count_all_results();
            if($length>0)
                $this->db->limit($length, $start);
            $this->db->from('tbl_item_barcodes');
            $this->db->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left');
            $this->db->group_by('item_id');
            $query=$this->db->get();
            //echo $this->db->last_query(); exit;
            $response['count']=$num_rows;
            $response['data']=$query->result_array();
            return $response;
        }
    }

    public function getbarcodependingitems($start="",$length="",$searchstr="",$column,$type)
    {
        $col = (int)$column;
        $arr=array("item_id","COUNT(`barcode_no`)  as countbarcodes");
        if($start=='' && $length=='' && $searchstr=='')
        {
            $query=$this->db->select('barcode_id,`item_name`,item_id,COUNT(barcode_no) AS Countempbarcodes`')
                ->from('tbl_item_barcodes')
                ->where(array("barcode_no"=>''))
                ->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left')
                ->get();
            //echo $this->db->last_query(); exit;
            return $query->result_array();
        }
        else
        {
            $this->db->select('`barcode_id`,`item_name`, `item_id`,count(`barcode_no`) as countbarcodes');
            if(!empty($searchstr))
            {
                $this->db->or_like('item_id', $searchstr);
//                $this->db->or_like('item_name', $searchstr);
//                $this->db->or_like('barcode_no', $searchstr);
            }
            $tempdb = clone $this->db;
            //$this->db->order_by($arr[$col],$type);
            $num_rows = $tempdb->from('tbl_item_barcodes')->count_all_results();
            if($length>0)
            $this->db->limit($length, $start);
            $this->db->from('tbl_item_barcodes');
            $this->db->where(array("barcode_no"=>''));
            $this->db->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left');
            $this->db->group_by('item_id');
            $query=$this->db->get();
            //echo $this->db->last_query(); exit;
            $response['count']=$num_rows;
            $response['data']=$query->result_array();
            return $response;
        }
    }

    public function getbarcodelistitems($start="",$length="",$searchstr="",$column, $type)
    {
        $item_id = $this->uri->segment(3);
        $item_id = encryptor('decrypt',$item_id);
        $col = (int)$column;
        $arr=array("item_id","COUNT(`barcode_no`)  as countbarcodes");
        if($start=='' && $length=='' && $searchstr=='')
        {
            $query=$this->db->select('barcode_id,`item_name`,item_id,COUNT(barcode_no) AS Countempbarcodes`')
                ->from('tbl_item_barcodes')
                //->where(array("barcode_no"=>''))
                //->where('item_id',$item_id)
                ->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left')
                ->get();
            //echo $this->db->last_query(); exit;
            return $query->result_array();
        }
        else
        {
            $this->db->select('`barcode_id`,`item_name`, `item_id`,count(`barcode_no`) as countbarcodes');
            if(!empty($searchstr))
            {
                $this->db->or_like('item_id', $searchstr);
//                $this->db->or_like('item_name', $searchstr);
//                $this->db->or_like('barcode_no', $searchstr);
            }
            $tempdb = clone $this->db;
            //$this->db->order_by($arr[$col],$type);
            $num_rows = $tempdb->from('tbl_item_barcodes')->count_all_results();
            if($length>0) $this->db->limit($length, $start);
            $this->db->from('tbl_item_barcodes');
            // $this->db->where(array("barcode_no"=>''));
            // $this->db->where('item_id',$item_id);
            $this->db->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left');
            $this->db->group_by('item_id');
            $query=$this->db->get();
            //echo $this->db->last_query(); exit;
            $response['count']=$num_rows;
            $response['data']=$query->result_array();
            return $response;
        }
    }

    public function getpendingbarcodesbyID()
    {
        $item_id = $this->uri->segment(3);
        $item_id = encryptor('decrypt',$item_id);
        $query=$this->db->select('barcode_id,`item_name`,item_id,booking_id')
            ->from('tbl_item_barcodes')
            ->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left')
            ->where('barcode_no', '')
            ->where('item_id',$item_id)
            ->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }


    public function getbarcodesbyitemID()
    {
        $item_id = $this->input->get('ID');
        $item_id = encryptor('decrypt',$item_id);
        $query=$this->db->select('barcode_id,barcode_no,`item_name`,item_id,booking_id')
            ->from('tbl_item_barcodes')
            ->join('tbl_rent_item_master','tbl_rent_item_master.master_item_id=tbl_item_barcodes.item_id','left')
            ->where('item_id',$item_id)
            ->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }


    public function updateitembarcodes($POST)
    {
        $SUC=0; $FAIL=0;
        //print_r($_POST); exit();
        for($i=0; $i<=sizeof($_POST['item_id']); $i++){
            if (empty($_POST['barcode_no'])) $barcode_no = ""; else $barcode_no = $_POST['barcode_no'][$i];
            if (empty($_POST['barcode_id'])) $barcode_id = ""; else $barcode_id = $_POST['barcode_id'][$i];
            if (empty($_POST['booking_id'])) $booking_id = ""; else $booking_id = $_POST['booking_id'][$i];
            if (empty($_POST['item_id'])) $item_id = ""; else $item_id = $_POST['item_id'][$i];
            $data = array('barcode_no' => $barcode_no);

            // CHECKING DUPLICATE ENTRY.
            $this->db->select('barcode_no');
            $this->db->from('tbl_item_barcodes');
            $this->db->where('barcode_no', $barcode_no = $_POST['barcode_no'][$i]);
            $query = $this->db->get();
            $num = $query->num_rows();
            if($num == 0) {
                $this->db->where('item_id', $item_id);
                $this->db->where('barcode_id', $barcode_id);
                $this->db->where('booking_id', $booking_id);
                $this->db->update('tbl_item_barcodes', $data);
                //echo $this->db->last_query();
                $SUC++;
                $this->session->set_flashdata('sucessupdate',$SUC);
            }
            else
            {
                $FAIL++;
                $this->session->set_flashdata('failupdate',$FAIL);
            }
            // CHECKING DUPLICATE ENTRY.
        }
        return true;
    }



//    public function getbarcodependingitems()
//    {
//        $query=$this->db->select('item_id`,COUNT(`barcode_no`) AS countempbarcodes')
//            ->from('tbl_item_barcodes')
//            ->where(array("barcode_no"=>''))
//            ->group_by('item_id')
//            ->get();
//        //echo $this->db->last_query();
//        return $record['emp_barcodes']=$query->result_array();
//        //return $record;
//    }
}
?>