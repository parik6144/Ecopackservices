<?php
$this->load->view('header');
$this->load->view('left_sidebar');
$this->load->view('topbar');

//$this->load->view('report_header');
	function createtd($num)
    {
        $str="";
        for($i=0;$i<$num;$i++)
        {
            $str.="<td>0</td>";
        }
        return $str;
    }
echo "<pre>";
print_r($form_data);
?>
<style type="text/css"> .center_text{  text-align: center;  } td{ text-align: center; } th { text-align: center; } </style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Co. Wise Stock Report</h2>
    </div>
    <div class="col-lg-2"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Co. Wise Stock Records</h3>
                    <div class="ibox-tools">
                        <button class="btn btn-danger btn-circle btn-outline" id="btn_addrecord" type="button"><i class="fa fa-plus-circle"></i>
                        </button>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <style>th{ text-align: center; } td{ text-align: center; }</style>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="example">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <?php
                                $itemidary=array();
                                $opstock=array();
                                $tempstock=array();
                                foreach ($form_data['item'] as $row) {
                                    echo "<th colspan='2'>".$row['item_name'].$row['item_id']."</th>";
                                    array_push($itemidary,$row['item_id']);
                                    $x="0";
                                    array_push($tempstock,"0");
                                    //array_push($tempstock,$x);
                                }
                                ?>
                                <th>LR No.</th>
                                <th>Vehicle No.</th>
                                <th>Driver No</th>
                            </tr>
                            <tr>
                                <th></th>
                                <?php
                                foreach ($form_data['item'] as $row) {
                                    echo "<th>Co</th>";
                                    echo "<th>Warehouse</th>";
                                }
                                ?>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <td>Opening Stock</td>
                            <?php
                            foreach ($form_data['item'] as $row) {
                                echo "<td>".$row['co_stock']."</td>";
                                echo "<td>".$row['warehouse_stock']."</td>";
                            }
                            ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                            $prevdate="";
                            $prevtype="";
                            $consignment_no="";
                            $vehicle_inward_no="";
                            $prevqty="";
                            $previtemid="";
                            foreach ($form_data['inward'] as $row) {
                                if(empty($prevdate))
                                {
                                    $prevdate=$row['date'];
                                    $prevtype=$row['type'];
                                    $consignment_no=$row['consignment_no'];
                                    $vehicle_inward_no=$row['vehicle_inward_no'];
                                    $prevqty=$row['qty'];
                                    $previtemid=$row['item_id'];
                                }

                                /*if($consignment_no>='1432'){
                                    echo $row['consignment_no']."<br/>";
                                    echo $consignment_no;

                                    exit;
                                }*/
                                if($prevdate!=$row['date'] || $prevtype!=$row['type'] || $consignment_no!=$row['consignment_no'])
                                {
                                    //tr bangeadate("d-m-Y",strtotime($row['consignment_date']));

                                    echo "<tr>";
                                    echo "<td>".date("d-m-Y",strtotime($prevdate))."</td>";
                                    for($i=0;$i<sizeof($tempstock);$i++)
                                    {
                                        if($prevtype<3)
                                        {
                                            echo "<td>-</td>";
                                            echo "<td>".$tempstock[$i]."</td>";
                                        }
                                        else
                                        {
                                            echo "<td>".$tempstock[$i]."</td>";
                                            echo "<td>-</td>";
                                        }
                                        //echo "<td>".$tempstock[$i]."</td>";

                                        $tempstock[$i]=0;
                                    }
                                    if($prevtype=='4')
                                    {
                                        echo "<td>".$consignment_no."</td>";
                                        //echo "<td>".$row['consignment_no']."</td>";
                                        echo "<td>".$vehicle_inward_no."</td>";
                                        echo "<td></td>";
                                    }
                                    else
                                    {
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                    }
                                    $prevdate=$row['date'];
                                    $prevtype=$row['type'];
                                    $consignment_no=$row['consignment_no'];
                                    $prevqty=$row['qty'];
                                    $previtemid=$row['item_id'];
                                    echo "</tr>";
                                }
                                else
                                {
                                    //print_r($tempstock);
                                    //array may value jayega

                                    if(!empty($prevqty))
                                    {
                                        $pos=array_search($previtemid, $itemidary);
                                        $tempstock[$pos]=$prevqty;
                                        $prevqty="";
                                        $previtemid="";
                                    }

                                    $pos=array_search($row['item_id'], $itemidary);
                                    $tempstock[$pos]=$row['qty'];
                                }
                                //$prevqty=$row['qty'];

                            }
                            echo "<tr>";
                            echo "<td>".date("d-m-Y",strtotime($prevdate))."</td>";
                            for($i=0;$i<sizeof($tempstock);$i++)
                            {
                                if($prevtype<3)
                                {
                                    echo "<td>-</td>";
                                    echo "<td>".$tempstock[$i]."</td>";
                                }
                                else
                                {
                                    echo "<td>".$tempstock[$i]."</td>";
                                    echo "<td>-</td>";
                                }
                                //echo "<td>".$tempstock[$i]."</td>";

                                $tempstock[$i]=0;
                            }
                            if($prevtype=='4')
                            {
                                echo "<td>".$consignment_no."</td>";
                                //echo "<td>".$row['consignment_no']."</td>";
                                echo "<td>".$vehicle_inward_no."</td>";
                                echo "<td></td>";
                            }
                            else
                            {
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                            }
                            echo "</tr>";

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<?php
$this->load->view('footer');
?>
