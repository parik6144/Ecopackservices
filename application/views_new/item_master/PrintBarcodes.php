<?php
/**
 * Created by PhpStorm.
 * User: Amit Parik
 * Date: 16/08/2017
 * Time: 14:52
 */
$this->load->view('header');
$this->load->view('left_sidebar');
$this->load->view('topbar');
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
                <div class="ibox-content">
					
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>
</body>
</html>
