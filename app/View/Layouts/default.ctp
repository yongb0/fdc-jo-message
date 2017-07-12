<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');

		// echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
		echo $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
		echo $this->Html->script('https://code.jquery.com/jquery-3.1.1.min.js');
		// echo $this->Html->script('https://code.jquery.com/jquery-1.12.4.js');
		// echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js');

		echo $this->Html->css('style');
		echo $this->Html->script('script');

		$currentPage = explode("/", $this->here);
		// echo $this->params['controller'];
		if ($this->params['action'] == 'login' || $this->params['action'] == 'register') {

			echo $this->Html->css('login');
			
		}
		if ($this->params['controller'] == 'users' || $this->params['controller'] == 'Users') {
			echo $this->Html->css('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
			echo $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.js');
			echo $this->Html->script('jquery.validate.min');
		}
		if ($this->params['controller'] == 'msg') {
			echo $this->Html->css('conversation');
			echo $this->Html->script('notify');
			echo $this->Html->script('push.min');
			echo $this->Html->css('chat');
		}
		if ($this->params['action'] == 'newMessage') {
			echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css');
			echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js');
		}

	?>
</head>
<body id="<?php echo strtolower($this->params['controller'] . $this->params['action']); ?>">
	<div id="container" class="main-container">
		<?php
			
			if($this->params['action'] != 'login' && $this->params['action'] != 'register'
				&& $this->params['action'] != 'thankyou') {
				?>
				<div id="header">
					<nav class="navbar navbar-default">
					  <div class="container-fluid">
					    <div class="navbar-header">
					      <a class="navbar-brand" href="#">Message Board</a>
					    </div>
					    <ul class="nav navbar-nav">
					      <li class="<?php if($this->params['controller'] == 'users' || $this->params['controller'] == 'Users') echo 'active' ?>"><?php echo $this->Html->link('Home', array('controller'=>'users', 'action'=>'index')); ?></li>
					      <li class="<?php if($this->params['controller'] == 'msg' && $this->params['action'] != 'pagei') echo 'active' ?>" ><?php echo $this->Html->link('Messages', array('controller'=>'msg', 'action'=>'index')); ?></li>
					      <li class="<?php if($this->params['action'] == 'pagei') echo 'active' ?>" ><?php echo $this->Html->link('Pagination', array('controller'=>'msg', 'action'=>'pagei')); ?></li>
					      <li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout')); ?></li>
					    </ul>
					  </div>
					</nav>
				</div>
				<?php
			}
		?>
		
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php //echo $this->Html->link(
					//$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					//'http://www.cakephp.org/',
					//array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				//);
			?>
			<p>
				<?php //echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
