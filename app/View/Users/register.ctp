<!-- REGISTRATION FORM -->
<div class="text-center" style="padding:50px 0">
	<div class="logo">register</div>
	<!-- Main Form -->
	<div class="login-form-1">
		
		<?php echo $this->Form->create('Users', array(
										'url' => array('action' => 'register'),
										'inputDefaults' => array(
											'format' => array('before', 'error', 'label', 'between', 'input', 'after')
										)
					)); ?>
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<?php
						echo $this->Form->inputs(array(
							'legend' => __(''),
							'Users.name' => array(
								'autofocus' => 'autofocus',
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'Name'
							),
							'Users.email' => array(
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'Email'
							),
							'Users.tmp_password' => array(
								'type' => 'password',
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'Password'
							),
							'Users.password_confirm' => array(
								'type' => 'password',
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'Confirm Password'
							)
						));
					?>					
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
				
			</div>
			<div class="etc-login-form">
				<p>already have an account? <a href="<?php echo Router::url('/users/login', false) ?>">login here</a></p>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<!-- end:Main Form -->
</div>
<script>
	(function(){
		$(document).ready(function(){
			var HOST = window.location.host;
			var result = false;
			jQuery.validator.addMethod("checkEmail", function(value, element) {
				// console.log(value);
				
			    $.ajax({
			    	url: 'http://'+HOST+ '/msgboard/users/checkEmail/' + value,
			    	cache: false,
			    	error: function(){console.log('error')},
			    	success: function(data){
			    		console.log(data);
			    		if(data == 'true')
			    			result = false;
			    		else
			    			result = true;
			    	}
			    });
			    return result;
			}, "Email already exists!");

			$('#UsersRegisterForm').validate({
				rules: {
					'data[Users][name]': {
						required: true,
						rangelength: [5, 20]
					},
					'data[Users][email]': {
						required: true,
						checkEmail: true
					},
					'data[Users][tmp_password]': "required",
					'data[Users][password_confirm]': {
						equalTo : "#UsersTmpPassword"
					}

				},
				messages: {
					'data[Users][name]': "Name size must be 5 to 20",
					'data[Users][password_confirm]': "Password did not match!"
				},
				submitHandler: function(form) {
					
					var output = "";
					output += '<div id="dialog-confirm" title="Confirm submission?" style="display: none;">';
					output += '<b>Name: </b>';
					output += '<p>' + $(form).find('input#UsersName').val() + '</p>';
					output += '<b>Email: </b>';
					output += '<p>' + $(form).find('input#UsersEmail').val() + '</p>';
					output += '</div>';
					$('body').append(output);
					
					// console.log(form);
					// console.log($(form).find('input#UsersName').val());
					// var hays = 
					// $.each($(form).find('input'), function(key, val){
					// 	console.log(key);
					// });
					// var result = confirm("Confirm Update");
					// if(result)
					// $('')
					$( "#dialog-confirm" ).dialog({
				      resizable: false,
				      height: "auto",
				      width: 400,
				      modal: true,
				      buttons: {
				        "Back": function() {
				          $( this ).dialog( "close" );
				        },
				        "Confirm": function() {
				        	form.submit();
				          $( this ).dialog( "close" );
				        }
				      }
				    });
				    	
				    // else
				    // 	window.location.href = window.location.href;
				}
			});

		});
	})();
</script>