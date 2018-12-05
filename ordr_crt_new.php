    <!-- Main content-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="fa fa-book fa-3x"></i> ORDERS <i class="fa fa-chevron-right"></i> New Order
                        </div>
                        <div class="panel-body">
                            <div class="form-wrapper col-sm-12">
                                <form method="post" action="" enctype="multipart/form-data" id="ordr_form">
                                    <div class="form-wrapper col-sm-12">
                                        <label for="CustomerSelect">Select Customer</label>
                                        <div class="form-group">
                                            <select id="cstm_type" name="cstm_type" onchange="getCstmDtl()">
                                                <option value="0">New Customer</option>
                                                <?php
                                                    for($i=0;$i<count(getExstCstm());$i++)
                                                    {
                                                        echo '<option value="'.getExstCstm()[$i]['id'].'">'.getExstCstm()[$i]['name'].'-'.getExstCstm()[$i]['city'].' ('.getExstCstm()[$i]['phone'].')</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="Name">Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cstm_name" id="cstm_name" placeholder="" readonly>
                                            <input type="hidden" class="form-control" name="cstm_id" id="cstm_id" placeholder="">
                                            <input type="hidden" class="form-control" name="cstm_whp" id="cstm_whp" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="Phone">Phone</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="cstm_phone" id="cstm_phone" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="Address">Address</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cstm_addr" id="cstm_addr" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-wrapper col-sm-6">
                                        <label for="City">City</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cstm_city" id="cstm_city" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="well form-wrapper col-sm-12" style="overflow-x: scroll;">
                                        <table class="table table-condensed">
                                            <tbody id="prod_table">
                                                <tr style="font-size: x-small;">
                                                    <th>
                                                        Desc.
                                                    </th>
                                                    <th>
                                                        Bat./Exp.
                                                    </th>
                                                    <th>
                                                        Price
                                                    </th>
                                                    <th>
                                                        Whls. Price
                                                    </th>
                                                    <th>
                                                        Qty.
                                                    </th>
                                                    <th>
                                                        Free
                                                    </th>
                                                    <th>
                                                        Dis1
                                                    </th>
                                                    <th>
                                                        Dis2
                                                    </th>
                                                    <th>
                                                        Tax
                                                    </th>
                                                    <th>
                                                        Gross Amt
                                                    </th>
                                                    <th>
                                                        
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <label for="ProductSelect" id="selectprodname">Select Product</label>
                                        <div class="form-group" id="selectprodcntnr">
                                            <select id="prod_dtl" name="prod_dtl">
                                                <?php
                                                    for($i=0;$i<count(getExstProd());$i++)
                                                    {
                                                        echo '<option value="'.getExstProd()[$i]['id'].'">'.getExstProd()[$i]['name'].'-'.getExstProd()[$i]['pckg'].' (Rs.'.getExstProd()[$i]['price'].')</option>';
                                                    }
                                                ?>
                                            </select> &nbsp;&nbsp;&nbsp; <a class="btn btn-xs btn-outline btn-success"onclick="addProd()"><i class="fa fa-cart-plus"></i> Add Product </a> &nbsp;&nbsp;&nbsp; <a class="btn btn-xs btn-outline btn-danger"onclick="calculate()"><i class="fa fa-calculator"></i> Calculate </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="direction: rtl;" id="div-btn-sve">
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
        function saveorder()
        {
            var inputs = document.querySelectorAll("input");
            var form = document.createElement("form");
            form.setAttribute('method',"post");
            form.setAttribute('action',"./adminfunctions.php?func=saveordr");
            for(var inp = 0; inp < inputs.length; inp++)
            {
                var forminput = document.createElement("input");
                forminput.setAttribute('type',"hidden");
                forminput.setAttribute('name',inputs[inp].name);
                forminput.setAttribute('value',inputs[inp].value);
                form.appendChild(forminput);
            }
            document.getElementsByTagName('body')[0].appendChild(form);
            form.submit();
        }
        function getCstmDtl()
        {
            var cstmid = document.getElementById("cstm_type").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange=function() {
                if(this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);
                    if(this.responseText != '0')
                    {
                        document.getElementById("cstm_id").value = cstmid;
                        document.getElementById("cstm_name").value = obj.name;
                        document.getElementById("cstm_addr").value = obj.addr;
                        document.getElementById("cstm_city").value = obj.city;
                        document.getElementById("cstm_phone").value = obj.phone;
                        document.getElementById("cstm_whp").value = obj.whp;
                    }
                    else
                    {
                        document.getElementById("cstm_id").value = cstmid;
                        document.getElementById("cstm_name").value = '';
                        document.getElementById("cstm_addr").value = '';
                        document.getElementById("cstm_city").value = '';
                        document.getElementById("cstm_phone").value = '';
                        document.getElementById("cstm_whp").value = 0;
                    }
                }
            }
            xhttp.open("POST", "./ajaxfunctions.php?func=getExstCstmDtl&cstmid="+cstmid, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("cstmid="+cstmid);
        }
        function addProd()
        {
            if(document.getElementById("cstm_type").value < 1)
            {
                alert('Please select Customer');
                return 0;
            }
            var prodid = document.getElementById("prod_dtl").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange=function() {
                if(this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);
                    console.log(this.responseText);
                    if(this.responseText != '0')
                    {
                        var rows = document.getElementById("prod_table").getElementsByTagName("tr").length;
                        var whp_prcnt = document.getElementById("cstm_whp").value;
                        var prod_id = obj.id;
                        var prod_name = obj.name;
                        var prod_mfctr = obj.mfctr;
                        var prod_pckg = obj.pckg;
                        var prod_price = obj.price;
                        var prod_stkqty = obj.stkqty;
                        var prod_taxes = obj.taxes;

                        var tax_str = '';
                        var taxprcnt = 0;
                        for(var i = 0; i < prod_taxes.length; i++)
                        {
                            if(tax_str == '')
                            {
                                tax_str = prod_taxes[i].name + ' : ' + prod_taxes[i].percent+ '%';
                            }
                            else
                            {
                                tax_str = tax_str + '<br>' +  prod_taxes[i].name + ' : ' + prod_taxes[i].percent+ '%';
                            }
                            taxprcnt = taxprcnt + parseFloat(prod_taxes[i].percent);                         
                        }
                        tax_str = tax_str + '<input type="hidden" name="tax[]" value="'+taxprcnt+'">';

                        var cstm_whp = (prod_price - (prod_price * (whp_prcnt/100))).toFixed(2);
                        var prod_desc = prod_name +' : '+prod_pckg+'<br>['+prod_mfctr+']<input type="hidden" name="prod_id[]" value="'+prod_id+'">';
                        var addrow = '<tr style="font-size: x-small;"><td style="font-size: x-small;">'+prod_desc+'</td><td><input type="text" name="prod[\'exp\'][]" size="10"></td><td>'+prod_price+'</td><td><input type="text" name="prod[\'whp\'][]" step="0.01" size="4" value="'+cstm_whp+'" readonly></td><td><input type="text" name="prod[\'qty\'][]" size="4" value="1"></td><td><input type="text" name="prod[\'free\'][]" size="4" value="0"></td><td><input type="text" name="prod[\'dsc1\'][]" step="0.01" size="4">%</td><td><input type="text" name="prod[\'dsc2\'][]" step="0.01" size="4">%</td><td style="font-size:xx-small">'+tax_str+'</td><td></td><td><a class="btn btn-xs btn-outline btn-warning"onclick="delProd(this)"><i class="fa fa-times"></i> </a></td></tr>';
                        document.getElementById("prod_table").innerHTML = document.getElementById("prod_table").innerHTML + addrow;
                    }
                }
            }
            xhttp.open("POST", "./ajaxfunctions.php?func=getExstProdDtl&prodid="+prodid, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("prodid="+prodid);
            document.getElementById("cstm_type").disabled = true;
        }
        function delProd(x) {
            x.parentElement.parentElement.parentElement.deleteRow(x.parentElement.parentElement.rowIndex);
        }
        function calculate()
        {
            var rows = document.getElementById("prod_table").getElementsByTagName("tr");
            table = document.getElementById("prod_table");
            var distotal = 0;
            var subtotal = 0;
            var taxtotal = 0;
            var grosstotal = 0;

            for(i=1;i<rows.length;i++)
            {
                var columns = rows[i].getElementsByTagName("td");
                var batch = columns[1].getElementsByTagName("input")[0].value;
                var price = parseFloat(columns[2].innerHTML);
                var whp = parseFloat(columns[3].getElementsByTagName("input")[0].value);
                var qty = parseInt(columns[4].getElementsByTagName("input")[0].value);
                var free = parseInt(columns[5].getElementsByTagName("input")[0].value);
                var dis1 = parseFloat(columns[6].getElementsByTagName("input")[0].value);
                var dis2 = parseFloat(columns[7].getElementsByTagName("input")[0].value);
                var tax_str = columns[8].innerHTML;
                var taxprcnt = parseFloat(columns[8].getElementsByTagName("input")[0].value);
                if(whp < 0)
                {
                    whp = price;
                }
                if(isNaN(qty))
                {
                    qty = 1;
                }
                if(isNaN(free))
                {
                    free = 0;
                }
                if(isNaN(dis1))
                {
                    dis1 = 0;
                }
                if(isNaN(dis2))
                {
                    dis2 = 0;
                }
                if((dis1 + dis2) < 100)
                {
                    tdis = dis1 + dis2;
                }

                amt = whp * qty;
                subtotal = subtotal + amt;
                disamt = amt * (tdis/100);
                distotal = distotal + disamt;
                taxamt = (amt - disamt) * (taxprcnt/100);
                taxtotal = taxtotal + taxamt;
                grossamt = (amt - disamt + taxamt);
                grosstotal = grosstotal + grossamt;
                columns[1].innerHTML = batch+'<input type="hidden" name="batch[]" value="'+batch+'">';
                columns[2].innerHTML = price+'<input type="hidden" name="price[]" value="'+price+'">';
                columns[3].innerHTML = whp+'<input type="hidden" name="whp[]" value="'+whp+'">';
                columns[4].innerHTML = qty+'<input type="hidden" name="qty[]" value="'+qty+'">';
                columns[5].innerHTML = free+'<input type="hidden" name="free[]" value="'+free+'">';
                columns[6].innerHTML = dis1+'%'+'<input type="hidden" name="dis1[]" value="'+dis1+'">';
                columns[7].innerHTML = dis2+'%'+'<input type="hidden" name="dis2[]" value="'+dis2+'">';
                columns[8].innerHTML = tax_str;
                columns[9].innerHTML = grossamt.toFixed(2);
                columns[10].innerHTML = '';
            }

            rows = document.getElementById("prod_table").getElementsByTagName("tr");
            var row = table.insertRow(rows.length);
            for(i=0;i<11;i++)
            {
                var cell = row.insertCell(i);
                if(i == 8)
                {
                    cell.innerHTML = 'Subtotal :';
                    cell.innerHTML = cell.innerHTML + '<br>' + 'Tot. Disc :';
                    cell.innerHTML = cell.innerHTML + '<br>' + 'Tot. TAX :';
                    cell.innerHTML = cell.innerHTML + '<br>' + 'Tot. Amount :';
                }
                if(i == 9)
                {
                    cell.innerHTML = subtotal.toFixed(2);
                    cell.innerHTML = cell.innerHTML + '<br>' + distotal.toFixed(2);
                    cell.innerHTML = cell.innerHTML + '<br>' + taxtotal.toFixed(2);
                    cell.innerHTML = cell.innerHTML + '<br>' + grosstotal.toFixed(2);
                }
            }

            document.getElementById("selectprodname").innerHTML = "";
            document.getElementById("selectprodcntnr").innerHTML = "";
            document.getElementById("div-btn-sve").innerHTML = '<div class="input-group"><a class="btn btn-outline btn-success" onclick="saveorder()"> <i class="fa fa-calendar-check-o"></i> Confirm Order</a> </div>';
        }
    </script>