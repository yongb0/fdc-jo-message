
<h1>All conversation</h1>

<div class="conversation">
	<div class="col-sm-3 col-sm-offset-4">
		<a href="" class="go-search">Search</a>
	</div>
	<div class="col-sm-3 col-sm-offset-4 frame" id="main-list">
		<ul>
        <?php foreach($msgData1 as $index => $value){ ?>
        	<?php if($value['from_id'] == $Usersid || $value['to_id'] == $Usersid): ?>
        		<?php echo $value['owner_stat']; ?>
        		<?php if(strpos($value['owner_stat'], $Usersid) !== false): ?>
        	<li>
        		<div class="convo-container">
	        		<a href="<?php echo $this->webroot; ?>msg/viewConversation/<?php echo $value['to_id']  ?>/<?php echo $value['from_id'] ?>">
	        			<div class="convo">
	        			<div class="avatar">
	        			<?php if($value['from_id'] == $Usersid) : ?>
	        				<img class="img-circle" style="width:100%;max-height: 50px;" src="<?php echo '/msgboard/img/files/' . $Usersid . '.png'; ?>">
	        			<?php else: ?>
	        				<img class="img-circle" style="width:100%;max-height: 50px;" src="<?php echo '/msgboard/img/files/' . $value['from_id'] . '.png'; ?>">
	        			<?php endif; ?>
	        			</div>
	        			<div class="text text-l">
	        				<p><?php echo $value['content']; ?></p>
	        				<p><small><?php echo $value['modified'] ?></small></p>
	        			</div>
	        		</div>
	        		</a>
	        		<div id="delete-convo">
	        			<span style="display: none;"><?php echo $value['to_id'] ?></span>
	        			<span style="display: none;"><?php echo $value['from_id'] ?></span>
	        			<i class="fa fa-trash-o" aria-hidden="true"></i>
	        		</div>
        		</div>
        	</li>
        	<?php endif; ?>
        <?php endif; ?>
        	
        	<?php } ?>
        	
		</ul>
        <div>
            <div class="macro">
                <a href="<?php echo $this->webroot; ?>msg/newMessage" class="btn btn-default new-message">New Message</a>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-sm-offset-4 search-area frame">
		<input type="text" name="search" placeholder="Search" class="mytext search-value" id="search-input" autofocus>
		<ul>
			
		</ul>
    </div>
</div>
<script>
	(function(){
		$(document).ready(function(){
			var HOST = window.location.host;

			var myID = "<?php echo $Usersid; ?>";
			// delete convo
	        $('div#delete-convo').click(function(event){
	        	// event.preventDefault();
	        	// $('.loader-container').show();
	        	var txt;
	            var r = confirm("Confirm Delete!");
	            if (r == true) {
	                var _this = $(this);
	                var to_id = $(_this).find('span:nth-child(1)').html();
	                var from_id = $(_this).find('span:nth-child(2)').html();
	                console.log(from_id);
	                deleteConversation(to_id, from_id);
	            }
	        });

	        function deleteConversation (to_id, from_id) {
	        	var Usersid = "<?php echo $Usersid; ?>";
	        	$.ajax({
	        		url: 'http://'+HOST+'/msgboard/msg/deleteConversation/' + to_id + '/' + from_id,
	        		error: function(){},
	        		success: function(data){
	        			window.location.href = "/msg/";
	        		},
	        	});
	        }


	        $('a.go-search').click(function(event){
	        	if($(this).html() != 'Back') {
	        		event.preventDefault();
		        	$('.col-sm-3.col-sm-offset-4.search-area.frame').show();
		        	$('div#main-list').hide();
		        	$(this).html('Back');
	        	}
	        });
	        // search ...
	        $('#search-input').keyup(function(){
	        	var keyVal = $(this).val();
	        	if (keyVal.length > 1) {
	        		ajaxSearch(keyVal);
	        	}
	        	if (keyVal.length == 0) {
	        		console.log('empty');
	        		$('.col-sm-3.col-sm-offset-4.search-area.frame ul').html('');
	        	}

	        });

	        function ajaxSearch (keyVal) {
	        	$.ajax({
	        		url: 'http://'+HOST+'/msgboard/msg/msgJSON/',
	        		data: 'json',
	        		error: function(){},
	        		success: function(data){
	        			getSearch(data, keyVal);
	        		},
	        	});
	        }

	        function getSearch (data, keyVal) {
	        	var output = '';
	        	
	        	
	        	$.each(JSON.parse(data), function(key, val){
	        		if(val.content.indexOf(keyVal) >= 0) {
	        			if(val.from_id == myID) {
							output += '<li>';
	                        // output += '<a href="msg/sample/a:abcd&b:BBBB">';
	                            output += '<div class="msj-rta macro">';
	                                output += '<div class="avatar">';
	                                    output += '<img class="img-circle" style="width:100%;max-height: 50px" src="/msgboard/img/files/' + val.from_id +'.png">';
	                                output += '</div>';
	                                output += '<div class="text text-l">';
	                                    output += '<p>' + val.content + '</p>';
	                                    output += '<p><small>' + val.modified + '</small></p>';
	                                output += '</div>';
	                            output += '</div>';
	                            output += '<div id="delete-msg">';
	                                output += '<i class="fa fa-trash-o" aria-hidden="true"></i>';
	                                output += '<span style="display:none;">'+ val.id +'</span>';
	                            output += '</div>';
	                            // output += '</a>';
	                   		output += '</li>';
	        			} else {
	        				output += '<li>';
		                    // output += '<a href="msg/sample/a:abcd&b:BBBB">';
		                        output += '<div class="msj macro">';
		                            output += '<div class="text text-l">';
		                                output += '<p>' + val.content + '</p>';
		                                output += '<p><small>' + val.modified + '</small></p>';
		                            output += '</div>';
		                            output += '<div class="avatar">';
		                                output += '<img class="img-circle" style="width:100%;max-height: 50px" src="/msgboard/img/files/' + val.from_id +'.png">';
		                            output += '</div>';
		                        output += '</div>';
		                        // output += '</a>';
		                        output += '<div id="delete-msg">';
		                            output += '<i class="fa fa-trash-o" aria-hidden="true"></i>';
		                            output += '<span style="display:none;">'+ val.id +'</span>';
		                        output += '</div>';
		                    output += '</li>';
	        			}
	        			

                   		$('.col-sm-3.col-sm-offset-4.search-area.frame ul').html(output);
	        		}
	        	});
	        }
	        
		});
	})();
</script>