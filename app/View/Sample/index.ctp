<!DOCTYPE html>
<html>
<head>
	<title>Sample</title>
</head>
<body>
	<div>
		<h1>Sample</h1>
		<?php echo $this->Form->create('sample', array(
			'url' => array('controller' => 'sample', 'action' => 'sampleValidate'),
			'id' => 'sampleValidate'
		)); ?>
			
			<?php echo $this->Form->input('Sample.title', array('size' => '60')); ?>
			<?php echo $this->Form->input('Sample.sub_title'); ?>
			<?php echo $this->Form->submit('Submit', array('formnovalidate' => true)); ?>
			
		<?php $this->Form->end(); ?>

		<div>
			<form>
				<?php
					echo $this->Form->inputs(array(
							'Username' => array(
								'autofocus' => 'autofocus',
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'User name'
							),
							'Email' => array(
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'Email'
							),
							'Address' => array(
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'Address'
							),
							'password' => array(
								'label' => false,
								'required' => false,
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'placeholder' => 'Password'
							)
					)); 
				?>
			</form>
		</div>
	</div>
</body>
</html>