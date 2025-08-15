<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 16/08/2017
 * Time: 14:52
 */
if(!isset($condition))
{
$this->load->view('header');
$this->load->view('left_sidebar');
$this->load->view('topbar');

//var_dump($form_data['account']['0']['account_name']);
//exit;
?>
<link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet" />
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Purchase</h2>

        </div>
        <div class="col-lg-2">

        </div>
    </div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New Purchase</h5>
                    <button class="pull-right btn-info"><a href="<?php echo site_url('payment_booking/purchaseRecords') ?>" style="color: white;"> View Records</a> </button>
                </div>
                <?php } ?>
                <div class="ibox-content">
                    <form method="POST" class="form-horizontal" id="frm_payment_booking">

                        <div class="row" style="border: 0px solid #ddd;">
                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Purchase Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control rec"  name="booking_date">
                                </div>
                            </div>

                            <!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Expense Head</label>
                                <div class="input-group">
                                    <select class="form-control rec expense_head"  name="expense_head">
                                        <option value="16" selected="selected">Purchase(Fixed Assets)</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <div class="form-group  row" style="display: none;"><label class="col-sm-2 control-label">Receiver Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control rec" id="receiver_type"  name="receiver_type">
                                            <option value="">Select Receiver Type</option>
                                            <option value="1" selected>Ecopack Employee</option>
                                            <option value="4">Other Employee</option>
                                            <option value="2">Other Party</option>
                                            <option value="3">Transporter</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="staff_name select_user">
                                <label class="col-sm-6 control-label">Employee Name</label>
                                <div class="input-group">
                                    <select class="form-control rec"  name="staff_id">
                                        <option value="">Select Employee</option>
                                        <?php foreach ($staff as $row){ ?>
                                            <option value="<?=$row['staff_id']?>"><?=$row['emp_no']." ".$row['staff_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <!-- /.col-md-4 -->
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="row">
                            <!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Vehicle No</label>
                                <div class="input-group">
                                    <select class="form-control rec vehicle_id"  name="vehicle_id">
                                        <option value="">Select Vehicle No</option>
                                        <?php foreach ($vehicle_no as $row){ ?>
                                          <option value="<?=$row['vehicle_inward_id']?>"><?=$row['vehicle_inward_no']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Warehouse</label>
                                <div class="input-group">
                                    <select class="form-control rec"  name="warehouse_id">
                                        <option value="">warehouse</option>
                                        <?php foreach ($warehouse as $row){ ?>
                                            <option value="<?=$row['warehouse_id']?>"><?=$row['warehouse_name']?> - <?=$row['place_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Branch</label>
                                <div class="input-group">
                                    <select class="form-control rec" name="branch_id">
                                        <option value="">Select Branch</option>
                                        <?php
                                        foreach ($branch as $row) {
                                            echo "<option value='".$row['branch_id']."'>".$row['branch_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="table-responsive">
                            <table class="table table stripped item_table">
                                <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Tax%</th>
                                    <th>Total</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody id="item_table_tbody">
                                <tr>
                                    <td>
                                    <select class="form-control item_name"  name="item_id[]">
                                    <option value="">Select Item</option>
                                    <?php foreach ($item as $row){ ?>
                                    <option value="<?=$row['master_item_id']?>" price="<?=$row['price']?>" tax="<?=$row['tax']?>"><?=$row['item_code']."-".$row['item_name']?></option>
                                    <?php } ?>
                                    </select>
                                    </td>
                                    <td><input type="number" class="form-control qty" name="qty[]"></td>
                                    <td><input type="text" class="form-control price" name="price[]"></td>
                                    <td><input type="number" class="form-control tax" name="tax[]"></td>
                                    <td><input type="number" class="form-control total" name="total[]"></td>
                                    <td>
                                        <!--  MODAL BARCODE STARTS HERE -->
                                        <div id="barcode_modal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title text-center">Barcode Manager</h2>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row" id="barcode_listing"></div>
                                                        <input type="hidden" id="itemsbarcode" name="itemsbarcode">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!--  MODAL BARCODE ENDS HERE -->
                                    </td>
                                    <td><button class="btn btn-info btn-circle add_new_default" type="button" title="Add new"><i class="fa fa-plus"></i>
                                        </button><button class="btn btn-danger btn-circle btn_delete_default" type="button" title="Delete"  style="display: none;"><i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Taxable Value</label>
                                <div class="input-group">
                                       <input type="number" class="form-control rec taxable_value"  name="taxable_value">
                                </div>
                            </div>
                            <!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Invoice Total</label>
                                <div class="input-group">
                                     <input type="number" class="form-control rec amount"  name="amount">
                                </div>
                            </div>
                            <!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <label class="col-sm-6 control-label">Tax</label>
                                <div class="input-group">
                                    <input type="number" class="form-control rec purchase_tax"  name="purchase_tax">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.col-md-4 -->
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row" style="display: none;"><label class="col-sm-2 control-label">TDS</label>
                            <div class="col-sm-10">
                                <label> <input type="radio" value="1"  name="is_tds">YES </label>
                                <label style="margin-left: 20px"> <input type="radio" value="0" name="is_tds">No </label>
                                <label style="margin-left: 20px"> <input type="text" value="0" class="form-control tds_amount" name="tds_amount"> </label>
                            </div>
                        </div>


                        <div class="form-group  row"><label class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                                <textarea class="form-control rec"  name="remarks" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <button type="button" class="btn btn-success" id="btn_save_payment_booking">Save</button>
                    </form>
                </div>

                <?php
                if(!isset($condition)) {
                ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer'); } ?>

<script>
    var modalitemid='';
    $(document).on("change",".qty",function(){
        modalitemid=$(this).closest("tr").find(".item_name").val();
        ref=$(this);
        var no_of_stock=parseInt($(this).val());
        var itemID=parseInt($('.item_name').val());
        if(itemID>0) {
            var htmlstr = '<div class="col-sm-3">' +
                '<label class="control-label ">Barcode :</label>  ' +
                '</div>  ' +
                '<div class="col-sm-9" style="padding: 5px;">  ' +
                '<input class="form-control txt_barcode" name="item_barcode[]" type="text">  ' +
                '</div>';
            $("#barcode_listing").html('');
            for (i = 0; i < no_of_stock; i++) {
                $("#barcode_listing").append(htmlstr);
            }
//            itemIDModal=$('.item_name').val()+'barcode_modal';
//            alert(itemIDModal);
            $("#barcode_modal").modal();
        }
    });

    var barcodeary={};
    $("#barcode_modal").on("hidden.bs.modal", function () {
        var str='';
        var item_id=$('.item_name').val();
        barcodeary[modalitemid]={};
        var x=[];
        //x.push(item_id);
        var ctr=0;
        $(document).find(".txt_barcode").each(function(k,v){
            barcodeary[modalitemid][ctr] ={};
                barcodeary[modalitemid][ctr] = $(this).val();
            ctr++;
        });
        //barcodeary[modalitemid].push(x);
        $('#itemsbarcode').val(JSON.stringify(barcodeary));

        //console.log(barcodeary);
    });
</script>

<script>
$(document).on("change",".item_name",function(){
var price=$(this).find("option:selected").attr("price");
 $(this).closest("tr").find("input[name='price[]']").val(price);
    calculate(price);

    var tax=$(this).find("option:selected").attr("tax");
    $(this).closest("tr").find("input[name='tax[]']").val(tax);
});

$(document).on("change",".tax",function(){
    var ref=$(this);
    calculate(ref);
});

$(document).on("change",".qty",function(){
    var ref=$(this);
    calculate(ref);
});

function calculate(ref)
{
    if($(ref).closest("tr").find(".item_name").val()!="")
    {
        var tax=parseFloat($(ref).closest("tr").find(".tax").val());
        var qty=parseFloat($(ref).closest("tr").find(".qty").val());
        var price=parseFloat($(ref).closest("tr").find(".price").val());
        var total=(price*qty)+(((price*qty)*tax)/100);
        if(!isNaN(total))
            $(ref).closest("tr").find(".total").val(total);
        else
            $(ref).closest("tr").find(".total").val("0.00");
    }
    else{
        swal("please select an Item First");
    }
}
</script>

<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
<script type="text/javascript">
    var lastid="";
    $(document).ready(function () {
        $(".select_user").show();
        $(" .item_table, .advance_salary").hide();
        $(".vehicle_no").select2();
    });

    $(".taxable_value, .purchase_tax").change(function(){
        var taxable_value=parseFloat($(".taxable_value").val());
        var tax=parseFloat($(".purchase_tax").val());
        if(!isNaN(taxable_value) && !isNaN(tax))
        {
            var amout=taxable_value+(taxable_value*tax)/100;
            $(".amount").val(amout);
        }
    });

  //  console.log('$("#frm_payment_booking").serialize()');

    $("#btn_save_payment_booking").click(function () {
        var ref=$(this);
        if(validate(ref))
        {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('payment_booking/purchase')?>',
                cache: false,
                async: false,
                data: $("#frm_payment_booking").serialize(),
                success: function (data) {
                    swal({
                        title: "",
                        text: "Record Saved successfully!",
                        type: "success"
                    });
                    lastid=data;
                    $("#frm_payment_booking")[0].reset();
                    $("#extra_address").remove();
                    $('#payment_bookingModal').modal('hide');
                },
                error: function (data) {
                    // alert("error");
                },
                timeout: 5000,
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("","Please check your internet connection.","error");
                },
                beforeSend: function() {
                    $('#loader').show();
                },
                complete: function(){
                    $('#loader').hide();
                }
            });
        }
        else
        {

        }
    });


    $("#receiver_type").change(function(){
        var reftype=$(this).val();
        $(".select_user").hide();
        if(reftype=="1")
        {
            $(".staff_name").show();
        }
        else if(reftype=="2")
        {
            $(".account_name").show();
        }
        else if(reftype=="3")
        {
            $(".transporter_name").show();
        }
        else if(reftype=="4")
        {
            $(".employee_name").show();
        }
    });

    $(document).on("click",".add_new_default",function () {
        var select=$(".item_name:first").html();
        var myvar =   '<tr>';
        myvar +=   '<td><select class="form-control item_name" name="item_id[]">'+select;
    myvar +=    ' </td>  '  +
    '<td><input type="number" class="form-control qty" name="qty[]"></td>'  +
    '<td><input type="number" class="form-control price" name="price[]"></td> '  +
    '<td><input type="number" class="form-control tax" name="tax[]"></td>  '  +
    '<td><input type="number" class="form-control total" name="total[]"></td>  '  +
    '<td><button class="btn btn-info btn-circle add_new_default" type="button" title="Add new"><i class="fa fa-plus"></i>  '  +
    '</button><button class="btn btn-danger btn-circle btn_delete_default" type="button" title="Delete"  style="display: none;"><i class="fa fa-trash"></i>  '  +
    '</button></td>  '  +
    '</tr>  ' ;
        $("#item_table_tbody").append(myvar);
        $(".add_new_default").hide();
        $(".add_new_default:last").show();
        $(".btn_delete_default").show();
        $(".btn_delete_default:last").hide();

    });
    $(document).on("click",".btn_delete_default",function () {
        var ref=$(this);
        swal({
                title: "Are you sure?",
                text: "You want to delete this record!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            },
            function(){
                //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                $(ref).parent().parent().remove();
            });

    });

    $('document').ready(function(){
        $(".item_table").show();
    });

    $(".expense_head").change(function(){
        if($(this).val()=="16")
        {
            $(".item_table").show();
        }
        else if($(this).val()=="26")
        {
            $(".advance_salary").show();
        }
        else
        {
            $(".advance_salary").hide();
        }

        if($(this).val()=="20")
        {
            //loading unloading
            calculateTDS(1.5);

        }
        else if($(this).val()=="18"){
            //Transportation
            calculateTDS(1.5);
        }
        else if($(this).val()=="2")
        {
            //Warehouse Rent
            calculateTDS(7.5);
        }
        else
        {
            $('input[type=radio]:eq(1)').prop("checked",true);
            $(".tds_amount").val("0");
        }

    });
    function calculateTDS(rate)
    {
        var amount=parseInt($(".amount").val());
        if(!isNaN(amount))
        {
            var tds=(amount*rate)/100;
            $(".tds_amount").val(tds);
            $('input[type=radio]:first').prop("checked",true);

        }
        else
            $(".tds_amount").val("0");
    }
    $('input[type=radio]').change(function(){
        if($(this).val()=="0")
            $(".tds_amount").val("0");
        else
        {
            $(".expense_head").trigger("change");
        }
    });
</script>
</body>
</html>
