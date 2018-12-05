<?php
	include './config.php';
	include 'adminfunctions.php';
	$ordrid = $_GET['ordrid'];
	if(intval($ordrid) < 1)
	{
		exit();
	}
?>
<link rel="stylesheet" href="addons/bootstrap/css/bootstrap.css"/>
<style>
	#watermark
	{
	    display: flex;
	    flex-direction: column;
	    justify-content: center;
	    text-align: center;
	    align-items: center;
	    height: 95%;
	    width: 85%;
	    position:fixed;
	    opacity:0.09;
	    z-index:99;
	    color:white;
	}
</style>
<div class="container" style="font-family: 'Quando', serif;">
	<div id="watermark"><img src="images/logo.jpg" style="filter: grayscale(100%);"/></div>
	<div class="row">
		<div class="col-xs-12" style="border: 2px solid green;">
			<div class="col-xs-2" style="text-align: right; padding: 10px;">
				<img src="images/logo.jpg" width="100%">
			</div>
			<div class="col-xs-10" style="text-align: left;">
			<table class="table table-bordered table-condensed" style="font-size: 12px; width: 100%; margin-bottom: 0px;">
				<tbody>
					<tr>
						<td>
							Invoice to : <br>
							<?php echo getCstmDtl(getOrdrDtl($ordrid)['cstmid'])['name']; ?>
							<br>
							<?php echo getCstmDtl(getOrdrDtl($ordrid)['cstmid'])['addr']; ?>
							<br>
							<?php echo getCstmDtl(getOrdrDtl($ordrid)['cstmid'])['city']; ?>
						</td>
						<td style="text-align: right;">
							<span style="color: #1C912E; font-size: 24pt;"><?php echo $siteowner; ?></span>
							<br>
							<span style="color: #000; font-size: 12px;"><?php echo getAddr(); ?></span>
						</td>
					</tr>
					<tr>
						<td>
							Invoice # : 
							<?php echo getOrdrDtl($ordrid)['cstmid'].'/'.$ordrid; ?>
						</td>
						<td style="text-align: right;">
							Date : <?php echo date_format(date_create_from_format('Y-m-d', getOrdrDtl($ordrid)['date']), 'd-m-Y'); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<span style="color: #000; font-size: 14pt;">TAX INVOICE</span>
						</td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table table-striped table-bordered table-hover table-condensed" style="font-size: 12px;">
			<tbody>
			</tbody>
		</table>
		<table class="table table-condensed" style="font-size: 12px;">
			<tbody>
				<tr>
					<th>#</th>
					<th>Desc</th>
					<th style="text-align:right;">MRP.</th>
					<th style="text-align:right;">Whsl. Prc.</th>
					<th style="text-align:right;">Qty</th>
					<th style="text-align:right;">Free</th>
					<th style="text-align:right;">Dis1</th>
					<th style="text-align:right;">Dis2</th>
					<th style="text-align:right;">Tax</th>
					<th style="text-align:right;">Amt.</th>
				</tr>
				<?php
					for($i = 0; $i < count(getOrdrItems($ordrid)); $i++)
					{						
						echo '<tr style="font-size:x-small;">';
							echo '<td style="font-family:\'Courier New\', Courier, monospace">'.($i+1).'</td>';
							echo '<td style="font-family:\'Courier New\', Courier, monospace">'.getProdDtl(getOrdrItems($ordrid)[$i]['pid'])['name'].'<br>'.getProdDtl(getOrdrItems($ordrid)[$i]['pid'])['mfctr'].' - '.getProdDtl(getOrdrItems($ordrid)[$i]['pid'])['pckg'].' (Exp - '.getOrdrItems($ordrid)[$i]['exp'].')</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">'.getProdDtl(getOrdrItems($ordrid)[$i]['pid'])['price'].'</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">'.getOrdrItems($ordrid)[$i]['whp'].'</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">'.getOrdrItems($ordrid)[$i]['qty_b'].'</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">'.getOrdrItems($ordrid)[$i]['qty_f'].'</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">'.getOrdrItems($ordrid)[$i]['dis1'].'%</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">'.getOrdrItems($ordrid)[$i]['dis2'].'%</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">';
							$taxstr = '';
							for($j = 0; $j < count(getOrdrProdTax($ordrid, getOrdrItems($ordrid)[$i]['pid'])); $j++)
							{
								if($taxstr == '')
								{
									$taxstr = getOrdrProdTax($ordrid, getOrdrItems($ordrid)[$i]['pid'])[$j]['name'].':'.getOrdrProdTax($ordrid, getOrdrItems($ordrid)[$i]['pid'])[$j]['percent'].'%';
								}
								else
								{
									$taxstr = $taxstr.' '.getOrdrProdTax($ordrid, getOrdrItems($ordrid)[$i]['pid'])[$j]['name'].':'.getOrdrProdTax($ordrid, getOrdrItems($ordrid)[$i]['pid'])[$j]['percent'].'%';
								}
							}
							echo $taxstr;
							echo '</td>';
							echo '<td style="text-align:right; font-family:\'Courier New\', Courier, monospace">'.getOrdrItems($ordrid)[$i]['amt'].'</td>';
						echo '</tr>';
					}
				?>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align:right;">
					<?php
						echo 'Subtotal :';
						echo '<br>';
						echo 'Total Disc :';
						echo '<br>';
						echo 'Total Tax :';
						echo '<br>';
						echo 'Total Amount :';
					?>
					</th>
					<th style="text-align:right;">
					<?php
						echo getOrdrDtl($ordrid)['subtotal'];
						echo '<br>';
						echo getOrdrDtl($ordrid)['totaldis'];
						echo '<br>';
						echo getOrdrDtl($ordrid)['totaltax'];
						echo '<br>';
						echo getOrdrDtl($ordrid)['totalamt'];
					?>
					</th>
				</tr>
			</tbody>
		</table>
		<table class="table table-striped table-bordered table-hover table-condensed" style="font-size: 12px;">
			<tbody>
				<tr>
					<td width="35%" style="text-align: center; padding-top: 90px;">Checked By</td>
					<td style="text-align: center; padding-top: 90px;"></td>
					<td width="35%" style="text-align: center; padding-top: 90px;">Stamp & Date</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<script src="addons/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    window.print();
</script>