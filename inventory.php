

<?php require_once 'includes/header.php';?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;


//Cash Expenses
$sqlExpensesC = "SELECT sum(amount) from expenses where date = '$curDate' and payment_type = 1 and status = 1";
$resultExpensesC = $connect->query($sqlExpensesC);
while($rowExpensesC = $resultExpensesC->fetch_row()) {
	list($cashExpenseToday) = $rowExpensesC;
	if($cashExpenseToday == ''){$cashExpenseToday = 0;}
 }
//cash
$sqlCash1 = "SELECT sum(paid) from payment_details where paid_date = '$curDate' and type='1'";
$resultCash1 = $connect->query($sqlCash1);
while($rowCash1 = $resultCash1->fetch_row()) {
	list($paid1) = $rowCash1;
 }
 $sqlCash2 = "SELECT sum(cash) from orders where order_date = '$curDate' and cash ";
 $resultCash2 = $connect->query($sqlCash2);
 while($rowCash2 = $resultCash2->fetch_row()) {
	 list($paid2) = $rowCash2;
  }
 $cashToday=$paid1+$paid2;
 $cashGT = $cashToday - $cashExpenseToday;
 // end cash

//GCash Expenses
$sqlExpensesGC = "SELECT sum(amount) from expenses where date = '$curDate' and payment_type = 2 and status = 1";
$resultExpensesGC = $connect->query($sqlExpensesGC);
while($rowExpensesGC = $resultExpensesGC->fetch_row()) {
	list($gcashExpenseToday) = $rowExpensesGC;
	if($gcashExpenseToday == ''){$gcashExpenseToday = 0;}
 }
//gcash
$sqlgCash1 = "SELECT sum(paid) from payment_details where paid_date = '$curDate' and type='2'";
$resultgCash1 = $connect->query($sqlgCash1);
while($rowgCash1 = $resultgCash1->fetch_row()) {
	list($gpaid1) = $rowgCash1;
 }
 $sqlgCash2 = "SELECT sum(gcash) from orders where order_date = '$curDate' and gcash";
 $resultgCash2 = $connect->query($sqlgCash2);
 while($rowgCash2 = $resultgCash2->fetch_row()) {
	 list($gpaid2) = $rowgCash2;
  }
 $eWalletToday=$gpaid1+$gpaid2;
 $gcashGT = $eWalletToday - $gcashExpenseToday;
 // end gcash

//Bank Expenses
$sqlExpensesB = "SELECT sum(amount) from expenses where date = '$curDate' and payment_type = 3 and status = 1";
$resultExpensesB = $connect->query($sqlExpensesB);
while($rowExpensesB = $resultExpensesB->fetch_row()) {
	list($bankExpenseToday) = $rowExpensesB;
	if($bankExpenseToday == ''){$bankExpenseToday = 0;}
 }
//bank
$sqlBank1 = "SELECT sum(paid) from payment_details where paid_date = '$curDate' and type='3'";
$resultBank1 = $connect->query($sqlBank1);
while($rowBank1 = $resultBank1->fetch_row()) {
	list($bpaid1) = $rowBank1;
 }
 $sqlBank2 = "SELECT sum(bank) from orders where order_date = '$curDate' and bank";
 $resultBank2 = $connect->query($sqlBank2);
 while($rowBank2 = $resultBank2->fetch_row()) {
	 list($bpaid2) = $rowBank2;
  }
 $bankToday=$bpaid1+$bpaid2;
 $bankGT = $bankToday - $bankExpenseToday;
 // end bank

//cc
$sqlCc1 = "SELECT sum(paid) from payment_details where paid_date = '$curDate' and type='4'";
$resultCc1 = $connect->query($sqlCc1);
while($rowCc1 = $resultCc1->fetch_row()) {
	list($ccpaid1) = $rowCc1;
 }
 $sqlCc2 = "SELECT sum(credit_card) from orders where order_date = '$curDate' and credit_card";
 $resultCc2 = $connect->query($sqlCc2);
 while($rowCc2 = $resultCc2->fetch_row()) {
	 list($ccpaid2) = $rowCc2;
  }
 $ccToday=$ccpaid1+$ccpaid2;
 // end cc



$sqlPay = "SELECT sum(paid) from payment_details where paid_date = '$curDate'";
$resultPay = $connect->query($sqlPay);
while($rowPay = $resultPay->fetch_row()) {
	list($paymentToday) = $rowPay;
 }

$sqlPayOrd = "SELECT sum(grand_total) from orders where order_date = '$curDate'";
$resultPayOrd = $connect->query($sqlPayOrd);
while($rowPayOrd = $resultPayOrd->fetch_row()) {
	list($paymentTodayOrd) = $rowPayOrd;
}

$sqlGrams = "SELECT sum(actual_weight) from brands where brand_type = 1";
$resultGrams = $connect->query($sqlGrams);
while($rowGrams = $resultGrams->fetch_row()) {
	list($totalGrams) = $rowGrams;
}


//Layaway Remaining Stocks
$sqlLRS = "SELECT sum(loi.quantity) from layaway_order_item loi inner join layaway_orders lo on loi.order_id = lo.order_id where lo.order_type = 1 and payment_status !=4";
$resultLRS = $connect->query($sqlLRS);
while($rowLRS = $resultLRS->fetch_row()) {
	list($layawayRS) = $rowLRS;
	$layawayRS+=0;
 }

 //Reservation Remaining Stocks
 $sqlRRS = "SELECT sum(loi.quantity) from layaway_order_item loi inner join layaway_orders lo on loi.order_id = lo.order_id where lo.order_type = 2 and payment_status !=4";
 $resultRRS = $connect->query($sqlRRS);
 while($rowRRS = $resultRRS->fetch_row()) {
	 list($reservationRS) = $rowRRS;
	 $reservationRS+=0;
  }

//Pickup Remaining Stocks
$sqlPRS = "SELECT sum(loi.quantity) from layaway_order_item loi inner join layaway_orders lo on loi.order_id = lo.order_id where lo.order_type = 3 and payment_status !=4";
$resultPRS = $connect->query($sqlPRS);
while($rowPRS = $resultPRS->fetch_row()) {
	list($pickupRS) = $rowPRS;
	$pickupRS+=0;
}

//Delivery Remaining Stocks
$sqlDRS = "SELECT sum(loi.quantity) from layaway_order_item loi inner join layaway_orders lo on loi.order_id = lo.order_id where lo.order_type = 4 and payment_status !=4";
$resultDRS = $connect->query($sqlDRS);
while($rowDRS = $resultDRS->fetch_row()) {
	list($deliveryRS) = $rowDRS;
	$deliveryRS+=0;
}

//Total Expenses
$sqlExpenses = "SELECT sum(amount) from expenses where date = '$curDate' and status = 1";
$resultExpenses = $connect->query($sqlExpenses);
while($rowExpenses = $resultExpenses->fetch_row()) {
	list($expensesToday) = $rowExpenses;
	if($expensesToday == ''){$expensesToday=0;}
 }

//Actual Revenue input by staff
$sqlActRev = "SELECT cash, ewallet, bank, credit_card, user_id from eod_revenue where cur_date = '$curDate'";
$resultActRev = $connect->query($sqlActRev);
while($rowActRev = $resultActRev->fetch_row()) {
	list($actRevCash, $actRevEwallet, $actRevBank, $actRevCc, $staff) = $rowActRev;
}

//Today
$totalRevenueTodayNoExpense = $actRevCash + $actRevEwallet + $actRevBank + $actRevCc;
$totalRevenueToday = $totalRevenueTodayNoExpense-$expensesToday;

//Main Remaining Stocks
$mainRS=$totalGrams - ($layawayRS+$reservationRS+$pickupRS+$deliveryRS);
$totalRevenueNoExpense = $paymentToday + $paymentTodayOrd;
$totalRevenue = ($paymentToday + $paymentTodayOrd)-$expensesToday;
?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	<div class="col-md-4">
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) {?>
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($totalRevenue) {
		    	echo 'P'.number_format($totalRevenue,2).'';
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><h4> Total Revenue </h4></p>
		  </div>
		</div> 
		<br/>
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($totalGrams) {
		    	echo $totalGrams.'g';
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><h4> Total  Remaining Grams  </h4></p>
		  </div>
		</div> 
		<?php  } ?>
		</br>
		<div class="card">
		  <div class="cardHeader">
		    <p><?php echo date('l') .' '.date('d').''; ?></p>
		  </div>

		  <div class="cardContainer">
			<div id="calendar"></div>
		  </div>
		</div> 
	</div>
	
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==2) {?>
		
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Payment Type Revenue & Expenses | <?php echo $curDate; ?>
			<div class="pull-right"> <a href="expenses.php"><button><i class="glyphicon glyphicon-plus-sign"></i> Add Expenses</button></a>
				<button data-toggle="modal" data-target="#addEODModel"> <i class="glyphicon glyphicon-plus-sign"></i> Create End of Day Actual Revenue </button>
			</div> <!-- /div-action -->	
			</div>
			<div class="panel-body">
				<table class="table" id="revenueTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:20%;"></th>
			  			<th style="width:20%;">Cash</th>
			  			<th style="width:20%;">E-walet</th>
			  			<th style="width:20%;">Bank</th>
			  			<th style="width:20%;">Credit Card</th>
			  			<th style="width:20%;">Grand Total</th>
			  		</tr>
			  	</thead>
			  	<tbody>
						<tr>
							<th>Total</th>
							<td><?php echo 'P'.number_format($cashToday,2).'';?> </td>
							<td><?php echo 'P'.number_format($eWalletToday,2).'';?></td>
							<td><?php echo 'P'.number_format($bankToday,2).'';?></td>
							<td><?php echo 'P'.number_format($ccToday,2).'';?></td>
							<td><?php echo 'P'.number_format($totalRevenueNoExpense,2).'';?></td>
						</tr>
						<tr>
							<th>Expenses</th>
							<td><?php echo 'P'.number_format($cashExpenseToday,2).'';?> </td>
							<td><?php echo 'P'.number_format($gcashExpenseToday,2).'';?></td>
							<td><?php echo 'P'.number_format($bankExpenseToday,2).'';?></td>
							<td>-</td>
							<td><?php echo 'P'.number_format($expensesToday,2).'';?></td>
						</tr>
						<tr>
							<th>Grand Total</th>
							<td><?php echo 'P'.number_format($cashGT,2).'';?> </td>
							<td><?php echo 'P'.number_format($gcashGT,2).'';?></td>
							<td><?php echo 'P'.number_format($bankGT,2).'';?></td>
							<td><?php echo 'P'.number_format($ccToday,2).'';?></td>
							<th><?php echo 'P'.number_format($totalRevenue,2).'';?></th>
						</tr>
				</tbody>
				</table>
			</div>	
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Containers Stocks</div>
			<div class="panel-body">
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:20%;">Main</th>
			  			<th style="width:20%;">Layaway</th>
			  			<th style="width:20%;">Reservation</th>
			  			<th style="width:20%;">For Pick-Up</th>
			  			<th style="width:20%;">For Delivery</th>
			  		</tr>
			  	</thead>
			  	<tbody>
						<tr>
							<td><?php echo ''.$mainRS.'g';?> </td>
							<td><?php echo ''.$layawayRS.'g';?> </td>
							<td><?php echo ''.$reservationRS.'g';?></td>
							<td><?php echo ''.$pickupRS.'g';?></td>
							<td><?php echo ''.$deliveryRS.'g';?></td>
						</tr>
				</tbody>
				</table>
			</div>	
		</div>
			<div class="panel panel-default">
				<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Total Grams & Quantity / Category</div>
				<div class="panel-body">
				<table class="table">
					<thead>
						<tr>							
							<th>Category Name</th>
							<th>Price</th>
							<th>Actual Weight/Qty</th>
						</tr>
						<?php
							$sqltotalGQs = "SELECT brand_name, price, actual_weight, brand_type FROM brands WHERE brand_status = 1";
							$resulttotalGQ = $connect->query($sqltotalGQs);
							while($rowtotalGQ = $resulttotalGQ->fetch_row()) {
								list($brand_name, $price, $actual_weight, $brand_type) = $rowtotalGQ;
								$actual_weight = intval($actual_weight)+0;
								if($brand_type == 2){
									$price = "Price is Per/Qty";
									$sku = " Piece(s)";
								} else {
									$sku = "g";
								}
								echo"<tr>
									<td>$brand_name </td>
									<td>$price</td>
									<td>$actual_weight$sku</td>
								</tr>";
							}
						?>
					</thead>
				</table>
				<!--<div id="calendar"></div>-->
			</div>	
		</div>
		
	</div> 
	<?php  } else {?>
	
		<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="fa fa-money"></i> Expenses | <?php echo $curDate; ?>
			<div class="pull-right"> <a href="expenses.php"><button><i class="glyphicon glyphicon-plus-sign"></i> Add Expenses</button></a>
				<button data-toggle="modal" data-target="#addEODModel"> <i class="glyphicon glyphicon-plus-sign"></i> Create End of Day Actual Revenue </button>
			</div> <!-- /div-action -->	
			</div>
			<div class="panel-body">		
				<table class="table" id="revenueTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:20%;"></th>
			  			<th style="width:20%;">Cash</th>
			  			<th style="width:20%;">E-walet</th>
			  			<th style="width:20%;">Bank</th>
			  			<th style="width:20%;">Credit Card</th>
			  			<th style="width:20%;">Grand Total</th>
			  		</tr>
			  	</thead>
			  	<tbody>
						<tr>
							<th>Total</th>
							<td><?php echo 'P'.number_format($actRevCash,2).'';?> </td>
							<td><?php echo 'P'.number_format($actRevEwallet,2).'';?></td>
							<td><?php echo 'P'.number_format($actRevBank,2).'';?></td>
							<td><?php echo 'P'.number_format($actRevCc,2).'';?></td>
							<td><?php echo 'P'.number_format($totalRevenueTodayNoExpense,2).'';?></td>
						</tr>
						<tr>
							<th>Expenses</th>
							<td><?php echo 'P'.number_format($cashExpenseToday,2).'';?> </td>
							<td><?php echo 'P'.number_format($gcashExpenseToday,2).'';?></td>
							<td><?php echo 'P'.number_format($bankExpenseToday,2).'';?></td>
			  				<td> - </td>
							<td><?php echo 'P'.number_format($expensesToday,2).'';?></td>
						</tr>
						<tr>
							<th></th>
							<td></td>
							<td></td>
							<td></td>
							<th>Grand Total</th>
							<th><?php echo 'P'.number_format($totalRevenueToday,2).'';?></th>
						</tr>
				</tbody>
				</table>
			</div>	
		</div>
	      	<div id="add-inventory-messages"></div>
			<div class="panel panel-default">
				<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Total Grams & Quantity / Category				
			</div>
				<div class="panel-body">
  				<form class="form-horizontal" method="POST" action="php_action/createInventory.php" id="submitInventoryForm">
				<table class="table">
					<thead>
						<tr>							
							<th width="10px">#</th>	
							<th>Category Name</th>
							<th>Price</th>
							<th>Actual Weight/Qty</th>
						</tr>
						<?php
							$n=1;
							$sqltotalGQss = "SELECT brand_id,brand_name, price, actual_weight, brand_type FROM brands WHERE brand_status = 1";
							$resulttotalGQss = $connect->query($sqltotalGQss);
							while($rowtotalGQss = $resulttotalGQss->fetch_row()) {
								list($brand_id, $brand_names, $prices, $actual_weights, $brand_types) = $rowtotalGQss;
								$actual_weights = intval($actual_weights)+0;
								if($brand_types == 2){
									$prices = "Price is Per/Qty";
									$sku = " Piece(s)";
								} else {
									$sku = "g";
								}
								
								$sqltotalQty = "SELECT sum(qty) FROM inventory WHERE brand_id=$brand_id and date='$curDate'";
								$resulttotalQty = $connect->query($sqltotalQty);
								while($rowtotalQty = $resulttotalQty->fetch_row()) {
									list($brandQty) = $rowtotalQty;
								}
								echo"<tr>
									<td>$n.</td>
									<td>$brand_names </td>
									<td>$prices</td>
									<th>$brandQty$sku</th>
									</tr>";
									$sqlSubCat = "SELECT c.categories_id,c.categories_name, i.qty FROM categories c inner join inventory i on c.categories_id = i.categories_id WHERE c.brand_id = $brand_id and c.categories_status = 1 and i.date = '$curDate'";
									$resultSubCat = $connect->query($sqlSubCat);
									if($resultSubCat->num_rows > 0) {
										while($rowSubCat = $resultSubCat->fetch_row()) {
											list($categoriesId,$categoriesName,$qty) = $rowSubCat;
										echo"<tr><td></td><td colspan='3'>
											<table width='100%'>
												<tr>
													<td width='10px'>-</td>
													<td width='150px'>$categoriesName</td>
													<td width='250px'>
														<input type='hidden' value='$categoriesId' name='subCategoryId[]'/>
														<input type='hidden' value='$brand_id' name='brandId[]'/>
														<input type='hidden' value='$categoriesName' name='subCategoryName[]'/>
													</td>
													<td><input type='number' value='$qty' name='subCategoryQty[]'/></td>
												</tr>
											</table>
										</td></tr>";
										} 
									} else {
										$sqlSubCat2 = "SELECT c.categories_id,c.categories_name FROM categories c WHERE c.brand_id = $brand_id and c.categories_status = 1";
										$resultSubCat2 = $connect->query($sqlSubCat2);
										while($rowSubCat2 = $resultSubCat2->fetch_row()) {
											list($categoriesId,$categoriesName) = $rowSubCat2;
										echo"<tr><td></td><td colspan='3'>
											<table width='100%'>
												<tr>
													<td width='10px'>-</td>
													<td width='150px'>$categoriesName</td>
													<td width='250px'>
														<input type='hidden' value='$categoriesId' name='subCategoryId[]'/>
														<input type='hidden' value='$brand_id' name='brandId[]'/>
														<input type='hidden' value='$categoriesName' name='subCategoryName[]'/>
													</td>
													<td><input type='number' name='subCategoryQty[]'/></td>
												</tr>
											</table>
										</td></tr>";
									}
									}
								$n++;
							}
						?>
					</thead>
				</table>

				<div class="form-group submitButtonFooter pull-right">
				<div class="col-sm-12">
					<button type="reset" class="btn btn-default" style="margin-left:20px;" onclick="resetInventoryForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
					<button type="submit" id="createInventoryBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				</div>
				</div>
				</form>
				<!--<div id="calendar"></div>-->
			</div>	
	</div>
	<?php } ?>
</div> <!--/row-->

<div class="modal fade" id="addEODModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitEODForm" action="php_action/createEODRevenue.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Create End of Day Actual Revenue</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="add-eod-messages"></div>
	        <div class="form-group">
	        	<label for="actualCash" class="col-sm-3 control-label">Cash </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					  <input type="hidden" name="userId" value="<?php echo $_SESSION['userId'];?>"/>
				      <input type="number" step="0.01" value="<?php echo $actRevCash;?>" class="form-control" id="actualCash" placeholder="Actual Cash Amount" name="actualCash" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	
	        <div class="form-group">
	        	<label for="actualEwallet" class="col-sm-3 control-label">E-Wallet </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" step="0.01" value="<?php echo $actRevEwallet;?>" class="form-control" id="actualEwallet" placeholder="Actual E-Wallet Amount" name="actualEwallet" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	
	        <div class="form-group">
	        	<label for="actualBank" class="col-sm-3 control-label">Bank </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" step="0.01" value="<?php echo $actRevBank;?>" class="form-control" id="actualBank" placeholder="Actual Bank Amount" name="actualBank" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	
	        <div class="form-group">
	        	<label for="actualCc" class="col-sm-3 control-label">Credit Card </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" step="0.01" value="<?php echo $actRevCc;?>" class="form-control" id="actualCc" placeholder="Actual Credit Card Amount" name="actualCc" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createEODBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navInventory').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });

	// submit brand form function
	$("#submitEODForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			


			var form = $(this);
			// button loading
			$("#createEODBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createEODBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						// revenueTable.ajax.reload(null, false);			

  	  			// reset the form text
						$("#submitEODForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-eod-messages').html('<div class="alert alert-success">'+
					'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				'</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(1000).hide(10, function() {
								$(this).remove();
							location.href= "dashboard.php";			
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	

		return false;
	}); // /submit brand form function

	
	// submit brand form function
	$("#submitInventoryForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			


			var form = $(this);
			// button loading
			$("#createInventoryBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createInventoryBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						// revenueTable.ajax.reload(null, false);			

  	  			// reset the form text
						$("#submitInventoryForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-inventory-messages').html('<div class="alert alert-success">'+
					'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				'</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(1000).hide(10, function() {
								$(this).remove();
							location.href= "inventory.php";			
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	

		return false;
	}); // /submit brand form function

    });
</script>

<?php 
$connect->close();
require_once 'includes/footer.php'; ?>