

    <!-- Main content-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-4">
                    <div class="panel panel-success">
                            <div class="panel-heading">
                                Address
                            </div>
                        <form action="./adminfunctions.php?func=updateaddr" method="post">
                            <div class="panel-body">
                                <div class="form-group col-sm-12">
                                    <label for="address">Business Address:</label>
                                    <textarea class="form-control" name="addr"><?php echo getAddr(); ?></textarea>
                                </div>
                            </div>
                            <div class="panel-body">
                                <button type="submit" class="btn btn-success">Update Address</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel panel-info">
                            <div class="panel-heading">
                                Manage Taxes
                            </div>
                        <form action="./adminfunctions.php?func=updatetax" method="post">
                            <div class="panel-body">
                                <?php
                                if(getTaxes())
                                {
                                    for($i=0;$i<count(getTaxes());$i++)
                                    {
                                        echo '<div class="form-group col-sm-12">';
                                            echo '<label for="taxtype">Tax Type:</label>';
                                            echo '<input type="text" class="form-control" name="taxtype[]" value="'.getTaxes()[$i]['name'].'">';
                                        echo '</div>';
                                    }
                                }
                                ?>
                                <div class="form-group col-sm-12">
                                    <label for="taxtype">Tax Type:</label>
                                    <input type="text" class="form-control" name="taxtype[]">
                                </div>
                            </div>
                            <div class="panel-body">
                                <button type="submit" class="btn btn-info">Update Tax</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Change Password
                        </div>
                        <div class="panel-body">
                            <form action="./adminfunctions.php?func=updatepswd" method="post">
                                <div class="form-group">
                                    <label for="oldpassword">Old Padssword:</label>
                                    <input type="password" class="form-control" name="oldpswd">
                                </div>
                                <div class="form-group">
                                    <label for="newpassword">New Password:</label>
                                    <input type="password" class="form-control" name="newpswd">
                                </div>
                                <div class="form-group">
                                    <label for="cnfpassword">Confirm New Password:</label>
                                    <input type="password" class="form-control" name="cnfpswd">
                                </div>
                                <button type="submit" class="btn btn-danger">Change & Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
    <!-- End of Main content-->