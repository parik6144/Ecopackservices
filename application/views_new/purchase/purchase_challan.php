<?php
/**
 * Created by PhpStorm.
 * User: Amit Parik
 * Date: 16/08/2017
 * Time: 14:52
 */
$this->load->view('header');
//$this->load->view('left_sidebar');
//$this->load->view('topbar');
?>
<style>
    .table > tfoot > tr > td{
        vertical-align: middle;
    }
    .table > tbody > tr > td{
        vertical-align: middle;
    }
    .table > thead > tr > th{
        text-align: center;
    }
    .custom_control{
        margin-bottom: 15px;
    }
    .ibox-tools a {
        cursor: pointer;
        margin-left: 5px;
        color: #fefefe !important;
        font-size: 16px;
        background: #1ab394;
        padding: 3px 10px;
        border-radius: 3px;
    }
    .output-data-by {
        padding: 10px 0 0;
    }

    .output-data-by label.ad {
        font-weight: 600;
        font-size: 14px;
    }

    .output-data-by label.ph {
        font-weight: 600;
        font-size: 14px;
    }
    .i-checks {
        padding-left: 0;
        display: inline-block;
        margin-right: 10px;
    }

    td{
        border:1px solid #000000;
    }
    .logo{
        width:25%;
    }
    .description{
        height:200px;
    }
    .item{
        border-right: none;
        text-align: center;
    }
    .item_border{
        border-bottom: 0px solid !important;
        text-align: center;
        /*border-right: 0px solid;*/
    }
    td,.noborder{
        border-bottom: ;
        text-align: center;
    }
    .ibox-tools a {
        cursor: pointer;
        margin-left: 5px;
        color: #fefefe !important;
        font-size: 16px;
        background: #1ab394;
        padding: 3px 10px;
        border-radius: 3px;
    }
</style>
<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;margin:auto;width: 100%;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg1 td{font-family:Arial, sans-serif;font-size:14px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-yw4l{vertical-align:top}
    th.tg-yw4l {text-align: left;}
    span.bold {
        font-weight: 700;
    }
	.bold{
		font-weight: 600;
	}
	ul.det-lst {
		list-style: none;
	}

	ul.det-lst li {
		font-size: 16px;
		/* padding: 0 10px; */
		line-height: 22px;
		display: inline-block;
    padding-right: 10px;
		/* text-align: left; */
	}
	
	/*---------- new challan format -------------*/
	.logo-cnt {
         display: flex;
    }
    
    .address-lst {
        padding-left: 15px;
    }
    
    ul.det-lst-0 {
        margin: 0;
        list-style: none;
        padding-left: 10px;
    }
    .h-20{
        height: 20px;
    }

    table.testInfoTable {
        page-break-before: always;
        width: 200px;
    }

    table.testInfoTable td, table.testInfoTable th {
        border: 1px solid;
    }
    
    .testInfoTable{ page-break-after: always; }
</style>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title" style="display: none;">
                    <h5>Purchase Challan<small></small></h5>
                    <div class="ibox-tools">
                        <a href="<?php echo site_url('Delivery') ?>"><i class="fa fa-angle-left"></i> Back</a>
                    </div>
                </div>

                <div class="ibox-content">
					<div class="testInfoTable" id="ConsigneeCopy" style="padding: 10px;">
						<table class="tg">
							<thead>
								<tr>
									<th style="width: 30%; border: none;" colspan="4" class="text-left" colspan="3" style="text-align: -webkit-center;">
									<span class="bold" style="font-weight: bold;">Purchase Challan</span></th>
									<th style="width: 30%; border: none;" colspan="4"></th>
								</tr>
							</thead>
                            <tbody>
								<tr>
									<!--<th colspan="2" style="width: 10%;"><img src="<?=base_url()?>/uploads/EcoPack.jpg" style="height: 40px;"></th>-->
									<th class="text-center" colspan="10">
										<h2 class="bold">Purchase Challan</h2>
									</th>
								</tr>
								
								<tr>
									<td class="text-left" colspan="4">
									    <div class="logo-cnt">
									        <img src="<?=base_url()?>/uploads/EcoPack.jpg" style="height: 40px;">
    										<div class="address-lst">
    										    <h3 class="bold">Ecopack Services Pvt. Ltd</h3>
									        	<p style="font-size: 16px;">H.No-15A, A-Road Zone No : 1B, Birsanagar, Telco Jamshedpur - 831019, Jharkhand</p>
    										</div>
									    </div>

                                        <div class="address-lst">
                                            <p style="font-size: 16px;">GSTNO :   20AAECE1697G1ZV</br>
                                                Company's PAN: AAECE1697G </br>
                                            E-mail :  saroj@ecopackservices.com</br></p>
                                        </div>
									</td>
									
									<td class="text-center" colspan="6">
										<table style="width: 100%">
											<thead>
												<tr>
													<td style="text-align:left; height: auto;"><b>Booking No : </b></td>
													<td style="text-align:left; height: auto; width: auto;">000<?=$booking_id?></td>
													
													<td style="text-align:left;"><b>Dated: </b></td>
													<td style="text-align:left;"><?=date("d-M-Y",strtotime($booking_date))?></td>
												</tr>
												<tr>
													<td style="text-align:left; height: auto;"><b>Warehouse : </b></td>
													<td style="text-align:left; height: auto;"><b> <?=$warehouse_name?></b></td>
													
													<td style="text-align:left; height: auto;"><b>Warehouse City : </b></td>
													<td style="text-align:left; height: auto;"><?=$warehouse_city?></td>
												</tr>
                                                <tr>
                                                    <td style="text-align:left; height: auto;"><b>Branch : </b></td>
                                                    <td style="text-align:left; height: auto;"><b> <?=$warehouse_name?></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left; height: auto;"><b>Vehicle No : </b></td>
                                                    <td style="text-align:left; height: auto;"><b> <?=$warehouse_name?></b></td>

                                                    <td style="text-align:left; height: auto;"><b>Added By : </b></td>
                                                    <td style="text-align:left; height: auto;"><?=$warehouse_city?></td>
                                                </tr>
											</thead>
										</table>
									</td>
								</tr>


                            </tbody>
                        </table>

                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td colspan="10" style="text-align:center; border-top-color: transparent; "><h3>Purchased Item List</h3></td>
                                </tr>

								<tr>
									<td colspan="1" style="text-align:center;"><b>Sl No</b></td>
									<td colspan="6" style="text-align:center;"><b>Description Of Goods</b></td>
									<td colspan="3" style="text-align:center;"><b>Quantity</b></td>
								</tr>

                                <?php $ctr=1; $rqty=0; foreach ($itemlist as $row) { ?>
                                    <tr>
                                        <td colspan="1" style="text-align:center;"><?=$ctr?></td>
                                        <td colspan="6" style="text-align:center;"><?=$row['item_name']?>

                                        <?php
                                        $query=$this->db->select('barcode_no')
                                        ->from('tbl_item_barcodes')
                                        ->where(array("booking_id"=>$booking_id))
                                        ->where(array("item_id"=>$row['master_item_id']))
                                        ->get();
                                        // $this->db->last_query();
                                        $record =$query->result_array();
                                        $CountRecords= $query->num_rows();
                                        if($CountRecords>0){ echo "</br><b>"."Barcodes"."</b></br>";
                                        foreach($query->result_array() as $res):
                                            echo $res['barcode_no']."</br>";
                                        endforeach; }
                                        ?>

                                        </td>
                                        <td colspan="3" style="text-align:center;"><?=$row['qty']?></td>
                                        <?php
                                        $sql="";
                                        ?>
                                    </tr>
                                <?php $rqty=$rqty+$row['qty']; $ctr++; } ?>

                                <tr>
                                    <td colspan="1" style="text-align:center;"><b>Taxable Value : <?=$taxable_value?></b></td>
                                    <td colspan="6" style="text-align:center;"><b>Tax : <?=$tax?>% </b></td>
                                    <td colspan="3" style="text-align:center;"><b>Total : <?=$amount?></b></td>
                                </tr>

                            </tbody>
                        </table>

                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td colspan="5" style="text-align:left; height: 160px; width: 50%; vertical-align:top; border-top-color: transparent; padding: 20px; ">Remarks : <?=$remarks?></td>
                                    <td colspan="5" style="text-align:center; height: 160px; vertical-align:bottom; border-top-color: transparent; "><b>Authorised Signatory </br> <strong style="text-align:right;">For Ecopack Services Pvt. Ltd </strong></b></td>
                                </tr>

								<tr>
									<td colspan="10" style="text-align:center; width: 50%;">
                                        Note: Kindly submit the receiving copy to the transporter through courier or in hand within 10 days of delivery, or else transporter will not be responsible for the rest payment
                                    </td>
								</tr>
								
							</tbody>
						</table>
                        <br>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>

<script type="text/javascript">
   // window.print();
    //window.close();
  //  setTimeout(function(){window.close();}, 1000);
</script>


</html>
