<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 16/08/2017
 * Time: 14:52
 */
$this->load->view('header');
$this->load->view('left_sidebar');
$this->load->view('topbar');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10"><h2>Pending Barcode Records</h2></div>
    <div class="col-lg-2"></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pending Barcode Records for : <span style="font-size: 25px;"><?=$itemName?></span></h5>
            <div class="ibox-tools">
                <a href="<?=base_url('Barcode/Pending')?>">
                 <button class="btn btn-primary" id="" type="button">View Records</button>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <form method="POST" class="form-horizontal" action="Updatebarcode">
                <?php $ctr=1; foreach($listBarcodes as $res): ?>
                <div class="form-group row" style="border: 0px solid #ddd;">
                    <label class="col-sm-2 control-label">Barcode <?=$ctr?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="barcode_no[]">
                        <input type="hidden" class="form-control" name="barcode_id[]" value="<?=$res['barcode_id']?>">
                        <input type="hidden" class="form-control" name="booking_id[]" value="<?=$res['booking_id']?>">
                        <input type="hidden" class="form-control" name="item_id[]" value="<?=$res['item_id']?>">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php $ctr++; endforeach; ?>

                <button type="submit" class="btn btn-success" id="btn_save_expense_head">Save</button>
            </form>
        </div>
    </div>
</div>
    </div>
</div>
<?php
$this->load->view('footer');
?>
<script src="<?php echo base_url() ?>assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        getrecord();

        $("#btn_addrecord").click(function () {
            //alert("ok");
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('payment_booking/addpopup')?>',
                cache: false,
                async: false,
                data: {popup:'popup'},
                success: function (data) {
                    $("#payment_booking_modal_content").html(data);
                    $("#payment_bookingModal").modal();

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
        });

        $(document).on("click",".btn_editrecord",function () {

            var  refid=$(this).attr('refid');
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('payment_booking/editpopup')?>',
                cache: false,
                async: false,
                data: {popup:'popup',id:refid},
                success: function (data) {
                    $("#payment_booking_modal_content").html(data);
                    $("#payment_bookingModal").modal();

                },
                error: function (data) {
                    // alert("error");
                },
                timeout: 5000,
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("","Please check your internet connection.","error");
                }
            });
        });

        $(document).on("click",".btn_deleterecord",function (e) {
            e.preventDefault();
            var ref=$(this);
            var refid=$(this).attr('refid');
                swal({
                title: "Are you sure?",
                text: "You want to delete this post!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-success',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false
                //closeOnCancel: false
            },
            function(){
               
                $.ajax({
                    type: 'POST',
                   url: '<?php echo site_url('payment_booking/deleterecord')?>',
                    cache: false,
                    data: {delete: refid},
                    success: function (data) {
                        if(data=="true")
                        {
                            ref.closest("tr").hide("slow",function(){ ref.closest("tr").remove(); });
                            swal("Deleted!", "Your record has been deleted!", "success");
                        }
                    },
                    error: function (data) {
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
            });
        });

    });
    function getrecord() {
        $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 1, "desc" ]],
            "ajax": "<?php echo site_url('payment_booking/getrecordpurchase')?>",
            dom: 'ltr<"pull-right"p>',
        });
    }
    $("#payment_bookingModal").on("hidden.bs.modal", function () {
        $('#example').DataTable().ajax.reload(null, false);
    });

//    $(document).on("click",".view_pur",function (e) {
//        e.preventDefault();
//        var ref=$(this);
//        var refid=$(this).attr('refid');
//        swal({
//                title: "Are you sure?",
//                text: "You want to view this Purchase Record !",
//                type: "warning",
//                showCancelButton: true,
//                confirmButtonClass: 'btn-success',
//                cancelButtonClass: 'btn-danger',
//                confirmButtonText: 'Yes, Confirm!',
//                cancelButtonText: 'No, cancel!',
//                closeOnConfirm: false
//                //closeOnCancel: false
//            });
//    });

    $(document).on("click",".btn_accept",function (e) {
        e.preventDefault();
        var ref=$(this);
        var refid=$(this).attr('refid');
        swal({
                title: "Are you sure?",
                text: "You want to accept this payment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-success',
                cancelButtonClass: 'btn-danger',
                confirmButtonText: 'Yes, Confirm!',
                cancelButtonText: 'No, cancel!',
                closeOnConfirm: false
                //closeOnCancel: false
            },
            function(){

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('payment_booking/confirm_booking')?>',
                    cache: false,
                    data: {booking_id: refid},
                    success: function (data) {
                        if(data=="true")
                        {
                            ref.closest("tr").hide("slow",function(){ ref.closest("tr").remove(); });
                            swal("Confirmed!", "Record Moved to Account Section!", "success");
                        }
                    },
                    error: function (data) {
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
            });
    });

</script>
