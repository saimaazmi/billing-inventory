	<!-- Main content-->
	<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-3x"></i> CUSTOMERS <i class="fa fa-chevron-right"></i> Add New
                        </div>
                        <div class="panel-body">
                            <div class="form-wrapper col-sm-12">
                                <form method="post" action="./adminfunctions.php?func=savecstm" enctype="multipart/form-data" id="cstm_form">
                                    <div class="form-wrapper col-sm-12">
                                        <label for="CustomerName">Customer Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cstm_name" id="cstm_name" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-12">
                                        <label for="Address">Address</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cstm_addr" id="cstm_addr" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-4">
                                        <label for="City">City</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cstm_city" id="cstm_city" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-4">
                                        <label for="Phone">Phone</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="cstm_phone" id="cstm_phone" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-4">
                                        <label for="WholeSale">WholeSale Price Reduction (%)</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="cstm_whp" id="cstm_whp" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="direction: rtl;">
                                        <div class="input-group">
                                            <a class="btn btn-outline btn-success" onclick="savecstm()"> <i class="fa fa-check"></i> Save Customer</a> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
    <script type="text/javascript">
        function savecstm()
        {
            document.getElementById("cstm_form").submit();
        }
    </script>