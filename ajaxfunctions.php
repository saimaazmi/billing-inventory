<?php
//var_dump(intval($_POST['prodid']));exit();
	/* ORDER management functions START */

		//get existing customer details
		function getExstCstmDtl()
		{
			include './config.php';

			$cstmid = intval($_POST['cstmid']);
			if($cstmid > 0)
			{
				$function_qry1 = "SELECT * FROM bc_customers WHERE customer_id = ".$cstmid;
				$function_rlt1 = mysqli_query($con, $function_qry1);
				if(mysqli_num_rows($function_rlt1) == 1)
				{
					$function_row1 = mysqli_fetch_array($function_rlt1);
					$customer = array();
					$customer['id'] = $function_row1['customer_id'];
					$customer['name'] = $function_row1['cstm_name'];
					$customer['addr'] = $function_row1['cstm_addr'];
					$customer['city'] = $function_row1['cstm_city'];
					$customer['phone'] = $function_row1['cstm_phone'];

					$function_qry2 = "SELECT * FROM bc_cstmdisc WHERE customer_id = ".$cstmid;
					$function_rlt2 = mysqli_query($con, $function_qry2);
					if(mysqli_num_rows($function_rlt2) == 1)
					{
						$function_row2 = mysqli_fetch_array($function_rlt2);
						$customer['whp'] = $function_row2['whp'];
					}
					else
					{
						$customer['whp'] = 0;
					}
					
					echo json_encode($customer);
				}
				else
				{
					echo 0;
				}
			}
			else
			{
				echo 0;
			}
		}

		//get existing product detail
		function getExstProdDtl()
		{
			include './config.php';
			$prodid = intval($_POST['prodid']);
			if($prodid > 0)
			{
				$function_qry1 = "SELECT * FROM bc_products WHERE product_id = ".$prodid;
				$function_rlt1 = mysqli_query($con, $function_qry1);
				if(mysqli_num_rows($function_rlt1) == 1)
				{
					$function_row1 = mysqli_fetch_array($function_rlt1);
					$product = array();
					$product['id'] = $function_row1['product_id'];
					$product['name'] = $function_row1['prd_name'];
					$product['mfctr'] = $function_row1['prd_mfctr'];
					$product['pckg'] = $function_row1['prd_pkg'];
					$product['price'] = $function_row1['prd_mrp'];
					$product['stkqty'] = $function_row1['prd_qty'];

					$prod_taxes = array();
					$function_qry2 = "SELECT * FROM bc_prodtax WHERE product_id = ".$prodid;
					$function_rlt2 = mysqli_query($con, $function_qry2);
					while($function_row2 = mysqli_fetch_array($function_rlt2))
					{
						$tax = array();
						$tax['name'] = $function_row2['tax_name'];
						$tax['percent'] = $function_row2['tax_percent'];
						array_push($prod_taxes, $tax);
					}

					$product['taxes'] = $prod_taxes;
					echo json_encode($product);
				}
				else
				{
					echo 1;
				}
			}
			else
			{
				echo 2;
			}
		}
	/* ORDER management functions END */

	//execute the function if called and exists
	if(isset($_GET['func']) && function_exists($_GET['func']))
	{
		$run_function = $_GET['func'];
		$run_function();
	}
?>