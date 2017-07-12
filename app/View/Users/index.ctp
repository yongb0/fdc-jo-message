<div>
	<h1>user Profile</h1>
	 <?php 	
	 		
	?>
</div>
<div class="profile-view">
	<div class="container">	
		<div class="row top">
			<div class="col-md-4 profile-pic">
				<div class="pic-container">
					
					<?php if (file_exists(WWW_ROOT .'img/files/' . $userID . '.png')) { ?>
						<?php echo $this->Html->image('files/' . $userID . '.png'); ?>
					<?php } else { ?>
						<img src="https://freeiconshop.com/wp-content/uploads/edd/person-solid.png">
					<?php } ?>
					<div class="button"><a href="#" id="edit-propic-btn"> Edit </a></div>
				</div>
			</div>
			
			<?php echo $this->Form->create(false, array(
			'url' => array('controller' => 'Users', 'action' => 'updateProfile'),
			'id' => 'updateProfile',
			)); ?>
			<div class="col-md-8 profile-details">
				<table>
					<tr>
						<td>
							<div class="form-view">
								<b><?php echo $userData['Users']['name']; ?></b>
							</div>
							<div class="form-edit">
								<input type="text" value="<?php echo $userData['Users']['name']; ?>" class="form-edit" name="name" autofocus required>
							</div>
						</td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td>
							<div class="form-view">
								<?php
									if ($userData['Users']['gender'] == 1)
										echo 'Male';
									else if ($userData['Users']['gender'] == 2)
										echo 'Female';
								?>	
							</div>
							<div class="form-edit">
							<?php $gFlag = $userData['Users']['gender']; ?>
								<input type="radio" name="gender" value="1" <?php if($gFlag == 1) echo 'checked' ?>> Male
  								<input type="radio" name="gender" value="2" <?php if($gFlag == 2) echo 'checked' ?>> Female
  								<input type="radio" name="gender" value="" <?php if(!$gFlag) echo 'checked' ?>> Other
							</div>
						</td>
					</tr>
					<tr>
						<td>Birthdate:</td>
						<td class="form-view">
							<div>
								<?php 
								$Birthdate = $userData['Users']['birthdate'];
								$userData['Users']['birthdate'] ? $Birthdate = $userData['Users']['birthdate']  : '' ;
								echo date('F d, Y', strtotime($Birthdate)); ?>
							</div>
						</td>
						<td class="form-edit">
							<div>
								<input type="text" id="datepicker" class="datepicker" name="birthdate" value="<?php echo $Birthdate; ?>" required>
							</div>
						</td>
					</tr>
					<tr>
						<td>Joined:</td>
						<td><?php 
								$THE_DATE = $userData['Users']['created'];
								$THE_DATE_TIME = explode(" ", $THE_DATE)[0]; //'2017-06-27';
								$date = date('F d, Y', strtotime($THE_DATE_TIME));
						  		echo $date . " " . date_format(date_create($THE_DATE), 'G:ia');
							?></td>
					</tr>
					<tr>
						<td>Last Login:</td>
						<td><?php
								$LAST_LOGIN =  $userData['Users']['last_login_time'];
								$LAST_LOGIN_TIME = explode(" ", $LAST_LOGIN)[0];
								$date = date('F d, Y', strtotime($LAST_LOGIN_TIME));
						  		echo $date . " " . date_format(date_create($LAST_LOGIN), 'G:ia');
						?></td>
					</tr>
				</table>
				<a href="" class="btn btn-primary update-profile" >Edit Profile</a>
				<input type="submit" name="submit" value="Update" class="btn btn-success update-btn">
				
				<?php echo $this->Html->link('Cancel', array('controller'=>'Users', 'action'=>'index'), array('class' => 'btn btn-danger cancel-btn')); ?>
				<?php echo $this->Html->link('Change Password', array('controller'=>'Users', 'action'=>'changePass'), array('class' => 'btn btn-info changepass-btn')); ?>
			</div>
			<!-- For Edit profile -->
		</div>
	</div>

	<div class="container">
		
		<div class="row bottom">
		<div class="col-md-12 hubby">
			<p>Hubby:</p>
			<div class="form-view">
				<p><?php echo $userData['Users']['hubby']; ?></p>
			</div>
			<div class="form-edit">
				<textarea name="hubby" required aria-required="true"><?php echo $userData['Users']['hubby']; ?></textarea>
			</div>
		</div>	
	</div>
	</div>
	<?php echo $this->Form->end(); ?>

	<?php echo $this->Form->create('Users',array(
			'type' => 'file',
			'enctype' => 'multipart/form-data',
			'url' => array('controller' => 'Users', 'action' => 'updatePropic'),
			'id' => 'update_profile_pic'
		)); ?>
		<div class="propic_form">
			<input type="file" name="data[Users][image]" id="UsersImage" accept="image/x-png,image/gif,image/jepg" style="visibility: hidden;">
		
		 <?php echo $this->Form->button(__('Save Image'), ['type'=>'submit', 'class' => 'btn btn-success update-btn-pro']); ?>
		</div>
		<?php // echo $this->Form->input('image', ['type' => 'file']); ?>

	<?php echo $this->Form->end(); ?>

</div>
<script>
	(function(){
		$(document).ready(function(){

			var fruits = ["Banana", "Orange", "Apple", "Mango"];
			console.log(fruits.indexOf("Appsle"));
			if (fruits.indexOf("Orange") != -1)
				console.log('naa');
			else
				console.log('wala');
			// var a = fruits.indexOf("Apple");

			jQuery.validator.addMethod("checkExtension", function(value, element) {
				var fruits = ["png", "gif", "jpg"];
				var ext = value.split('.');
				console.log(ext[ext.length-1]);

				if (fruits.indexOf(ext[ext.length-1]) != -1)
					return true;
				else
					return false;
			}, "Image accept only .png, .gif and .jpg");

			// profile pic validation...
			$('#update_profile_pic').validate({
				rules: {
					'data[Users][image]': {checkExtension: true}
				}
			});

			$( "#datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true,
				yearRange: '-40:+0'
			});
			
			// profie details validation...
			$('#updateProfile').validate({
				rules: {
					name: "required",
					birthdate: "required",
					hubby: {
						required: true,
						minlenght: 8
					}
				},
				messages: {
					name: "Name is required",
					birthdate: "Birthday requried",
					hubby: "Hubby pud",
				}
			});
		});
	})();
</script>