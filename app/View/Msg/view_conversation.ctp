<?php
       $_TO_ID;
       $_FROM_ID;
       
    ?>
<h1>All conversation</h1>
<div class="conversation">
    <div class="col-sm-3 col-sm-offset-4 frame">
    <div class="loader-container">
        <div class="loader"></div>
    </div>
        <ul class="con">
        <!--  -->
            
        </ul>
        <div>
        <?php
        
            echo $this->Form->create(false, array(
            'url' => array('controller' => 'msg', 'action' => 'sendMsg'),
            'id' => 'send-msg'
            ));

            if ($to_id == $myID) {
                $_FROM_ID = $to_id;
                $_TO_ID = $from_id;
            }else {
                $_FROM_ID = $from_id;
                $_TO_ID = $to_id;
            }
        ?>
            <div class="macro">
                <input type="hidden" name="to_id" value="<?php echo $_TO_ID ?>">
                <input type="hidden" name="from_id" value="<?php echo $_FROM_ID ?>">
                <input type="text" name="content" class="mytext" placeholder="Type a message" autofocus />
                <input type="submit" name="submit" value="Send">
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>  
   <!-- Trigger/Open The Modal -->
    <button id="myBtn">Open Modal</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <a href="" class="btn btn-default">Delete</a>
      </div>

    </div>
</div>
<script>
    (function(){
        $(document).ready(function(){
            var one = "<?php echo $_TO_ID ?>";
            var two = "<?php echo $_FROM_ID ?>";
            var myID = "<?php echo $myID ?>";
            var output = '';
            var HOST = window.location.host;
            console.log(HOST);

            /****** Notification *******/
            var isPageHidden = false;
            
            document.addEventListener("visibilitychange", function() {
                // console.log(document.hidden, document.visibilityState);
                if(document.hidden)
                    isPageHidden == false;
                else
                    isPageHidden == true;
            });
            
            // console.log(isPageHidden);

            document.addEventListener('DOMContentLoaded', function () {
              if (!Notification) {
                alert('Desktop notifications not available in your browser. Try Chromium.'); 
                return;
              }

              if (Notification.permission !== "granted")
                Notification.requestPermission();
            });

            function viewNotif () {
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notification = new Notification('Notification', {
                      icon: 'http://www.androidpolice.com/wp-content/uploads/2013/07/nexusae0_FloatingNotifications-Thumb.png',
                      body: "New message.",
                    });

                    notification.onclick = function () {
                      window.open("http://" + HOST + "/msgboard/msg");      
                    };
                }
            }
            /****** end notification ********/

            getMsg();
            function getMsg () {
                var currentSize = null;
                console.log(isPageHidden);
                setInterval(function(){
                    
                    output = '';                
                    $.ajax({
                        url: 'http://'+HOST+'/msgboard/msg/viewConversationjson/' + one + '/' + two,
                        dataType: 'json',
                        data: 'orderby=id&order=dsc',
                        error: function(){console.log('error');},
                        success: function(json){
                                    
                                    var sorted = json.sort(function (a, b) {
                                        if (a.id > b.id) {
                                            return 1;
                                        }
                                        if (a.created < b.created) {
                                            return -1;
                                        }
                                        return 0;
                                   });
                                    viewMsg(sorted);
                                    triggerLongpress();
                                    triggerDelonChat();
                                    $('.loader-container').hide();

                                    if(currentSize != null && currentSize < json.length)
                                       $.notify("New Messages");
                                    currentSize = json.length;
                        },
                    });
                },3000);
            }
            
            function viewMe (key, val) {
                    output += '<li>';
                        // output += '<a href="msg/sample/a:abcd&b:BBBB">';
                            output += '<div class="msj-rta macro">';
                                output += '<div class="avatar">';
                                    output += '<img class="img-circle" style="width:100%;" src="/msgboard/img/files/' + val.from_id +'.png">';
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
                }

                function viewOther (key, val) {
                    output += '<li>';
                    // output += '<a href="msg/sample/a:abcd&b:BBBB">';
                        output += '<div class="msj macro">';
                            output += '<div class="text text-l">';
                                output += '<p>' + val.content + '</p>';
                                output += '<p><small>' + val.modified + '</small></p>';
                            output += '</div>';
                            output += '<div class="avatar">';
                                output += '<img class="img-circle" style="width:100%;" src="/msgboard/img/files/' + val.from_id +'.png">';
                            output += '</div>';
                        output += '</div>';
                        // output += '</a>';
                        output += '<div id="delete-msg">';
                            output += '<i class="fa fa-trash-o" aria-hidden="true"></i>';
                            output += '<span style="display:none;">'+ val.id +'</span>';
                        output += '</div>';
                    output += '</li>';
                }

            function viewMsg (data) {

                // $.each(JSON.parse(data), function(key, val){
                $.each(data, function(key, val){

                    // console.log(val.content);
                    // console.log(val.id);
                    // console.log(val.modified);
                    if(val.owner_stat.indexOf(myID) > -1){
                        
                        if(val.from_id == myID)
                        viewMe(key, val);
                        else
                            viewOther(key, val);

                        $('.conversation ul').html(output);
                    }
                });
            }

            // Delete message
            function deleteMsg (id) {
                $.ajax({
                    url: 'http://'+HOST+'/msgboard/msg/deleteMsg/' + id,
                    error: function(){},
                    sucess: function(){

                    },
                });
            }

            // triger longpress event for delete msg
            function triggerLongpress () {
                var longpress = 3000;
                // holds the start time
                var start;

                // $('ul.con .msj-rta').click(function(){
                //     console.log('click');
                // });

                $('ul.con li').mousedown(function(){
                    console.log('mousedown');
                    start = new Date().getTime();
                });

                $('ul.con li').mouseleave(function(){
                    start = 0;
                });

                $('ul.con li').mouseup(function(){
                    if ( new Date().getTime() >= ( start + longpress )  ) {
                        console.log('long press');
                       deleteMsg();
                    } else {
                        console.log('short ra');
                    }

                });
            }

            // Trigger delete event on chat...
            function triggerDelonChat () {
                $('div#delete-msg').click(function(){

                    var txt;
                    var r = confirm("Confirm Delete!");
                    if (r == true) {
                        var _this = $(this);
                        var id = $(_this).find('span').html();
                        deleteMsg(id);
                    }

                });
            }

            setTimeout(function(){
                $("ul.con").animate({ scrollTop: $(document).height() }, 1000);
            },3200);

        });
    })();
</script>