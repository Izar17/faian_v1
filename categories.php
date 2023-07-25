<?php
require_once 'includes/header.php';
$brandId = $_GET['brandId'];
$brandType = $_GET['brandType'];


$sql = "SELECT b.brand_name from brands b  where b.brand_id = $brandId";
$result = $connect->query($sql);
while ($row = $result->fetch_row()) {
	list($brandName) = $row;
}
?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li class="active">Category</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"><a href="brand.php"><i class="glyphicon glyphicon-circle-arrow-left"></i></a>
					Manage Sub Categories |
					<?php echo $brandName; ?>
				</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addCategoriesModalBtn"
						data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Sub
						Categories </button>
				</div> <!-- /div-action -->
				<input type="hidden" value="<?php echo $brandId; ?>" id="brandId" />
				<input type="hidden" value="<?php echo $brandType; ?>" id="brandType" />
				<table class="table" id="manageCategoriesTable">
					<thead>
						<tr>
							<th>Sub Categories Name</th>
							<th>Grams/Quantity</th>
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


<!-- add categories -->
<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitCategoriesForm" action="php_action/createCategories.php"
				method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Sub Categories</h4>
				</div>
				<div class="modal-body">

					<div id="add-categories-messages"></div>

					<div class="form-group">
						<label for="categoriesName" class="col-sm-4 control-label">Sub Categories Name: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="categoriesName" placeholder="Categories Name"
								name="categoriesName" autocomplete="off">

							<input type="hidden" name="brandId" value="<?php echo $brandId; ?>" />
							<input type="hidden" name="brandType" value="<?php echo $brandType; ?>" />
							<input type="hidden" value="1" id="categoriesStatus" name="categoriesStatus" />
						</div>
					</div> <!-- /form-group-->
						<?php if ($brandType == 1) { 
							$bType = 'Grams';
						 ?>
						 <input type="hidden" class="form-control" id="price" placeholder="Price" name="price" autocomplete="off">
						 <?php } else {
							$bType = 'Quantity';
						?>
							<div class="form-group">
								<label for="price" class="col-sm-4 control-label">Price</label>
								<label class="col-sm-1 control-label">: </label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="price" placeholder="Price" name="price"
										autocomplete="off">
								</div>
							</div> <!-- /form-group-->
						<?php } ?>
						<div class="form-group">
							<label for="quantity" class="col-sm-4 control-label"><?php echo $bType;?></label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="quantity" placeholder="<?php echo $bType;?>" name="quantity"
									autocomplete="off">
								<input type="hidden" value="1" id="productStatus" name="productStatus" />
							</div>
						</div> <!-- /form-group-->
				</div> <!-- /modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i
							class="glyphicon glyphicon-remove-sign"></i> Close</button>

					<button type="submit" class="btn btn-primary" id="createCategoriesBtn"
						data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i>
						Save Changes</button>
				</div> <!-- /modal-footer -->
			</form> <!-- /.form -->
		</div> <!-- /modal-content -->
	</div> <!-- /modal-dailog -->
</div>
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="editCategoriesForm" action="php_action/editCategories.php" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Brand</h4>
				</div>
				<div class="modal-body">

					<div id="edit-categories-messages"></div>

					<div class="modal-loading div-hide"
						style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

					<div class="edit-categories-result">
						<div class="form-group">
							<label for="editCategoriesName" class="col-sm-4 control-label">Sub Categories Name: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="editCategoriesName"
									placeholder="Categories Name" name="editCategoriesName" autocomplete="off">
								<input type="hidden" value="<?php echo $brandId; ?>" name="editBrandId" />
								<input type="hidden" value="<?php echo $brandType; ?>" name="editBrandType" />
							</div>
						</div> <!-- /form-group-->
						<?php if ($brandType == 1) { 
							$bType = 'Grams';
						 ?>
						 <input type="hidden" class="form-control" id="editPrice" placeholder="Price" name="editPrice" autocomplete="off">
						 <?php } else {
							$bType = 'Quantity';
						?>
							<div class="form-group">
								<label for="editPrice" class="col-sm-4 control-label">Price</label>
								<label class="col-sm-1 control-label">: </label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="editPrice" placeholder="Price" name="editPrice"
										autocomplete="off" required>
								</div>
							</div> <!-- /form-group-->
						<?php } ?>
						<div class="form-group">
							<label for="editQuantity" class="col-sm-4 control-label"><?php echo $bType;?></label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="editQuantity" placeholder="<?php echo $bType;?>" name="editQuantity"
									autocomplete="off" required>
							</div>
						</div> <!-- /form-group-->
						<div class="form-group">
							<label for="editCategoriesStatus" class="col-sm-4 control-label">Status: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-7">
								<select class="form-control" id="editCategoriesStatus" name="editCategoriesStatus">
									<option value="">~~SELECT~~</option>
									<option value="1">Available</option>
									<option value="2">Not Available</option>
								</select>
							</div>
						</div> <!-- /form-group-->
					</div>
					<!-- /edit brand result -->

				</div> <!-- /modal-body -->

				<div class="modal-footer editCategoriesFooter">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i
							class="glyphicon glyphicon-remove-sign"></i> Close</button>

					<button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..."
						autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				</div>
				<!-- /modal-footer -->
			</form>
			<!-- /.form -->
		</div>
		<!-- /modal-content -->
	</div>
	<!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Brand</h4>
			</div>
			<div class="modal-body">
				<p>Do you really want to remove ?</p>
			</div>
			<div class="modal-footer removeCategoriesFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i
						class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading...">
					<i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/categories.js"></script>

<?php require_once 'includes/footer.php'; ?>