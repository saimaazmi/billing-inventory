<?php
/* Functions Without HTML Output START */
	
	/* User Login and Security Functions START */
		//check if user is logged in or not
		function checkUsrLogin()
		{
			include './config.php';
			if(!isset($_SESSION['usr_id']) || ($_SESSION['usr_id'] < 1))
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		
		//verify user credentials
		function verifyUsrLogin($passwd)
		{
			include './config.php';
			$function_qry1 = "SELECT keyvalue FROM bc_settings WHERE keyname = 'password'";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			$function_row1 = mysqli_fetch_array($function_rlt1);

			if(md5($passwd) == $function_row1['keyvalue'])
			{
				$_SESSION['usr_id'] = 1;
				return 1;
			}
			else
			{
				return 0;
			}
		}

		//logout and destroy the user session
		function adminLogout()
		{
			session_destroy();
			return 0;
		}
	/* User Login and Security Functions END */

	/* Dashboard Functions START */
		//get total sales amount for the current month
		function getCrrMnthSls()
		{
			include './config.php';
			$slsamt = 0;
			$function_qry1 = "SELECT SUM(totalamt) AS totsales FROM bc_orders WHERE MONTH(stmp) = MONTH(CURDATE())";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			$function_row1 = mysqli_fetch_array($function_rlt1);
			$slsamt = $function_row1['totsales'];
			return $slsamt;
		}

		//get total sales amount for the previous month
		function getPrvMnthSls()
		{
			include './config.php';
			$slsamt = 0;
			$function_qry1 = "SELECT SUM(totalamt) AS totsales FROM bc_orders WHERE MONTH(stmp) = MONTH(CURDATE()  - INTERVAL 1 MONTH)";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			$function_row1 = mysqli_fetch_array($function_rlt1);
			$slsamt = $function_row1['totsales'];
			return $slsamt;
		}

		//get products low on stock
		function getLowStock()
		{
			include './config.php';
			$lowstock = array();

			$function_qry1 = "SELECT product_id FROM bc_products WHERE prd_qty < 100";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) > 0)
			{
				while($function_row1 = mysqli_fetch_array($function_rlt1))
				{
					array_push($lowstock, $function_row1['product_id']);
				}
			}
			return $lowstock;
		}

		//get valuable customers
		function getValCstm()
		{
			include './config.php';
			$valcstm = array();

			$function_qry1 = "SELECT SUM(bc_orders.totalamt), bc_orders.* FROM bc_orders GROUP By customer_id ORDER BY SUM(bc_orders.totalamt) DESC LIMIT 0, 5";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			while($function_row1 = mysqli_fetch_array($function_rlt1))
			{
				array_push($valcstm, $function_row1['customer_id']);
			}
			return $valcstm;
		}

		//get valuable products
		function getValProd()
		{
			include './config.php';
			$valprod = array();

			$function_qry1 = "SELECT product_id, SUM(amount) AS amt, SUM(qty_billed) AS qty FROM bc_orditems GROUP BY product_id ORDER BY SUM(amount) DESC LIMIT 0, 5";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			while($function_row1 = mysqli_fetch_array($function_rlt1))
			{
				$product['id'] = $function_row1['product_id'];
				$product['qty'] = $function_row1['qty'];
				$product['amt'] = $function_row1['amt'];
				array_push($valprod, $product);
			}
			return $valprod;
		}
	/* Dashboard Functions END */

	/* Product Management Functions START */
		//get product details from product ID
		function getProdDtl($prodid)
		{
			include 'config.php';
			$prod_dtl = array();
			$function_qry1 = "SELECT * FROM bc_products WHERE product_id = ".$prodid;
			if(mysqli_query($con, $function_qry1))
			{
				$function_rlt1 = mysqli_query($con, $function_qry1);
				$function_row1 = mysqli_fetch_array($function_rlt1);
				$prod_dtl['id'] = $function_row1['product_id'];
				$prod_dtl['name'] = $function_row1['prd_name'];
				$prod_dtl['mfctr'] = $function_row1['prd_mfctr'];
				$prod_dtl['pckg'] = $function_row1['prd_pkg'];
				$prod_dtl['price'] = $function_row1['prd_mrp'];
				$prod_dtl['stkqty'] = $function_row1['prd_qty'];
				$function_qry2 = "SELECT * FROM bc_prodtax WHERE product_id = ".$prodid;
				if(mysqli_query($con, $function_qry2))
				{
					$taxes = array();
					$function_rlt2 = mysqli_query($con, $function_qry2);
					while($function_row2 = mysqli_fetch_array($function_rlt2))
					{
						$tax = array();
						$tax['name'] = $function_row2['tax_name'];
						$tax['percent'] = $function_row2['tax_percent'];
						array_push($taxes, $tax);
					}
					$prod_dtl['taxes'] = $taxes;
				}
				return $prod_dtl;
			}
			else
			{
				return 0;
			}
		}

		//get taxes appliable on the product
		function getProdTaxes($prodid)
		{
			include './config.php';
			$prod_taxes = array();

			for($i = 0; $i < count(getTaxes()); $i++)
			{
				$tax = array();
				$tax['name'] = getTaxes()[$i]['name'];
				$function_qry1 = "SELECT * FROM bc_prodtax WHERE tax_name = '".$tax['name']."' AND product_id = ".$prodid;
				if(mysqli_query($con, $function_qry1))
				{
					$function_rlt1 = mysqli_query($con, $function_qry1);
					$function_row1 = mysqli_fetch_array($function_rlt1);
					$tax['percent'] = $function_row1['tax_percent'];
				}
				else
				{
					$tax['percent'] = 0;
				}
				array_push($prod_taxes, $tax);
			}
			return $prod_taxes;
		}

		//get list of existing products
		function getProdLst()
		{
			include './config.php';
			$prod_array = array();
			if(isset($_COOKIE['rpp']))
			{
				$rpp = $_COOKIE['rpp'];
			}
			else
			{
				$rpp = 10;
			}
			if(isset($_GET['pgno']))
			{
				$pgno = $_GET['pgno'];
			}
			else
			{
				$pgno = 1;
			}
			$function_qry1 = "SELECT * FROM bc_products ORDER BY prd_name LIMIT ".(($pgno*$rpp) - $rpp).", ".$rpp;
			$function_rlt1 = mysqli_query($con, $function_qry1);
			while($function_row1 = mysqli_fetch_array($function_rlt1))
			{
				$product = array();
				$product['id'] = $function_row1['product_id'];
				$product['name'] = $function_row1['prd_name'];
				$product['mfctr'] = $function_row1['prd_mfctr'];
				$product['pckg'] = $function_row1['prd_pkg'];
				$product['mrp'] = $function_row1['prd_mrp'];
				$product['stkqty'] = $function_row1['prd_qty'];
				array_push($prod_array, $product);
			}
			return $prod_array;
		}

		//get no of pages required for listing products
		function getProdPgs()
		{
			$prod_pages = 1;
			include './config.php';
			if(isset($_COOKIE['rpp']))
			{
				$rpp = $_COOKIE['rpp'];
			}
			else
			{
				$rpp = 10;
			}

			$function_qry1 = "SELECT COUNT(*) AS totalprod FROM bc_products";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			$function_row1 = mysqli_fetch_array($function_rlt1);
			$prod_pages = $function_row1['totalprod'];
			return (intval($prod_pages/$rpp) + 1);
		}
	/* Product Management Functions END */

	/* ORDER Management Functions START */
		//get order details
		function getOrdrDtl($orderid)
		{
			include './config.php';
			$orddtl = array();

			$function_qry1 = "SELECT * FROM bc_orders WHERE order_id = ".$orderid;
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) == 1)
			{
				$function_row1 = mysqli_fetch_array($function_rlt1);
				$orddtl['id'] = $function_row1['order_id'];
				$orddtl['cstmid'] = $function_row1['customer_id'];
				$orddtl['date'] = $function_row1['ordr_date'];
				$orddtl['subtotal'] = $function_row1['subtotal'];
				$orddtl['totaldis'] = $function_row1['distotal'];
				$orddtl['totaltax'] = $function_row1['tot_tax'];
				$orddtl['totalamt'] = $function_row1['totalamt'];
				return $orddtl;
			}
			else
			{
				return 0;
			}
		}

		//get order taxes
		function getOrdrTax($orderid)
		{
			include './config.php';
			$ordtax = array();

			$function_qry1 = "SELECT * FROM bc_ordtaxes WHERE order_id = ".$orderid;
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) > 0)
			{
				while($function_row1 = mysqli_fetch_array($function_rlt1))
				{
					$tax = array();
					$tax['name'] = $function_row1['tax_name'];
					$tax['percent'] = $function_row1['tax_prcnt'];
					$tax['amount'] = $function_row1['tax_amt'];
					array_push($ordtax, $tax);
				}
				return $ordtax;
			}
			else
			{
				return 0;
			}
		}

		//get order product taxes
		function getOrdrProdTax($orderid, $prodid)
		{
			include './config.php';
			$ordprodtax = array();

			$function_qry1 = "SELECT * FROM bc_ordtaxes WHERE order_id = ".$orderid." AND product_id = ".$prodid;
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) > 0)
			{
				while($function_row1 = mysqli_fetch_array($function_rlt1))
				{
					$tax = array();
					$tax['name'] = $function_row1['tax_name'];
					$tax['percent'] = $function_row1['tax_prcnt'];
					$tax['amount'] = $function_row1['tax_amt'];
					array_push($ordprodtax, $tax);
				}
				return $ordprodtax;
			}
			else
			{
				return 0;
			}
		}

		//get all orders
		function getOrdrLst()
		{
			include './config.php';
			$order_array = array();
			if(isset($_COOKIE['rpp']))
			{
				$rpp = $_COOKIE['rpp'];
			}
			else
			{
				$rpp = 10;
			}
			if(isset($_GET['pgno']))
			{
				$pgno = $_GET['pgno'];
			}
			else
			{
				$pgno = 1;
			}

			$function_qry1 = "SELECT * FROM bc_orders ORDER BY order_id DESC LIMIT ".(($pgno*$rpp) - $rpp).", ".$rpp;
			if(mysqli_query($con, $function_qry1))
			{
				$function_rlt1 = mysqli_query($con, $function_qry1);
				while($function_row1 = mysqli_fetch_array($function_rlt1))
				{
					$order = array();
					$order['id'] = $function_row1['order_id'];
					$order['cstmid'] = $function_row1['customer_id'];
					$order['date'] = $function_row1['ordr_date'];
					$order['subtotal'] = $function_row1['subtotal'];
					$order['totaltax'] = $function_row1['tot_tax'];
					$order['totalamt'] = $function_row1['totalamt'];
					array_push($order_array, $order);
				}
				return $order_array;
			}
			else
			{
				return 0;
			}
		}

		//get no of pages required for listing orders
		function getOrdrItems($orderid)
		{
			$item_array = array();
			include './config.php';

			$function_qry1 = "SELECT * FROM bc_orditems WHERE order_id = ".$orderid;
			if(mysqli_query($con, $function_qry1))
			{
				$function_rlt1 = mysqli_query($con, $function_qry1);
				while($function_row1 = mysqli_fetch_array($function_rlt1))
				{
					$item = array();
					$item['id'] = $function_row1['item_id'];
					$item['pid'] = $function_row1['product_id'];
					$item['exp'] = $function_row1['expiry'];
					$item['qty_b'] = $function_row1['qty_billed'];
					$item['qty_f'] = $function_row1['qty_free'];
					$item['whp'] = $function_row1['whole_price'];
					$item['dis1'] = $function_row1['disc_one'];
					$item['dis2'] = $function_row1['disc_two'];
					$item['amt'] = $function_row1['amount'];
					array_push($item_array, $item);
				}
				return $item_array;
			}
			else
			{
				return 0;
			}
		}

		//get no of pages required for listing orders
		function getOrdrPgs()
		{
			$ordr_pages = 1;
			include './config.php';
			if(isset($_COOKIE['rpp']))
			{
				$rpp = $_COOKIE['rpp'];
			}
			else
			{
				$rpp = 10;
			}

			$function_qry1 = "SELECT COUNT(*) AS totalordr FROM bc_orders";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			$function_row1 = mysqli_fetch_array($function_rlt1);
			$ordr_pages = $function_row1['totalordr'];
			return (intval($ordr_pages/$rpp) + 1);
		}

		//get existing customer data
		function getExstCstm()
		{
			include './config.php';
			$cstm_array = array();

			$function_qry1 = "SELECT * FROM bc_customers ORDER BY cstm_name";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) > 0)
			{
				while($function_row1 = mysqli_fetch_array($function_rlt1))
				{
					$customer = array();
					$customer['id'] = $function_row1['customer_id'];
					$customer['name'] = $function_row1['cstm_name'];
					$customer['city'] = $function_row1['cstm_city'];
					$customer['phone'] = $function_row1['cstm_phone'];
					array_push($cstm_array, $customer);
				}
				return $cstm_array;
			}
			else
			{
				return 0;
			}
		}

		//get existing customer data
		function getExstProd()
		{
			include './config.php';
			$prod_array = array();

			$function_qry1 = "SELECT * FROM bc_products ORDER BY prd_name";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) > 0)
			{
				while($function_row1 = mysqli_fetch_array($function_rlt1))
				{
					$product = array();
					$product['id'] = $function_row1['product_id'];
					$product['name'] = $function_row1['prd_name'];
					$product['mfctr'] = $function_row1['prd_mfctr'];
					$product['pckg'] = $function_row1['prd_pkg'];
					$product['price'] = $function_row1['prd_mrp'];
					array_push($prod_array, $product);
				}
				return $prod_array;
			}
			else
			{
				return 0;
			}
		}
	/* ORDER Management Functions END */

	/* Customer Management Functions START */
		//get customer detail from id
		function getCstmDtl($cstmid)
		{
			include './config.php';
			$cstm_dtl = array();

			$function_qry1 = "SELECT * FROM bc_customers WHERE customer_id = ".$cstmid;
			$function_qry2 = "SELECT * FROM bc_cstmdisc WHERE customer_id = ".$cstmid;
			if(mysqli_query($con, $function_qry1))
			{
				$function_rlt1 = mysqli_query($con, $function_qry1);
				$function_row1 = mysqli_fetch_array($function_rlt1);
				$cstm_dtl['id'] = $function_row1['customer_id'];
				$cstm_dtl['name'] = $function_row1['cstm_name'];
				$cstm_dtl['addr'] = $function_row1['cstm_addr'];
				$cstm_dtl['city'] = $function_row1['cstm_city'];
				$cstm_dtl['phone'] = $function_row1['cstm_phone'];
				if(mysqli_query($con, $function_qry2))
				{
					$function_rlt2 = mysqli_query($con, $function_qry2);
					$function_row2 = mysqli_fetch_array($function_rlt2);
					$cstm_dtl['whp'] = $function_row2['whp'];
				}
				else
				{
					$cstm_dtl['whp'] = 0;
				}
				
				return $cstm_dtl;
			}
			else
			{
				return 0;
			}
		}
		//get list of all customers
		function getCstmLst()
		{
			include 'config.php';
			$cstm_array = array();
			if(isset($_COOKIE['rpp']))
			{
				$rpp = $_COOKIE['rpp'];
			}
			else
			{
				$rpp = 10;
			}
			if(isset($_GET['pgno']))
			{
				$pgno = $_GET['pgno'];
			}
			else
			{
				$pgno = 1;
			}

			$function_qry1 = "SELECT * FROM bc_customers ORDER BY cstm_name LIMIT ".(($pgno*$rpp) - $rpp).", ".$rpp;
			$function_rlt1 = mysqli_query($con, $function_qry1);
			while($function_row1 = mysqli_fetch_array($function_rlt1))
			{
				$customer = array();
				$customer['id'] = $function_row1['customer_id'];
				$customer['name'] = $function_row1['cstm_name'];
				$customer['addr'] = $function_row1['cstm_addr'];
				$customer['city'] = $function_row1['cstm_city'];
				$customer['phone'] = $function_row1['cstm_phone'];
				array_push($cstm_array, $customer);
			}
			return $cstm_array;
		}

		//get no of pages required for listing customers
		function getCstmPgs()
		{
			$prod_pages = 1;
			include './config.php';
			if(isset($_COOKIE['rpp']))
			{
				$rpp = $_COOKIE['rpp'];
			}
			else
			{
				$rpp = 10;
			}

			$function_qry1 = "SELECT COUNT(*) AS totalcstm FROM bc_customers";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			$function_row1 = mysqli_fetch_array($function_rlt1);
			$prod_pages = $function_row1['totalcstm'];
			return (intval($prod_pages/$rpp) + 1);
		}
	/* Customer Management Functions END */

	/* SETTINGS management functions START */
		//get all taxes
		function getTaxes()
		{
			include './config.php';
			$taxes = array();
			$function_qry1 = "SELECT * FROM bc_settings WHERE keyname = 'taxes'";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) == 1)
			{
				$function_row1 = mysqli_fetch_array($function_rlt1);
				$taxes = unserialize($function_row1['keyvalue']);
				if($taxes != '')
				{
					return $taxes;	
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}

		//get address of business
		function getAddr()
		{
			include './config.php';
			$addr = '';
			$function_qry1 = "SELECT keyvalue FROM bc_settings WHERE keyname = 'address'";
			if(mysqli_query($con, $function_qry1))
			{
				$function_rlt1 = mysqli_query($con, $function_qry1);
				$function_row1 = mysqli_fetch_array($function_rlt1);
				return $function_row1['keyvalue'];
			}
			else
			{
				return 0;
			}
		}

	/* SETTINGS management functions END */

/* Functions Without HTML Output END */
?>

<?php
/* Functions With HTML Output START */
	//clear function message queue
	function clearfmsg()
	{
		if(isset($_SESSION['func_msg']))
		{
			$_SESSION['func_msg'] = '';
		}
	}

	/* SETTINGS management functions START */
		//update taxes
		function updateaddr()
		{
			$address = strtoupper(trim($_POST['addr']));
			include './config.php';
			clearfmsg();

			$function_qry1 = "UPDATE bc_settings SET keyvalue = '".$address."' WHERE keyname = 'address'";
			if(mysqli_query($con, $function_qry1))
			{
				$_SESSION['func_msg'] = 'Address updated successfully.';
				return 1;
			}
			else
			{
				$_SESSION['func_msg'] = 'Address could not be updated, please try again';
				return 0;
			}
		}

		//update taxes
		function updatetax()
		{
			$taxtype = $_POST['taxtype'];
			include './config.php';
			clearfmsg();
			$taxes = array();

			for($i=0;$i<count($taxtype);$i++)
			{
				$tax = array();
				if($taxtype[$i] != '')
				{
					$tax['name'] = $taxtype[$i];
					array_push($taxes, $tax);
				}
			}
			$taxstr = serialize($taxes);
			$function_qry1 = "UPDATE bc_settings SET keyvalue = '".$taxstr."' WHERE keyname = 'taxes'";
			if(mysqli_query($con, $function_qry1))
			{
				$_SESSION['func_msg'] = 'Taxes updated successfully.';
				return 1;
			}
			else
			{
				$_SESSION['func_msg'] = 'Taxes could not be updated, please try again.';
				return 0;
			}
		}

		//update admin panel password
		function updatepswd()
		{
			$oldpswd = $_POST['oldpswd'];
			$newpswd = $_POST['newpswd'];
			$cnfpswd = $_POST['cnfpswd'];
			include './config.php';
			clearfmsg();
			if($newpswd != $cnfpswd) 
			{
				$_SESSION['func_msg'] = 'New Password and Confirm Password must be same.';
				return 0;
			}
			if(($newpswd == '') || ($cnfpswd == ''))
			{
				$_SESSION['func_msg'] = 'Passwords cannot be blank.';
				return 0;
			}

			$function_qry1 = "SELECT keyvalue FROM bc_settings WHERE keyname = 'password'";
			$function_rlt1 = mysqli_query($con, $function_qry1);
			if(mysqli_num_rows($function_rlt1) == 1)
			{
				$function_row1 = mysqli_fetch_array($function_rlt1);
				if(md5($oldpswd) == $function_row1['keyvalue'])
				{
					$function_qry2 = "UPDATE bc_settings SET keyvalue = '".md5($newpswd)."' WHERE keyname = 'password'";
					mysqli_query($con, $function_qry2);
					$_SESSION['func_msg'] = 'Password changed successfully.';
					return 1;
				}
				else
				{
					$_SESSION['func_msg'] = 'Invalid Old Password.';
					return 0;
				}
			}
			else
			{
				$_SESSION['func_msg'] = 'Invalid Old Password.';
				return 0;
			}
		}
	/* SETTINGS management functions END */

	/* PRODUCT management functions START */
		//add new product to the inventory
		function saveprod()
		{
			include './config.php';
			clearfmsg();
			$name = strtoupper(trim($_POST['prod_name']));
			$mfctr = strtoupper(trim($_POST['mfctr_name']));
			$pckg = strtoupper(trim($_POST['prod_pckg']));
			$price = $_POST['prod_mrp'];
			$stkqty = $_POST['stck_qty'];
			$prodtax = $_POST['prod_tax'];
			$prodtaxname = $_POST['prod_tax_name'];

			if(($name == '') || ($mfctr == '') || ($pckg == '') || ($price == '') || ($stkqty == ''))
			{
				$_SESSION['func_msg'] = 'Please enter valid input for Product Name, Manufacturer, Packaging, Price and Quantity.';
				return 0;
			}

			$function_qry1 = "INSERT INTO bc_products (product_id, prd_name, prd_mfctr, prd_pkg, prd_mrp, prd_qty, stmp) VALUES (NULL, '".$name."', '".$mfctr."', '".$pckg."', '".$price."', ".$stkqty.", NOW())";
			if(mysqli_query($con, $function_qry1))
			{
				$product_id = mysqli_insert_id($con);
				for($i = 0; $i < count($prodtaxname); $i++)
				{
					if($prodtax[$i] > 0)
					{
						$function_qry2 = "INSERT INTO bc_prodtax (tax_id, product_id, tax_name, tax_percent) VALUES (NULL, ".$product_id.", '".$prodtaxname[$i]."', '".$prodtax[$i]."')";
						if(!mysqli_query($con, $function_qry2))
						{
							$_SESSION['func_msg'] = 'Product tax could not be added, please try again.';
							return 0;
						}
					}
				}
				$_SESSION['func_msg'] = 'Product added to the inventory successfully.';
				return 1;
			}
			else
			{
				$_SESSION['func_msg'] = 'Product could not be added, please try again.';
				return 0;
			}
		}

		//update product inventory
		function updateprod()
		{
			include './config.php';
			clearfmsg();

			$prodid = $_POST['prod_id'];
			$name = strtoupper(trim($_POST['prod_name']));
			$mfctr = strtoupper(trim($_POST['mfctr_name']));
			$pckg = strtoupper(trim($_POST['prod_pckg']));
			$price = $_POST['prod_mrp'];
			$stkqty = $_POST['stck_qty'];
			$prodtax = $_POST['prod_tax'];
			$prodtaxname = $_POST['prod_tax_name'];

			if(($name == '') || ($mfctr == '') || ($pckg == '') || ($price == '') || ($stkqty == ''))
			{
				$_SESSION['func_msg'] = 'Please enter valid input for Product Name, Manufacturer, Packaging, Price and Quantity.';
				return 0;
			}

			$function_qry1 = "UPDATE bc_products SET prd_name = '".$name."', prd_mfctr = '".$mfctr."', prd_pkg = '".$pckg."', prd_mrp = '".$price."', prd_qty = '".$stkqty."' WHERE product_id = ".$prodid;
			if(mysqli_query($con, $function_qry1))
			{
				for($i = 0; $i < count($prodtaxname); $i++)
				{
					if($prodtax[$i] > 0)
					{
						$function_qry2 = "SELECT * FROM bc_prodtax WHERE product_id = ".$prodid." AND tax_name = '".$prodtaxname[$i]."'";
						$function_rlt2 = mysqli_query($con, $function_qry2);
						if(mysqli_num_rows($function_rlt2) == 1)
						{
							$function_qry3 = "UPDATE bc_prodtax SET tax_percent = '".$prodtax[$i]."' WHERE product_id = ".$prodid." AND tax_name = '".$prodtaxname[$i]."'";
						}
						else
						{
							$function_qry3 = "INSERT INTO bc_prodtax (tax_id, product_id, tax_name, tax_percent) VALUES (NULL, ".$prodid.", '".$prodtaxname[$i]."', '".$prodtax[$i]."')";
						}

						if(!mysqli_query($con, $function_qry3))
						{
							$_SESSION['func_msg'] = 'Product tax could not be updated, please try again.';
							return 0;
						}
					}
				}
				$_SESSION['func_msg'] = 'Product inventory updated successfully.';
				return 1;
			}
			else
			{
				$_SESSION['func_msg'] = 'Product could not be updated, please try again.';
				return 0;
			}
		}

		//delete product for the given id
		function proddel()
		{
			include './config.php';
			clearfmsg();
			$prodid = $_GET['prodid'];

			$function_qry1 = "DELETE FROM bc_products WHERE product_id = ".$prodid;
			if(mysqli_query($con, $function_qry1))
			{
				$function_qry2 = "DELETE FROM bc_prodtax WHERE product_id = ".$prodid;
				if(!mysqli_query($con, $function_qry2))
				{
					$_SESSION['func_msg'] = 'Product taxes not be deleted from inventory.';
					return 0;
				}
				$_SESSION['func_msg'] = 'Product deleted from inventory successfully.';
				return 1;
			}
			else
			{
				$_SESSION['func_msg'] = 'Product could not be deleted from inventory.';
				return 0;
			}
		}
	/* PRODUCT management functions END */

	/* CUSTOMER management functions START */
		//add new customer to database
		function savecstm()
		{
			include './config.php';
			clearfmsg();

			$name = strtoupper(trim($_POST['cstm_name']));
			$addr = strtoupper(trim($_POST['cstm_addr']));
			$city = strtoupper(trim($_POST['cstm_city']));
			$phone = trim($_POST['cstm_phone']);
			$whp = floatval(trim($_POST['cstm_whp']));

			if(($name == '') || ($addr == '') || ($city == ''))
			{
				$_SESSION['func_msg'] = 'Please enter valid input for Customer Name, Address and City.';
				return 0;
			}

			$function_qry1 = "INSERT INTO bc_customers (customer_id, cstm_name, cstm_addr, cstm_city, cstm_phone, stmp) VALUES (NULL, '".$name."', '".$addr."', '".$city."', '".$phone."', NOW())";
			if(mysqli_query($con, $function_qry1))
			{
				$cstm_id = mysqli_insert_id($con);
				$function_qry2 = "INSERT INTO bc_cstmdisc (whp_id, customer_id, whp) VALUES (NULL, ".$cstm_id.", '".$whp."')";
				if(!mysqli_query($con, $function_qry2))
				{
					$_SESSION['func_msg'] = 'Customer Discounts could not be added, please try again.';
					return 0;
				}
				$_SESSION['func_msg'] = 'New customer added successfully.';
				return 1;
			}
			else
			{
				$_SESSION['func_msg'] = 'Customer could not be added, please try again.';
				return 0;
			}
		}

		//update customer details
		function updatecstm()
		{
			include './config.php';
			clearfmsg();

			$cstmid = $_POST['cstm_id'];
			$name = strtoupper(trim($_POST['cstm_name']));
			$addr = strtoupper(trim($_POST['cstm_addr']));
			$city = strtoupper(trim($_POST['cstm_city']));
			$phone = trim($_POST['cstm_phone']);
			$whp = floatval(trim($_POST['cstm_whp']));

			if(($name == '') || ($addr == '') || ($city == ''))
			{
				$_SESSION['func_msg'] = 'Please enter valid input for Customer Name, Address and City.';
				return 0;
			}

			$function_qry1 = "UPDATE bc_customers SET cstm_name = '".$name."', cstm_addr = '".$addr."', cstm_city = '".$city."', cstm_phone = '".$phone."' WHERE customer_id = ".$cstmid;
			if(mysqli_query($con, $function_qry1))
			{
				$function_qry2 = "UPDATE bc_cstmdisc SET whp = '".$whp."' WHERE customer_id = ".$cstmid;
				if(mysqli_query($con, $function_qry2))
				{
					$_SESSION['func_msg'] = 'Customer details updated successfully.';
					return 1;
				}
				else
				{
					$_SESSION['func_msg'] = 'Customer discounts could not be updated, please try again.';
					return 0;
				}
			}
			else
			{
				$_SESSION['func_msg'] = 'Customer details could not be updated, please try again.';
				return 0;
			}
		}

		//delete customer for the given id
		function cstmdel()
		{
			include './config.php';
			clearfmsg();
			$cstmid = $_GET['cstmid'];

			$function_qry1 = "DELETE FROM bc_customers WHERE customer_id = ".$cstmid;
			$function_qry2 = "DELETE FROM bc_cstmdisc WHERE customer_id = ".$cstmid;
			if(mysqli_query($con, $function_qry1))
			{
				if(mysqli_query($con, $function_qry2))
				{
					$_SESSION['func_msg'] = 'Customer deleted successfully.';
					return 1;
				}
				else
				{
					$_SESSION['func_msg'] = 'Customer discounts could not be deleted, please try again.';
					return 0;
				}
			}
			else
			{
				$_SESSION['func_msg'] = 'Customer could not be deleted, please try again.';
				return 0;
			}
		}
	/* CUSTOMER management functions END */

	/* ORDER Management Functions START */
		//save order details
		function saveordr()
		{
			include './config.php';
			clearfmsg();

			$cstm_id = intval($_POST['cstm_id']);
			$cstm_name = strtoupper(trim($_POST['cstm_name']));
			$cstm_addr = strtoupper(trim($_POST['cstm_addr']));
			$cstm_city = strtoupper(trim($_POST['cstm_city']));
			$cstm_phone = trim($_POST['cstm_phone']);

			$prod_id = $_POST['prod_id'];
			$exp = $_POST['batch'];
			$whp = $_POST['whp'];
			$qty = $_POST['qty'];
			$free = $_POST['free'];
			$dis1 = $_POST['dis1'];
			$dis2 = $_POST['dis2'];
			$tax = $_POST['tax'];

			$function_qry2 = "INSERT INTO bc_orders (order_id, customer_id, ordr_date, subtotal, distotal, tot_tax, totalamt, stmp) VALUES (NULL, ".$cstm_id.", CURDATE(), 0, 0, 0, 0, NOW())";
			if(!mysqli_query($con, $function_qry2))
			{
				$_SESSION['func_msg'] = 'Order could not be initiated, please try again.';
				return 0;
			}

			$order_id = mysqli_insert_id($con);
			$subtotal = 0;
			$distotal = 0;
			$taxtotal = 0;
			$grosstotal = 0;

			for($prod_count = 0; $prod_count < count($prod_id); $prod_count++)
			{
				$pid = intval($prod_id[$prod_count]);
				$pqty = intval($qty[$prod_count]);
				$pfree = intval($free[$prod_count]);

				if(getProdDtl($pid)['stkqty'] < ($pqty + $pfree))
				{
					$_SESSION['func_msg'] = 'Order could not be processed as insufficient stock for '.getProdDtl($pid)['name'].', please try again.';
					return 0;
				}
			}

			for($prod_count = 0; $prod_count < count($prod_id); $prod_count++)
			{
				$pid = intval($prod_id[$prod_count]);
				$expiry = $exp[$prod_count];
				$pqty = intval($qty[$prod_count]);
				$pfree = intval($free[$prod_count]);
				$pwhp = floatval($whp[$prod_count]);
				$pdis1 = floatval($dis1[$prod_count]);
				$pdis2 = floatval($dis2[$prod_count]);
				$taxprcnt = floatval($tax[$prod_count]);
				$amt = round(($pqty * $pwhp), 2);
				$subtotal = $subtotal + $amt;
				$discount = round(($amt * (($pdis1 + $pdis2)/100)), 2);
				$distotal = $distotal + $discount;
				$taxamt = round(((($amt - $discount)) * ($taxprcnt/100)), 2);
				$taxtotal = $taxtotal + $taxamt;
				$grossamt = $amt - $discount + $taxamt;
				$grosstotal = $grosstotal + $grossamt;

				$function_qry3 = "INSERT INTO bc_orditems (item_id, order_id, product_id, expiry, qty_billed, qty_free, whole_price, disc_one, disc_two, amount, stmp) VALUES (NULL, ".$order_id.", ".$pid.", '".$expiry."', ".$pqty.", ".$pfree.", '".$pwhp."', '".$pdis1."', '".$pdis2."', '".$grossamt."', NOW())";
				if(!mysqli_query($con, $function_qry3))
				{
					$_SESSION['func_msg'] = 'Order could not be processed for '.getProdDtl($pid)['name'].', please try again.';
					return 0;
				}

				for($taxcount = 0; $taxcount < count(getProdDtl($pid)['taxes']); $taxcount++)
				{
					$subtax = round((($amt - $discount) * (getProdDtl($pid)['taxes'][$taxcount]['percent']/100)), 2);
					$function_qry4 = "INSERT INTO bc_ordtaxes (tax_id, order_id, product_id, tax_name, tax_prcnt, tax_amt, stmp) VALUES (NULL, ".$order_id.", ".$pid.", '".getProdDtl($pid)['taxes'][$taxcount]['name']."', '".getProdDtl($pid)['taxes'][$taxcount]['percent']."', '".$subtax."', NOW())";
					if(!mysqli_query($con, $function_qry4))
					{
						$_SESSION['func_msg'] = 'Taxes could not be processed for '.getProdDtl($pid)['name'].', please try again.';
						return 0;
					}
				}
			}

			$function_qry5 = "UPDATE bc_orders SET subtotal = '".$subtotal."', distotal = '".$distotal."', tot_tax = '".$taxtotal."', totalamt = '".$grosstotal."' WHERE order_id = ".$order_id;
			if(!mysqli_query($con, $function_qry5))
			{
				$_SESSION['func_msg'] = 'Order totals could not be updated, please try again';
				return 0;
			}

			for($prod_count = 0; $prod_count < count($prod_id); $prod_count++)
			{
				$pid = intval($prod_id[$prod_count]);
				$pqty = intval($qty[$prod_count]);
				$pfree = intval($free[$prod_count]);
				$newqty = (getProdDtl($pid)['stkqty'] - ($pqty + $pfree));

				$function_qry6 = "UPDATE bc_products SET prd_qty = ".$newqty." WHERE product_id = ".$pid;

				if(!mysqli_query($con, $function_qry6))
				{
					$_SESSION['func_msg'] = 'Product Stock could not be updated, please try again.';
					return 0;
				}
			}

			$_SESSION['func_msg'] = 'Order processed succesfully';
			return 1;
		}
	/* ORDER Management Functions END */

	//execute the function if called and exists
	if(isset($_GET['func']) && function_exists($_GET['func']))
	{
		$run_function = $_GET['func'];
		if($run_function())
		{
			header('Location: ./?fl=success');
		}
		else
		{
			header('Location: ./?fl=failure');
		}
	}
/* Functions With HTML Output END */
?>