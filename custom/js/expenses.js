var manageExpensesTable;

$(document).ready(function() {
	// top bar active
	$('#navInventory').addClass('active');
	
	// manage brand table
	manageExpensesTable = $("#manageExpensesTable").DataTable({
		'ajax': 'php_action/fetchExpenses.php',
		'order': []		
	});

	// submit brand form function
	$("#submitLayawayForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			


			var form = $(this);
			// button loading
			$("#createLayawayBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createLayawayBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageExpensesTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitLayawayForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-layaway-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	

		return false;
	}); // /submit brand form function

});

// select brandType
function selectType(select){	
	
	if(select.value == 1){
		document.getElementById('perGram').style.display = "block";
	} else {
		document.getElementById('perGram').style.display = "none";
	}
	
}


// end add categories function
function editExpenses(expensesId = null) {
	if(expensesId) {
		// remove hidden expenses id text
		$('#expensesId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-expenses-result').addClass('div-hide');
		// modal footer
		$('.editExpensesFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedExpenses.php',
			type: 'post',
			data: {expensesId : expensesId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-expenses-result').removeClass('div-hide');
				// modal footer
				$('.editExpensesFooter').removeClass('div-hide');

				$('#editDetail').val(response.details);
				$('#editAmount').val(response.amount);
				$('#editPaidBy').val(response.paid_by);
				$('#editReceivedBy').val(response.received_by);
				$('#editPaymentType').val(response.payment_type);
				$('#editReferenceNo').val(response.reference_no);
				$('#editExpenseId').val(response.ex_id);

				// expenses id 
				$(".editExpensesFooter").after('<input type="hidden" name="expensesId" id="expensesId" value="'+response.id+'" />');

				// update expenses form 
				$('#editExpensesForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');		

						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									manageExpensesTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-expenses-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax		

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function removeExpenses(expensesId = null) {
	if(expensesId) {
		$('#removeExpensesId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedExpenses.php',
			type: 'post',
			data: {expensesId : expensesId},
			dataType: 'json',
			success:function(response) {


				$('.removeExpensesFooter').after('<input type="hidden" name="removeExpensesId" id="removeExpensesId" value="'+response.id+'" /> ');

				// click on remove button to remove the brand
				$("#removeExpensesBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeExpensesBtn").button('loading');

					$.ajax({
						url: 'php_action/removeExpenses.php',
						type: 'post',
						data: {expensesId : expensesId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeExpensesBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeExpensesModal').modal('hide');

								// reload the brand table 
								manageExpensesTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removeExpensesFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function