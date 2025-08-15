<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/08/2017
 * Time: 12:27
 */
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                   <img alt="Ecopack" class="" src="<?php echo site_url();?>uploads/EcoPack1.png" style="width:100%;" />
                </div>
                <div class="logo-element">
                    EcoPack
                </div>
            </li>

            <?php
            $month=date('m');
            $year=date('Y');?>
            <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),1,73,'is_view'))) { ?>
                <li><a href="<?php echo site_url('Dashboard?')."m=".$month."&y=".$year; ?>"> <i class="fa fa-home"></i>Dashboard</a></li>
            <?php } ?>

            <li class="">
                <a href="#"><i class="fa fa-bar-chart-o"></i> Master<span class="fa arrow"></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),2,1,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('branch'); ?>" ><i class="fa fa-marker"></i>Branch</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),2,2,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('place'); ?>" ><i class="fa fa-marker"></i>Place</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),2,3,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('consignee_billing'); ?>"><i class="fa fa-envelope-open-o"></i>Billing Address Consigneee</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),2,4,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('consignee'); ?>"><i class="fa fa-building-o"></i>Consignee</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),2,5,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('consignor'); ?>"><i class="fa fa-building-o"></i>Consignor</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),2,6,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('warehouse'); ?>"><i class="fa fa-building-o"></i>warehouse</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),2,7,'is_view'))) { ?>
                    <li >
                        <a href="<?php echo site_url('orderno'); ?>"><i class="fa fa-building-o"></i>Order No</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="" >
                <a href="#"><i class="fa fa-users"></i> HR<span class="fa arrow"></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,8,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('employee'); ?>"><i class="fa fa-user"></i>Staff</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,75,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('inwardemployee'); ?>"><i class="fa fa-user"></i>Inward Employee</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,76,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('employee_type'); ?>"><i class="fa fa-user"></i>Department</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,11,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('staff'); ?>"><i class="fa fa-user"></i>Employee</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,12,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('employee_salary'); ?>"><i class="fa fa-user"></i>Salary List</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,9,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('holiday'); ?>"><i class="fa fa-user"></i>Holiday List</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,10,'is_view'))) { ?>
                    <li>
                        <a href="<?php echo site_url('working_day'); ?>"><i class="fa fa-user"></i>Other Working Day</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,13,'is_view'))){ ?>
                    <li>
                        <a href="<?php echo site_url('advance_salary'); ?>"><i class="fa fa-user"></i>Advance Salary</a>
                    </li>
                    <?php } ?>

                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),3,14,'is_view'))){ ?>
                    <li>
                      <a href="<?php echo site_url('Attendance'); ?>"><i class="fa fa-user"></i>Attendance</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="" >
                <a href="#"><i class="fa fa-signal"></i> Finance <span class="fa arrow"></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,15,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('account'); ?>"><i class="fa fa-building-o"></i>Account</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,16,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('invoicetype'); ?>"><i class="fa fa-inventory"></i>Invoice Type</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,17,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('inwardrate'); ?>"><i class="fa fa-inr"></i>Inward Rate</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,18,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('outwardrate'); ?>"><i class="fa fa-inr"></i>Outward vehicle Rate</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,21,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('transport_invoice_rate'); ?>"><i class="fa fa-inr"></i>Transport Invoice Rate</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,19,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('labor_invoice_rate'); ?>"><i class="fa fa-inr"></i>Labor Invoice Rate</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,20,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('invoice'); ?>"><i class="fa fa-car"></i>Invoice</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,22,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('expense_head'); ?>"><i class="fa fa-inr"></i>Expense Head</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,23,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('payment_booking'); ?>"><i class="fa fa-inr"></i>Expense Booking</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,24,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('booking_transfer'); ?>"><i class="fa fa-inr"></i>Due Booking Payment</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,25,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('pending_advance'); ?>"><i class="fa fa-arrow-up"></i>Advance Pending</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,26,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('pending_due'); ?>"><i class="fa fa-arrow-up"></i>Due Pending</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,27,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('ledger'); ?>"><i class="fa fa-arrow-up"></i>Ledger</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,28,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('invoice/getbookdebts'); ?>"><i class="fa fa-arrow-up"></i>Book-Debts</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,29,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('receipt'); ?>"><i class="fa fa-arrow-up"></i>Receipt</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,30,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('loan'); ?>"><i class="fa fa-arrow-up"></i>Loan</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,31,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('loan_pending'); ?>"><i class="fa fa-arrow-up"></i>Loan Booking Pending</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),4,32,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('tds'); ?>"><i class="fa fa-arrow-up"></i>TDS</a>
                        </li>
                    <?php } ?>

                </ul>
            </li>

            <li class="">
                <a href="#"><i class="fa fa-bar-chart-o"></i>AMS<span class="fa arrow"></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,33,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('itemmaster'); ?>"><i class="fa fa-inventory"></i>Ecopack Item Master</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,34,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('item'); ?>"><i class="fa fa-inventory"></i>CO. Wise Item</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,35,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('rentitem'); ?>"><i class="fa fa-inventory"></i>Rent Invoice Item</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,36,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('rentwarehouse'); ?>"><i class="fa fa-inventory"></i>Rent Ware House</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,37,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('stocktransfer'); ?>"><i class="fa fa-inventory"></i>Stock Transfer</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,38,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('rentstocktransfer'); ?>"><i class="fa fa-inventory"></i>Rent Stock Transfer</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,39,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('asign_rent_item'); ?>"><i class="fa fa-inventory"></i>Assign Stock</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),5,40,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('asset_lost'); ?>"><i class="fa fa-inventory"></i>Asset Lost/Damage</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="">
                <a href="#"><i class="fa fa-bar-chart-o"></i> Operation<span class="fa arrow"></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,41,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('vehicletype'); ?>"><i class="fa fa-car"></i>Vehicle Type</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,42,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('inwardowner'); ?>"><i class="fa fa-user"></i>Owner</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,43,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('vehicle_inward'); ?>"><i class="fa fa-car"></i>Vehicle</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,44,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('inward'); ?>"><i class="fa fa-download"></i>Inward</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,45,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('consignment'); ?>"><i class="fa fa-arrow-up"></i>Consignment</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,41,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('consignment/Deliverychallan'); ?>"><i class="fa fa-arrow-up"></i>Delivery Challan</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,46,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('pending_consignment'); ?>"><i class="fa fa-arrow-up"></i>Consignment Pending</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,47,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('contactDetails'); ?>"><i class="fa fa-building-o"></i>Contact Details</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,50,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('other_item'); ?>"><i class="fa fa-building-o"></i>Other Item</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,48,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('other_item_stock'); ?>"><i class="fa fa-building-o"></i>Other Item Stock</a>
                        </li>
                    <?php } ?>
                    <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),6,49,'is_view'))) { ?>
                        <li>
                            <a href="<?php echo site_url('diesel_expense'); ?>"><i class="fa fa-building-o"></i>Diesel Expense</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <?php if((!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,51,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,52,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,53,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,54,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,55,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,56,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,57,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,62,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,63,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,64,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,65,'is_view')))) { ?>
                <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> Reports<span class="fa arrow"></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,51,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('stock_report'); ?>"><i class="fa fa-inventory"></i>Stock Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,52,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('co_stock_report'); ?>"><i class="fa fa-inventory"></i>Rent Stock Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,53,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('item_wise_report'); ?>"><i class="fa fa-inventory"></i>Item Wise Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,54,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('warehouse_wise_report'); ?>"><i class="fa fa-inventory"></i>IDLE Stock</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,55,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('followup'); ?>"><i class="fa fa-car"></i>Vehicle followup</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,56,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('followup_report'); ?>"><i class="fa fa-car"></i>followup Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,57,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('driver_report'); ?>"><i class="fa fa-car"></i>Driver Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,58,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('owner_report'); ?>"><i class="fa fa-car"></i>Owner Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,59,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('employee_report'); ?>"><i class="fa fa-car"></i>Employee Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,60,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('advance_payment'); ?>"><i class="fa fa-arrow-up"></i>Advance Payment</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,61,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('due_payment'); ?>"><i class="fa fa-arrow-up"></i>Due Payment</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,62,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('consignment_report'); ?>"><i class="fa fa-arrow-up"></i>Consignment Record</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,63,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('place_report'); ?>"><i class="fa fa-arrow-up"></i>Place Report</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,64,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('invoice_report'); ?>"><i class="fa fa-car"></i>Invoice</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),7,65,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('gst_report'); ?>"><i class="fa fa-car"></i>GST Report</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if((!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),8,65,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),8,66,'is_view'))) && (!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),8,70,'is_view')))) { ?>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> Marketing<span class="fa arrow"></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),8,65,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('project'); ?>"><i class="fa fa-building-o"></i>New Project</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),8,66,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('project/ongoing'); ?>"><i class="fa fa-building-o"></i>Ongoing Project</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),8,70,'is_view'))) { ?>
                            <li><a href="<?php echo site_url('monthly_booking_list'); ?>"><i class="fa fa-bar-chart-o"></i>Booking List</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),9,74,'is_view'))) { ?>
                <li>
                    <a href="https://ecopackservices.com:2096/" target="_blank">Email Login</a>
                </li>
            <?php } ?>
            <?php if((!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),10,72,'is_view')))) { ?>
                <li>
                    <a href="#"><i class="fa fa-cogs"></i> Setting<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <?php if(!empty($this->Mdl_setting->is_access($this->session->userdata('user_id'),10,72,'is_view'))) { ?>
                            <li>
                                <a href="<?php echo site_url('Setting/access');?>"><i class='fa fa-cogs'></i>Access Module</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
