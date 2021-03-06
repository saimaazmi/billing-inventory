	<!-- Main content-->
	<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-book fa-3x"></i> All Orders
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-inline col-xs-3 no-margin">
                                    <label>Show 
                                        <select name="example_length" class="form-control input-sm" id="rpp" onchange="changerpp()">
                                            <option value="10" <?php if(isset($_COOKIE['rpp']) && ($_COOKIE['rpp'] == 10)) {echo "selected";} ?>>10</option>
                                            <option value="25"<?php if(isset($_COOKIE['rpp']) && ($_COOKIE['rpp'] == 25)) {echo "selected";} ?>>25</option>
                                            <option value="50"<?php if(isset($_COOKIE['rpp']) && ($_COOKIE['rpp'] == 50)) {echo "selected";} ?>>50</option>
                                            <option value="100"<?php if(isset($_COOKIE['rpp']) && ($_COOKIE['rpp'] == 100)) {echo "selected";} ?>>100</option>
                                        </select> entries
                                    </label>
                                </div>
                                <div class="col-xs-9" style="direction: rtl;">
                                    <div class="input-group">
                                    	<a class="btn btn-outline btn-success" href="./?fl=ordr_crt_new"> <i class="fa fa-plus"></i> New Order</a> 
                                    </div>
                                </div>
                            </div>

                            <div class="v-spacing-xs"></div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Date </th>
                                            <th> Customer </th>
                                            <th> Products </th>
                                            <th> Amount </th>
                                            <th style="width: 15%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            for($i=0;$i<count(getOrdrLst());$i++)
                                            {
                                                echo '<tr style="font-size: small;">';
                                                echo '<td>Order#'.getOrdrLst()[$i]['cstmid'].'/'.getOrdrLst()[$i]['id'].'</td>';
                                                echo '<td>'.getOrdrLst()[$i]['date'].'</td>';
                                                echo '<td>'.getCstmDtl(getOrdrLst()[$i]['cstmid'])['name'].'<br>'.getCstmDtl(getOrdrLst()[$i]['cstmid'])['city'].'['.getCstmDtl(getOrdrLst()[$i]['cstmid'])['phone'].']</td>';
                                                echo '<td style="font-size: small;">';
                                                for($j = 0; $j < count(getOrdrItems(getOrdrLst()[$i]['id'])); $j++)
                                                {
                                                    echo ($j + 1) .'. '.getOrdrItems(getOrdrLst()[$i]['id'])[$j]['qty_b'].' X '.getProdDtl(getOrdrItems(getOrdrLst()[$i]['id'])[$j]['pid'])['name'].' - '.getProdDtl(getOrdrItems(getOrdrLst()[$i]['id'])[$j]['pid'])['pckg'];
                                                    echo '<br>';
                                                }
                                                echo '</td>';
                                                echo '<td>';
                                                echo 'Sub-total :'.getOrdrLst()[$i]['subtotal'];
                                                echo '<br>';
                                                echo 'Total Tax :'.getOrdrLst()[$i]['totaltax'];
                                                echo '<br>';
                                                echo 'Total Amount :'.getOrdrLst()[$i]['totalamt'];
                                                echo '</td>';
                                                echo '<td style="width: 15%;">';
                                                echo '<a class="btn btn-xs btn-outline btn-success" href="./ordr_prn.php?ordrid='.getOrdrLst()[$i]['id'].'" target="_blank"><i class="fa fa-print"></i> Bill </a>';
                                                echo '&nbsp;&nbsp;&nbsp;';
                                                echo '<a onclick="return confirm(\'DELETE action is IRREVERSIBLE, confirm to delete?\')" class="btn btn-xs btn-outline btn-danger" href="./adminfunctions.php?func=ordrdel&amp;ordrid='.getOrdrLst()[$i]['id'].'"><i class="fa fa-times"></i> Delete </a>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pull-right">
                                <li><a>Pages</a></li>
                                <?php
                                    for($i=1;$i<=getOrdrPgs();$i++)
                                    {
                                        if((isset($_GET['pgno'])) && ($i == $_GET['pgno']))
                                        {
                                            echo '<li class="active"><a href="./?fl=ordr_lst&pgno='.$i.'">'.$i.'</a></li>';
                                        }
                                        elseif((!isset($_GET['pgno'])) && ($i == 1))
                                        {
                                            echo '<li class="active"><a href="./?fl=ordr_lst&pgno='.$i.'">'.$i.'</a></li>';
                                        }
                                        else
                                        {
                                            echo '<li><a href="./?fl=ordr_lst&pgno='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
<script>

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var user=getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
       user = prompt("Please enter your name:","");
       if (user != "" && user != null) {
           setCookie("username", user, 30);
       }
    }
}

function changerpp()
{
    d = document.getElementById("rpp").value;
    setCookie('rpp',d,1);
    window.location.assign("./?fl=prod_lst");
}

</script>