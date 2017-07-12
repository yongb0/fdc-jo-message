<div>
	<?php
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	?>
	<?php  echo $this->Paginator->numbers(array('first' => 'First page')); ?>
</div>