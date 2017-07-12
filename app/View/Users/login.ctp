<div class="text-center" style="padding:50px 0">
	<div class="logo">Message Board Login</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<?php echo $this->Form->create('Users', array(
						'url' => array(
							'controller' => 'Users',
							'action' => 'login'
						))); ?>
						
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<!-- <input type="text" class="form-control" id="email" name="email" placeholder="Email" autofocus> -->
						<?php
							echo $this->Form->input(
								'Users.email', 
									array(
										'autofocus' => 'autofocus',
										'label' => false,
										'required' => false,
										'div' => false,
										'class' => 'form-control',
										'placeholder' => 'Email'
									)); ?>
					</div>
					<div class="form-group">
						<!-- <input type="password" class="form-control" id="password" name="password" placeholder="password"> -->
						<?php
							echo $this->Form->input(
								'Users.password', 
									array(
										'label' => false,
										'required' => false,
										'div' => false,
										'class' => 'form-control',
										'placeholder' => 'Password'
									)); ?>
					</div>
					<div class="form-group login-group-checkbox">
						<input type="checkbox" id="lg_remember" name="lg_remember">
						<label for="lg_remember">remember</label>
					</div>
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>forgot your password? <a href="#">click here</a></p>
				<p>new user? <a href="<?php echo Router::url('/users/register', false) ?>">create new account</a></p>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<!-- end:Main Form -->
</div>