var manageCustomerTable;

$(document).ready(function() {
	// top bar active
	$('#navCustomer').addClass('active');
	
	// manage brand table
	manageCustomerTable = $("#manageCustomerTable").DataTable({
		'ajax': 'php_action/fetchCustomer.php',
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
						manageCustomerTable.ajax.reload(null, false);						

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

// manage layawaya function
function manageLayaway(customerId = null) {
	if(brandId) {
		$.ajax({
		url: 'php_action/fetchSelectedCustomer.php',
		type: 'post',
		data: {brandId : brandId},
		dataType: 'json',
		success: function(response) {
			location.href= "categories.php?brandId="+brandId;
		
		},
		error: function(url) {
		   alert(error);
		}
		});
	}
}

// end add categories function
function editCustomer(customerId = null) {
	if(customerId) {
		// remove hidden customer id text
		$('#customerId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-customer-result').addClass('div-hide');
		// modal footer
		$('.editCustomerFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedCustomer.php',
			type: 'post',
			data: {customerId : customerId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-customer-result').removeClass('div-hide');
				// modal footer
				$('.editCustomerFooter').removeClass('div-hide');

				// setting the Customer name value 
				$('#editCustomerName').val(response.name);
				// setting the customer address value
				$('#editCustomerAddress').val(response.address);
				// setting the customer address value
				$('#editCustomerNumber').val(response.contact_number);
				// customer id 
				$(".editCustomerFooter").after('<input type="hidden" name="customerId" id="customerId" value="'+response.id+'" />');

				// update customer form 
				$('#editCustomerForm').unbind('submit').bind('submit', function() {

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
									manageCustomerTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-customer-messages').html('<div class="alert alert-success">'+
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

function removeCustomer(customerId = null) {
	if(customerId) {
		$('#removeCustomerId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedCustomer.php',
			type: 'post',
			data: {customerId : customerId},
			dataType: 'json',
			success:function(response) {


				$('.removeCustomerFooter').after('<input type="hidden" name="removeCustomerId" id="removeCustomerId" value="'+response.id+'" /> ');

				// click on remove button to remove the brand
				$("#removeCustomerBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeCustomerBtn").button('loading');

					$.ajax({
						url: 'php_action/removeCustomer.php',
						type: 'post',
						data: {customerId : customerId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeCustomerBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeCustomerModal').modal('hide');

								// reload the brand table 
								manageCustomerTable.ajax.reload(null, false);
								
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

		$('.removeCustomerFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function