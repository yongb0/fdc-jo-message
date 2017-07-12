
<h1>All conversation</h1>
<div class="conversation">
    <div class="col-sm-3 col-sm-offset-4 frame">
    	<?php
    		echo $this->Form->create(false, array(
			'url' => array('controller' => 'msg', 'action' => 'sendMsg'),
			'id' => 'send-msg'
			));
    	?>
        <input type="hidden" name="from_id" value="<?php echo $UserID ?>">
		<select class="js-example-basic-multiple" multiple="multiple" name="to_id">
		<?php foreach ($ids as $key => $value) {
            if($value['id'] != $UserID) { ?>
		      <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
            <?php } ?>
		<?php } ?>
		</select>

        <ul>
        <!--  -->
            
        </ul>
        <div>
            <div class="macro">
                <input type="text" class="mytext" placeholder="Type a message" name="content" />
                <input type="submit" name="submit" value="Send">
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>  
</div>
<script>
    (function(){
        $(document).ready(function(){
        	$(".js-example-basic-multiple").select2();
        });
    })();
</script>