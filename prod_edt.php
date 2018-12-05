	<?php
        $prodid = intval($_GET['prodid']);
    ?>
    <!-- Main content-->
	<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-medkit fa-3x"></i> PRODUCTS <i class="fa fa-chevron-right"></i> Edit/Change Product
                        </div>
                        <div class="panel-body">
                            <div class="form-wrapper col-sm-12">
                                <form method="post" action="./adminfunctions.php?func=updateprod" enctype="multipart/form-data" id="prod_form">
                                <input type="hidden" name="prod_id" value="<?php echo getProdDtl($prodid)['id']; ?>">
                                    <div class="form-wrapper col-sm-12">
                                        <label for="ProductName">Product Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="prod_name" id="prod_name" placeholder="" value="<?php echo getProdDtl($prodid)['name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="ProductMfctr">Manufacturer</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="mfctr_name" id="mfctr_name" placeholder="" value="<?php echo getProdDtl($prodid)['mfctr']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="ProductPckg">Package</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="prod_pckg" id="prod_pckg" placeholder="" value="<?php echo getProdDtl($prodid)['pckg']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="ProductMrp">Price</label>
                                        <div class="form-group">
                                            <input type="number" step="0.01" class="form-control" name="prod_mrp" id="prod_mrp" placeholder="" value="<?php echo getProdDtl($prodid)['price']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="ProductQty">Stock Quantity</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="stck_qty" id="stck_qty" placeholder="" value="<?php echo getProdDtl($prodid)['stkqty']; ?>">
                                        </div>
                                    </div>
                                    <?php
                                        if(getTaxes())
                                        {
                                            for($i = 0; $i < count(getProdTaxes($prodid)); $i++)
                                            {
                                                echo '<div class="form-wrapper col-sm-4">';
                                                    echo '<label for="ProductTax">'.getProdTaxes($prodid)[$i]['name'].' %</label>';
                                                    echo '<div class="form-group">';
                                                        echo '<input type="number" class="form-control" name="prod_tax[]" value="'.getProdTaxes($prodid)[$i]['percent'].'">';
                                                        echo '<input type="hidden" class="form-control" name="prod_tax_name[]" value="'.getProdTaxes($prodid)[$i]['name'].'">';
                                                    echo '</div>';
                                                echo '</div>';
                                            }
                                        }
                                    ?>
                                    <div class="col-xs-12" style="direction: rtl;">
                                        <div class="input-group">
                                            <a class="btn btn-outline btn-success" onclick="updateprod()"> <i class="fa fa-check"></i> Update Product</a> 
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
        function updateprod()
        {
            document.getElementById("prod_form").submit();
        }
    </script>