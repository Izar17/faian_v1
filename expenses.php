<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Expenses</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Expenses</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addLayawayModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageExpensesTable">
					<thead>
						<tr>							
							<th>Expenses Detail</th>
							<th>Amount</th>
							<th>Paid By</th>
							<th>Received By</th>
							<th>Reference No.</th>
							<th>Date</th>
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
    	
    	<form class="form-horizontal" id="submitLayawayForm" action="php_action/createExpenses.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Expenses</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="add-layaway-messages"></div>
	        <div class="form-group">
	        	<label for="expensesDetail" class="col-sm-3 control-label">Expenses Detail </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="detail" placeholder="Expenses Detail" name="detail" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
	        <div class="form-group">
	        	<label for="amount" class="col-sm-3 control-label">Amount</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
	        <div class="form-group">
	        	<label for="paidBy" class="col-sm-3 control-label">Paid By</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="paidBy" placeholder="Paid By" name="paidBy" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
	        <div class="form-group">
	        	<label for="receivedBy" class="col-sm-3 control-label">Received By</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="receivedBy" placeholder="Received By" name="receivedBy" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
	        	<label class="col-sm-1 control-label">: </label>
			    <div class="col-sm-8">
			      <select class="form-control" name="paymentType" id="paymentType">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cash</option>
			      	<option value="2">E-Walet</option>
			      	<option value="3">Bank</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->	
	        <div class="form-group">
	        	<label for="referenceNo" class="col-sm-3 control-label">Reference No.</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="referenceNo" placeholder="Optional" name="referenceNo" autocomplete="off"/>
				    </div>
	        </div> <!-- /form-group-->		  
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createLayawayBtn" data-loading-text="Loading..." autocomplete="off">Save Expenses</button>
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

<!-- edit Expenses -->
<div class="modal fade" id="editExpensesModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" id="editExpensesForm" action="php_action/editExpenses.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Expenses</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="edit-expenses-messages"></div>
	        <div class="form-group">
	        	<label for="expensesDetail" class="col-sm-3 control-label">Expenses Detail </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					  <input type="hidden" id="editExpenseId" name="editExpenseId"/>
				      <input type="text" class="form-control" id="editDetail" placeholder="Expenses Detail" name="editDetail" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
	        <div class="form-group">
	        	<label for="amount" class="col-sm-3 control-label">Amount</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editAmount" placeholder="Amount" name="editAmount" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
	        <div class="form-group">
	        	<label for="paidBy" class="col-sm-3 control-label">Paid By</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editPaidBy" placeholder="Paid By" name="editPaidBy" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
	        <div class="form-group">
	        	<label for="receivedBy" class="col-sm-3 control-label">Received By</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editReceivedBy" placeholder="Received By" name="editReceivedBy" autocomplete="off" required/>
				    </div>
	        </div> <!-- /form-group-->	 
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
	        	<label class="col-sm-1 control-label">: </label>
			    <div class="col-sm-8">
			      <select class="form-control" name="editPaymentType" id="editPaymentType">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cash</option>
			      	<option value="2">E-Walet</option>
			      	<option value="3">Bank</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->	
	        <div class="form-group">
	        	<label for="referenceNo" class="col-sm-3 control-label">Reference No.</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editReferenceNo" placeholder="Optional" name="editReferenceNo" autocomplete="off"/>
				    </div>
	        </div> <!-- /form-group-->	
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editExpensesFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editExpensesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /edit Expenses -->

<!-- remove Expenses -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeExpensesModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Expenses</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove Expenses?</p>
      </div>
      <div class="modal-footer removeExpensesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeExpensesBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove Expenses -->

<script src="custom/js/expenses.js"></script>

<?php require_once 'includes/footer.php'; ?>