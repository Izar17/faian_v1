<?php 
require_once 'includes/header.php'; 
$contId = $_GET['cont'];
if($contId == 1) { $contLabel = "Layaway";}
else if($contId == 2) { $contLabel = "Reservation";}
else if($contId == 3) { $contLabel = "For Pickup";}
else { $contLabel = "For Delivery";}
?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active"><?php echo $contLabel;?></li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage <?php echo $contLabel;?></div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				<div class="remove-messages"></div>
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal"  onclick="addLayaway(<?php echo $contId;?>)"> <i class="glyphicon glyphicon-plus-sign"></i> Add</button>
				</div> <!-- /div-action -->				
				<input type="hidden" id="contId" value="<?php echo $contId;?>"/>
				<table class="table" id="manageLayawayTable">
					<thead>
						<tr>							
							<th>Customer Name</th>
							<th>Address</th>
							<th>Contact No.</th>
							<th>Due Date</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addLayawayModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" id="submitLayawayForm" action="php_action/createLayaway.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Layaway</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="add-layaway-messages"></div>
	        <div class="form-group">
	        	<label for="customerName" class="col-sm-3 control-label">Customer Name </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                        <select class="form-control" id="customerName" placeholder="Full Name" name="customerName" autocomplete="off" required>
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
	        </div> <!-- /form-group-->	  
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createLayawayBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
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

<!-- edit Customer -->
<div class="modal fade" id="editCustomerModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCustomerForm" action="php_action/editLayaway.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Customer</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="edit-customer-messages"></div>
	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-customer-result">
			  <div class="form-group">
		        	<label for="editCustomerName" class="col-sm-3 control-label">Customer Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editCustomerName" placeholder="Customer Name" name="editCustomerName" autocomplete="off" readonly>
					    </div>
		        </div> <!-- /form-group-->	
				<div class="form-group">
					<label for="address" class="col-sm-3 control-label">Address</label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
						<input type="text" class="form-control" id="editCustomerAddress" placeholder="Address" name="editCustomerAddress" autocomplete="off" readonly/>
						</div>
				</div> <!-- /form-group-->	 
				<div class="form-group">
					<label for="customerNumber" class="col-sm-3 control-label">Contact Number </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
						<input type="text" class="form-control" id="editCustomerNumber" placeholder="Contact Number" name="editCustomerNumber" autocomplete="off" readonly/>
						</div>
				</div> <!-- /form-group-->	
				<div class="form-group">
					<label for="DueDate" class="col-sm-3 control-label">Due Date </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
						<input type="text" class="form-control" id="editDueDate" placeholder="Due Date" name="editDueDate" autocomplete="off" required/>
						</div>
				</div> <!-- /form-group-->	  
		      </div>         	        
		      <!-- /edit Customer result -->
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editCustomerFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>	        
	        <button type="submit" class="btn btn-success" id="editCustomerBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /edit Customer -->

<!-- remove Customer -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCustomerModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Customer</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove customer?</p>
      </div>
      <div class="modal-footer removeCustomerFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCustomerBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove Customer -->

<script src="custom/js/layaway.js"></script>

<?php require_once 'includes/footer.php'; ?>