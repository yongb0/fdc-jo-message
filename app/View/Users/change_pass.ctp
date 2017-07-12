<!-- Change password -->
<div class="text-center" style="padding:50px 0">
	<div class="logo">Change Password</div>
	<!-- Main Form -->
	<div class="login-form-1">
		
		<?php echo $this->Form->create(false, array(
			'url' => array('controller' => 'users', 'action' => 'doChangePass'),
			'id' => 'changePass'
			)); ?>
			
			<div class="change-password-group">

				<div class="form-group">
					<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" autofocus>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="New Password">
				</div>
				<input type="submit" name="submit" class="btn btn-success" value="Update">
				
			</div>
			
		<?php echo $this->Form->end(); ?>
	</div>
	<!-- end:Main Form -->
</div>

<script>
	(function(){
		$(document).ready(function(){
			var HOST = window.location.host;
			// var oldpass = $('#old_password').val();

			// $('#old_password').keyup(function(){
			// 	oldpass = $('#old_password').val();
			// });
			var result = false;
			jQuery.validator.addMethod("checkPassword", function(value, element) {
				console.log(value);
				
			    $.ajax({
			    	url: 'http://'+HOST+ '/msgboard/users/checkPassword/' + value,
			    	error: function(){console.log('error')},
			    	success: function(data){
			    		console.log(data);
			    		if(data == 'true')
			    			result = true;
			    		else
			    			result = false;
			    	}
			    });
			    return result;
			}, "Password is incorrect!");

			$('#changePass').validate({
				rules: {
					old_password: {checkPassword : true},
					new_password: "required",
					password: {
						equalTo : "#new_password"
					}
				},
				messages: {
					old_password: "Old Password is incorrect!",
					new_password: "New Password is required",
					password: "Password did not match!",
				},
				// errorClass: "error_class",
				// errorPlacement: function(error, element){
				// 	console.log(error);
				// 	console.log(element);
				// },
				submitHandler: function(form) {
					console.log(form);
					var result = confirm("Confirm Update");
					if(result)
				    	form.submit();
				    else
				    	window.location.href = window.location.href;
				}
			});
		});
	})();
</script>