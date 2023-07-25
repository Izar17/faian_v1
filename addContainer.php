<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
//$contId = $_GET['contId'];

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Order</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Order
		<?php } else if($_GET['o'] == 'manord') { 
			$orderId = $_GET['orderId'];
			$contId = $_GET['contId'];?>
			Manage Order
		<?php } // /else manage order ?>
  </li>
</ol>



<div class="success-messages pull-right"></div> <!--/success-messages-->
<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Payment Details";
	}
	?>	
</h4>


<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Order
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Payment Details
		<?php } ?>
		<div class=" pull-right">
			<?php echo date('m/d/Y');?>	    
		</div>  
	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { ?>			


  		<form class="form-horizontal" method="POST" action="php_action/createContainerOrder.php" id="createOrderForm">
			<div class="col-md-4">
			  <div class="form-group">
			    <label for="clientName" class="col-sm-5">Customer Name</label>
			    <div class="col-sm-7">
				  <select class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" onchange=" selectCustomer(this.value)"  required>
                            <option value="">~~SELECT~~</option>
                            <?php 
                            $sql = "SELECT id, name FROM customer WHERE status = 1";
                                    $result = $connect->query($sql);

                                    while($row = $result->fetch_array()) {
                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                    } // while
                                    
                            ?>
                        </select>
				</div>
			  </div> <!--/form-group-->
			</div>
			<div class="col-md-4">
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-4">Contact No.</label>
			    <div class="col-sm-7">
			      <input type="number" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off"  readonly/>
			    </div>
			  </div> <!--/form-group-->	
			</div>	
		  	<div class="col-md-4">
			  <div class="form-group">
			    <label for="orderDate" class="col-sm-3">Address</label>
			    <div class="col-sm-9">
				  <input type="hidden" class="form-control" id="orderDate" name="orderDate"value="<?php echo date('m/d/Y'); ?>" autocomplete="off"/>
			   	  <input type="text" class="form-control" id="address" placeholder="Address" readonly/>
			    </div>
			  </div> <!--/form-group-->
			</div>
			
			<div class="col-md-12">	
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:20%;">Category</th>
			  			<th style="width:15%;">Sub-Category</th>
			  			<th style="width:20%;">Product</th>
			  			<th style="width:10%;">Price/Gram</th>
			  			<th style="width:10%;">Available Grams/Qty</th>
			  			<th style="width:10%;">Actual Grams/Qty</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"><button type="button" class="btn btn-default " onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i></button></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td>
			  					<select class="form-control" style="width:100%;" name="brandName[]" id="brandName<?php echo $x; ?>" onchange="getBrandData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$brandSql = "SELECT * FROM brands WHERE brand_active = 1 AND brand_status = 1";
			  							$brandData = $connect->query($brandSql);

			  							while($row = $brandData->fetch_array()) {									 		
			  								echo "<option value='".$row['brand_id']."' id='changeBrand".$row['brand_id']."'>".$row['brand_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  				</td>  				
			  				<td>
			  					<select class="form-control"
								name="categoriesName[]" id="categoriesName<?php echo $x; ?>" onchange="getCategoriesData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  				</td>  				
			  				<td>
								<select class="form-control" style="width:100%" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>),0" >
									<option value="">~~SELECT~~</option>
								</select>
								
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" onkeyup="getTotal(<?php echo $x; ?>)" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
							<td style="padding-left:20px;padding-top:15px;">
			  					<div class="form-group">
									<p id="available_quantity<?php echo $x; ?>"></p>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" step="0.01" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>
			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
			</div>
			  <div class="col-md-4">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-4 control-label">Sub Amount</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  
				   <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-4 control-label">Total Amount</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="discount" class="col-sm-4 control-label">Discount</label>
				    <div class="col-sm-8">
				      <input type="number" value="0" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-4 control-label">Grand Total</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="vat" class="col-sm-4 control-label gst">VAT 0%</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vat" name="gstn" readonly="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div>	  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-8">	
				  <div class="form-group">
				    <div class="col-sm-3">
						<label for="clientContact" >Cash</label>
				    </div>
				    <div class="col-sm-3">
				    	<label for="clientContact">E-Wallet</label>
				    </div>
				    <div class="col-sm-3">
						<label for="clientContact">Bank</label>
				    </div>
				    <div class="col-sm-3">
						<label for="clientContact">Credit Card</label>
				    </div>
				  </div>
				  <div class="form-group">	
				    <div class="col-sm-3">
				      <input type="number" step="0.01" class="form-control" placeholder="Amount" name="cash" id="cash" onkeyup="paidCash()"/>
				    </div>
				    <div class="col-sm-3">
				      <input type="number" step="0.01" class="form-control" placeholder="Amount" name="gcash" id="gcash" onkeyup="paidGcash()"/>
				    </div>
				    <div class="col-sm-3">
				      <input type="number" step="0.01" class="form-control" placeholder="Amount" name="bank" id="bank" onkeyup="paidBank()"/>
				    </div>
				    <div class="col-sm-3">
				      <input type="number" step="0.01" class="form-control" placeholder="Amount" name="credit" id="credit" onkeyup="paidCreditCard()"/>
				    </div>
				  </div>
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" readonly/>
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Amount Due</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->						  
				   <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Order Type</label>
				    <div class="col-sm-4">
				      <!-- <select class="form-control" name="orderType" id="orderType" onchange="getOrderType(this)">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Layaway</option>
				      	<option value="2">Reservation</option>
				      	<option value="3">For Pick Up</option>
				      	<option value="4">For Delivery</option>
				      </select> -->
					  <div style="padding-top:7px">
						<?php
							if($contId == 1){ echo "Layaway"; } 
							else if ($contId == 2) { echo "Reservation"; }
							else if($contId == 3) { echo "For Pick Up"; }
							else { echo "For Delivery"; }
						?>
					  </div>
					  <input type="hidden" value="<?php echo $contId;?>" id="orderType" name="orderType"/>
				    </div>
					<!--due date-->	
					<label for="dueDate" id="layawayLabel" class="col-sm-2 control-label"  style="display:none;">Due Date</label>
					<div class="col-sm-3" id="layawayText" style="display:none;">
						<input type="text" class="form-control" id="dueDate" name="dueDate" value="<?php echo date('m/d/Y', strtotime("+3 months", strtotime(date('m/d/Y')))); ?>" autocomplete="off" required/>			    				  				  
					</div>
					<label for="dueDate" id="resLabel" class="col-sm-2 control-label"  style="display:none;">Pickup Date</label>
					<div class="col-sm-3" id="resText" style="display:none;">
						<input type="text" class="form-control" id="dueDate" name="dueDates" value="<?php echo date('m/d/Y', strtotime("+1 day", strtotime(date('m/d/Y')))); ?>" autocomplete="off" required/>			    				  				  
					</div>
				  </div> <!--/form-group-->	
				   <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">


				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="2">Advance Payment</option>
				      	<option value="3">Installment Payment</option>
				      	<option value="1">Full Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Place</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentPlace" id="paymentPlace">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">FAIAN WALTERMART NASUGBU BRANCH</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter pull-right">
			    <div class="col-sm-12">
			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Pay</button>
					
			      <button type="reset" class="btn btn-default" style="margin-left:20px;" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>

			</form>
			
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Order No.</th>
						<th>Client Name</th>
						<th>Contact</th>
						<th>Total Item</th>
						<th>Order Date</th>
						<th>Due Date</th>
						<th>Amount to Pay</th>
						<th>Due</th>
						<th>Total Paid</th>
						<th>Payment Status</th>
						<th>Option</th>
					</tr>
				</thead>
			</table>
			<input type="hidden" id="orderId" value="<?php echo $orderId;?>"/>
			<input type="hidden" id="contId" value="<?php echo $contId;?>"/>

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			<table class="table" id="manageOrderTabl">
				<thead>
					<tr>
						<th>#</th>
						<th>Order No.</th>
						<th>Customer Name</th>
						<th>Amount to Pay</th>
						<th>Paid Amount</th>
						<th>Remaining Due</th>
						<th>Payment Type</th>
						<th>Payment Status</th>
						<th>Paid Date/Time</th>
					</tr>
					
					<?php $orderId = $_GET['i'];
					$sql = "SELECT pd.order_id, c.name, pd.pay_amount, pd.type, pd.status, pd.paid, pd.due, pd.created_date FROM payment_details pd 
						inner join layaway_orders la on pd.order_id = la.order_id
						inner join customer c on la.client_name = c.id
						WHERE pd.order_id = {$orderId}";
					$result = $connect->query($sql);
					$n=1;
					while($row = $result->fetch_row()) {
					list($orderIds, $name, $payAmount, $type, $status, $paid, $due, $created_date) = $row;
					// active 
					if($type == 1) { 		
						$paymentType = "Cash";
					} else if($type == 2) { 		
						$paymentType  = "E-Wallet";
					} else if($type == 3) { 		
						$paymentType  = "Bank";
					} else { 		
						$paymentType  = "Credit Card";
					} 
					// active 
					if($status == 1) { 		
						$paymentStatus = "<label class='label label-success'>Fully Paid</label>";
					} else if($status == 2) { 		
						$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
					} else { 		
						$paymentStatus = "<label class='label label-warning'>Installment</label>";
					} 
					echo"
					<tr>
						<td>$n</td>
						<td>$orderIds</td>
						<td>$name</td>
						<td>$payAmount</td>
						<td>$paid</td>
						<td>$due</td>
						<td>$paymentType</td>
						<td>$paymentStatus</td>
						<td>$created_date</td>
					</tr>
					";
					$n++;
					}
					?>
				</thead>
			</table>

			<?php
		} // /get order else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cash</option>
			      	<option value="2">E-Walet</option>
			      	<option value="3">Bank</option>
			      	<option value="4">Credit Card</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="3">Installment Payment</option>
			      	<option value="1">Full Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  				  
      	        
      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> Release Item</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to release the item?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script src="custom/js/addContainer.js"></script>

<?php require_once 'includes/footer.php'; ?>


	