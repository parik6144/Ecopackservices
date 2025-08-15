<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/08/2017
 * Time: 11:49
 */
class Mdl_ledger extends CI_Model{
    public function getledger()
    {
    	$date_from=date("Y-m-d", strtotime($_POST['date_from']));
        $date_to=date("Y-m-d", strtotime($_POST['date_to']));
        if($_POST['receiver_type']=="all")
        {
        	$query=$this->db->query("SELECT consignment_no as consignment_id,amount,tbl_payment_advance.created_datetime as date,'Transportation' as perticular,tbl_inward_owner.owner_name as account_name,'' as ref_id,'' as receiver_type,'0' as transaction_type, payment_mode  FROM `tbl_payment_advance` LEFT JOIN tbl_inward_owner on tbl_inward_owner.owner_id=tbl_payment_advance.owner_id LEFT JOIN tbl_consignment on tbl_consignment.consignment_id=tbl_payment_advance.consignment_id where DATE(tbl_payment_advance.created_datetime)>='".$date_from."' and DATE(tbl_payment_advance.created_datetime)<='".$date_to."'
union

SELECT consignment_no as consignment_id,amount,tbl_payment_due.created_datetime as date,'Transportation' as perticular,tbl_inward_owner.owner_name as account_name,'' as ref_id,'' as receiver_type,'0' as transaction_type,payment_mode  FROM `tbl_payment_due` LEFT JOIN tbl_inward_owner on tbl_inward_owner.owner_id=tbl_payment_due.owner_id LEFT JOIN tbl_consignment on tbl_consignment.consignment_id=tbl_payment_due.consignment_id where DATE(tbl_payment_due.created_datetime)>='".$date_from."' and DATE(tbl_payment_due.created_datetime)<='".$date_to."'
union

SELECT '' as consignment_id, amount, payment_date as date, concat(expense_head_name,'->',TRIM(remarks)) as perticular,'' as account_name,tbl_payment_booking.ref_id,tbl_payment_booking.receiver_type,'0' as transaction_type,payment_mode FROM `tbl_payment_booking` LEFT JOIN tbl_expense_head on tbl_expense_head.expense_head_id=tbl_payment_booking.expense_head_id WHERE tbl_payment_booking.is_deleted=0 and tbl_payment_booking.is_confirm=2 and DATE(payment_date)>='".$date_from."' and DATE(payment_date)<='".$date_to."'
union SELECT invoice_no as consignment_id,amount,receipt_date as date,'receipt' as perticular,consignee_billing_name as account_name,'' as ref_id,'' as receiver_type,'1' as transaction_type,payment_mode FROM `tbl_receipt` LEFT JOIN tbl_invoice on tbl_invoice.invoice_id=tbl_receipt.invoice_id
LEFT JOIN tbl_consignee_billing on tbl_consignee_billing.consignee_billing_id=tbl_invoice.billing_address_id
WHERE DATE(receipt_date)>='".$date_from."' and DATE(receipt_date)<='".$date_to."'
 order by date");
        }

        // RECEVIER
        elseif($_POST['receiver_type']=="1")
        {
        	//ecopack employee
        	$staff_id=$_POST['staff_id'];
            if(is_int($_POST['staff_id']))
            {
          $query=$this->db->query("SELECT '' as consignment_id, amount, payment_date as date, concat(expense_head_name,'->',TRIM(remarks)) as perticular,'' as account_name,tbl_payment_booking.ref_id,tbl_payment_booking.receiver_type,'0' as transaction_type,payment_mode FROM `tbl_payment_booking` LEFT JOIN tbl_expense_head on tbl_expense_head.expense_head_id=tbl_payment_booking.expense_head_id WHERE tbl_payment_booking.is_deleted=0 and tbl_payment_booking.is_confirm=2 and DATE(payment_date)>='".$date_from."' and DATE(payment_date)<='".$date_to."' and tbl_payment_booking.ref_id=".$staff_id." and tbl_payment_booking.receiver_type='1' order by date
");
            }

            if($_POST['staff_id']=='all')
            {
         $query=$this->db->query("SELECT '' as consignment_id, amount, payment_date as date,
 concat(expense_head_name,'->',TRIM(remarks)) as perticular,'' as account_name,tbl_payment_booking.ref_id,tbl_payment_booking.receiver_type,
 '0' as transaction_type,payment_mode FROM `tbl_payment_booking`
 LEFT JOIN tbl_expense_head on tbl_expense_head.expense_head_id=tbl_payment_booking.expense_head_id
 WHERE tbl_payment_booking.is_deleted=0 and tbl_payment_booking.is_confirm=2
 and DATE(payment_date)>='".$date_from."' and DATE(payment_date)<='".$date_to."'
 and tbl_payment_booking.receiver_type='1' order by date
");
            }
        }
        elseif($_POST['receiver_type']=="2")
        {
        	//other party
        	$staff_id=$_POST['account_id'];
        	$query=$this->db->query("
SELECT '' as consignment_id, amount, payment_date as date, concat(expense_head_name,'->',TRIM(remarks)) as perticular,'' as account_name,tbl_payment_booking.ref_id,tbl_payment_booking.receiver_type,'0' as transaction_type,payment_mode FROM `tbl_payment_booking` LEFT JOIN tbl_expense_head on tbl_expense_head.expense_head_id=tbl_payment_booking.expense_head_id WHERE tbl_payment_booking.is_deleted=0 and tbl_payment_booking.is_confirm=2 and DATE(payment_date)>='".$date_from."' and DATE(payment_date)<='".$date_to."' and tbl_payment_booking.receiver_type='2' and tbl_payment_booking.ref_id='".$staff_id."' order by date
");

        }
        
        elseif($_POST['receiver_type']=="3")
        {
        	//ecopack transporter
        	$owner_id=$_POST['owner_id'];

            if(is_numeric(($_POST['owner_id'])))
            {
            $query=$this->db->query("
            SELECT consignment_id,amount,tbl_payment_advance.created_datetime as date,'Transportation' as perticular,tbl_inward_owner.owner_name as account_name,'' as ref_id,'' as receiver_type,'0' as transaction_type, payment_mode  FROM `tbl_payment_advance` LEFT JOIN tbl_inward_owner on tbl_inward_owner.owner_id=tbl_payment_advance.owner_id where DATE(tbl_payment_advance.created_datetime)>='".$date_from."' and DATE(tbl_payment_advance.created_datetime)<='".$date_to."' and tbl_payment_advance.owner_id=".$owner_id."
            union

            SELECT consignment_id,amount,tbl_payment_due.created_datetime as date,'Transportation' as perticular,tbl_inward_owner.owner_name as account_name,'' as ref_id,'' as receiver_type,'0' as transaction_type,payment_mode  FROM `tbl_payment_due` LEFT JOIN tbl_inward_owner on tbl_inward_owner.owner_id=tbl_payment_due.owner_id where DATE(tbl_payment_due.created_datetime)>='".$date_from."' and DATE(tbl_payment_due.created_datetime)<='".$date_to."' and tbl_payment_due.owner_id=".$owner_id."
            union

            SELECT '' as consignment_id, amount, payment_date as date, concat(expense_head_name,'->',TRIM(remarks)) as perticular,'' as account_name,tbl_payment_booking.ref_id,tbl_payment_booking.receiver_type,'0' as transaction_type,payment_mode FROM `tbl_payment_booking` LEFT JOIN tbl_expense_head on tbl_expense_head.expense_head_id=tbl_payment_booking.expense_head_id WHERE tbl_payment_booking.is_deleted=0 and tbl_payment_booking.is_confirm=2 and DATE(payment_date)>='".$date_from."' and DATE(payment_date)<='".$date_to."' and tbl_payment_booking.receiver_type='3' and tbl_payment_booking.ref_id='".$owner_id."' order by date
            ");
            }

            if($_POST['owner_id']=='all')
            {
            $query=$this->db->query("
            SELECT consignment_id,amount,tbl_payment_advance.created_datetime as date,'Transportation' as perticular,tbl_inward_owner.owner_name as account_name,'' as ref_id,'' as receiver_type,'0' as transaction_type, payment_mode  FROM `tbl_payment_advance` LEFT JOIN tbl_inward_owner on tbl_inward_owner.owner_id=tbl_payment_advance.owner_id where DATE(tbl_payment_advance.created_datetime)>='".$date_from."' and DATE(tbl_payment_advance.created_datetime)<='".$date_to."'
            union

            SELECT consignment_id,amount,tbl_payment_due.created_datetime as date,'Transportation' as perticular,tbl_inward_owner.owner_name as account_name,'' as ref_id,'' as receiver_type,'0' as transaction_type,payment_mode  FROM `tbl_payment_due` LEFT JOIN tbl_inward_owner on tbl_inward_owner.owner_id=tbl_payment_due.owner_id where DATE(tbl_payment_due.created_datetime)>='".$date_from."' and DATE(tbl_payment_due.created_datetime)<='".$date_to."'
            union

            SELECT '' as consignment_id, amount, payment_date as date, concat(expense_head_name,'->',TRIM(remarks)) as perticular,'' as account_name,tbl_payment_booking.ref_id,tbl_payment_booking.receiver_type,'0' as transaction_type,payment_mode FROM `tbl_payment_booking` LEFT JOIN tbl_expense_head on tbl_expense_head.expense_head_id=tbl_payment_booking.expense_head_id WHERE tbl_payment_booking.is_deleted=0 and tbl_payment_booking.is_confirm=2 and DATE(payment_date)>='".$date_from."' and DATE(payment_date)<='".$date_to."' and tbl_payment_booking.receiver_type='3' order by date
            ");
             // echo $this->db->last_query(); exit();
            }
        }
        elseif($_POST['receiver_type']=="4")
        {
        	//ecopack employee
        	$staff_id=$_POST['staff_id'];

        	$query=$this->db->query("
SELECT '' as consignment_id, amount, payment_date as date, concat(expense_head_name,'->',TRIM(remarks)) as perticular,'' as account_name,tbl_payment_booking.ref_id,tbl_payment_booking.receiver_type,'0' as transaction_type,payment_mode FROM `tbl_payment_booking` LEFT JOIN tbl_expense_head on tbl_expense_head.expense_head_id=tbl_payment_booking.expense_head_id WHERE tbl_payment_booking.is_deleted=0 and tbl_payment_booking.is_confirm=2 and DATE(payment_date)>='".$date_from."' and DATE(payment_date)<='".$date_to."' and tbl_payment_booking.receiver_type='4' and tbl_payment_booking.ref_id='".$staff_id."' order by date
");

        }



return $query->result_array();
    }
}
?>