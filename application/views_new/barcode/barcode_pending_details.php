<?php
$this->load->view('header');
$this->load->view('left_sidebar');
$this->load->view('topbar');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Items/ Barcode Pending</h2>
    </div>
    <div class="col-lg-2"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
<div class="col-lg-12">
    <?php if($responce = $this->session->flashdata('update')): ?>
        <div class="box-header">
            <div class="col-lg-12">
                <div class="alert alert-success">
                    <?= $this->session->set_flashdata('sucessupdate').'Successfully Added !'?>
                    <?= $this->session->set_flashdata('failupdate').'Due to Not Unique, Skipeed !'?>
                    </br>
                    <?php echo $responce;?></div>
            </div>
        </div>
    <?php endif;?>

    <?php if($responce = $this->session->flashdata('error')): ?>
        <div class="box-header">
            <div class="col-lg-12">
                <div class="alert alert-danger"><?php echo $responce;?></div>
            </div>
        </div>
    <?php endif; ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Items Pending Barcode Records</h5>
            <div class="ibox-tools">
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

        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover dataTables-example" id="example">
                <thead>
                <tr role="row">
                    <th>Sl.</th>
                    <th>Item Name</th>
                    <th>Pending Barcodes(In Nos.)</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
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
    });
    function getrecord() {
        $('#example').DataTable( {
            responsive: true,
            "processing": true,
            "serverSide": true,
            "order": [[ 1, "asc" ]],
            "ajax": "<?php echo site_url('Barcode/getrecordbarcodependingitems')?>",
            dom: '<"html5buttons"B>lTfgitr<"pull-right"p>',
             "tableTools": {
                "sSwfPath": "<?php echo base_url() ?>assets/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            },
               buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Barcode Pending Data Record'},
                    {extend: 'pdf', title: 'Barcode Pending Data Record'},
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '12px');
                            $(win.document.body).find('table')
                             .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                    }
                ]

            });
    }
    $("#expense_headModal").on("hidden.bs.modal", function () {
        $(".pagination .active").click();
    });
</script>
