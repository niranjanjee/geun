<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery.fileupload.css">
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.fileupload.js"></script>
<section class="clearfix mymessages" id="myaccount-section">
	<div class="container">
	  <div class="row">
		<div class="col-xs-12 account-nav">
		  <?php $this->load->view('myaccount_nav_view');?>
		</div>
	  </div>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="inner-wrapper clearfix">
			<h3>My Messages</h3>
			<?php if($this->session->flashdata('mymessage_msg')){?>
			<p class="bg-success"><?php echo $this->session->flashdata('mymessage_msg');?></p>
			<?php }
			else
			{
				echo "<p>&nbsp;</p>";
			}?>
			<div class="message-wrapper">
				<div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>Sender</th>
							<th>Receiver</th>
                            <th>Message</th>
							<th>Date</th>
                            <th>Replied</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
						if(count($messages) > 0){
							foreach($messages as $m)
							{?>
							<tr>
							  <td>
							  <?php 
							  
							  if($this->session->user['id'] == $m->sender_id)
							  {
								echo '<span class="text-primary">You</span>';
							  }
							  else{
								echo ucwords($m->sender);
							  }
							  ?>
							  </td>
							  <td>
							  <?php 
							  if($this->session->user['id'] == $m->receiver_id)
							  {
								echo '<span class="text-primary">You</span>';
							  }
							  else{
								echo ucwords($m->reciever);
							  }
							  ?>
							  </td>
							  <td>
							  <?php echo substr($m->message, 0, 60)."...";?>
							   <a href="#" class="view-more" data-toggle="popover" data-trigger="hover"  data-content="<?php echo $m->message;?>.">view</a>
							  </td>
							  <td><?php echo get_date_format($m->created_at);?></td>
							  <td>
							  <?php 
							  if($m->is_replied == 1)
							  {
								echo '<span class="label label-success">Yes</span>';
							  }
							  else
							  {
								echo '<span class="label label-danger">No</span>';
							  }
							  ?>
							  </td>
							  <td>
							  <?php 
								if(($this->session->user['id'] == $m->sender_id) || ($m->is_replied == 1))
								{
									$reciever_id = $m->receiver_id;
									$rel = 0;
									if(($m->is_replied == 1 && $this->session->user['id'] == $m->receiver_id))
									{
										$rel = 1;
										$reciever_id = $m->sender_id;
									}								
							?>
							<a class="btn btn-default view" rel="<?php echo $rel;?>" relrec="<?php echo $reciever_id;?>" relmsg ="<?php echo $m->id;?>"  href="javascript:void(0);">View						
							<?php
								}
								else
								{
							?>	
							<a class="btn btn-default view-reply" relrec="<?php echo $m->sender_id;?>" relmsg ="<?php echo $m->id;?>"  href="javascript:void(0);">View & Reply						
							<?php
								}
							?> 
							  </a></td>
							</tr>
							<?php }
						}
						else
						{
							echo '<tr><td colspan="4">You have no message.</td></tr>';
						}
						?>
                      </tbody>
                    </table>
					<div class="box-footer clearfix">
					  <ul class="pagination pagination-sm no-margin pull-right">
						<?php echo $pagination;?>
					  </ul>
					</div>
                </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </section>
  <div id="message-reply-popup" class="modal fade" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Message:</h4>
            </div>
            <div class="modal-body">
				<div id="message-body"></div>
				<div id="send-message-body" style="display:none;">
				<?php
				$attributes = array('method' => 'post', 'name' => 'messageboxform', 'id' => 'messageboxform', 'class' => 'form-horizontal', 'role' => 'form');
				echo form_open('/default/myaccount/sendmessage', $attributes);
				?>
				<textarea name="message" id="message-box" rows="4" cols="86" class="form-control"></textarea>
				<input type="hidden" name="reciever_h" id="reciever_h" value="" /> 
				<input type="hidden" name="mid_h" id="mid_h" value="" /> 				
				<?php echo form_close();?>	
				</div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
  <script>
  $(document).ready(function(){
	$('[data-toggle="popover"]').popover({
        placement : 'top'
    });
	$(".message-wrapper .view-reply, .message-wrapper .view").click(function(){
		$("#message-reply-popup #send-message-body textarea").val('');
		$("#message-reply-popup #send-message-body").hide();
		$("#message-reply-popup .modal-footer").html('');
		$("#message-reply-popup").modal("show");
		
		var obj = $(this);
		var reciever = obj.attr("relrec");
		var url = "/default/myaccount/getmessage";
		var rel = 0;
		if(obj.hasClass('view'))
		{
			rel = obj.attr("rel");
			url = "/default/myaccount/viewmessage";
		}
		
		var mid = obj.attr("relmsg");
		$.ajax({
			method:'POST',
			url:url,
			data:{"reciever":reciever, "mid":mid, "rel":rel,"ajax":1, "<?php echo $this->security->get_csrf_token_name()?>":"<?php echo $this->security->get_csrf_hash()?>"},
			dataType:'json',
			beforeSend:function(){
				$("#message-reply-popup #message-body").addClass("text-center");
				$("#message-reply-popup #message-body").html('<img src="<?php echo base_url();?>assets/front/img/ajax-loader2.gif" />');
			},
			success:function(response){
				$("#message-reply-popup #message-body").removeClass("text-center");
				if(response.status == "success")
				{
					$("#message-reply-popup #message-body").html('<p>'+response.message+'</p><p class="text-success"><small><strong>Sender:&nbsp;'+response.sender+'</strong>&nbsp;&nbsp;&nbsp;<strong>Date:&nbsp;</strong>'+response.date+'</small>');
					if(obj.hasClass('view') && response.reply_text != null)
					{
						$("#message-reply-popup #send-message-body").html('<h4 class="modal-title">Reply:</h4><p>'+response.reply_text+'</p><p class="text-success"><small><strong>Date:&nbsp;</strong>'+response.reply_date+'</small>');
						$("#message-reply-popup #send-message-body").show();
					}
					if(obj.hasClass('view-reply'))
					{
						$("#message-reply-popup #reciever_h").val(reciever);
						$("#message-reply-popup #mid_h").val(mid);
						$("#message-reply-popup #send-message-body").show();
						$("#message-reply-popup .modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary send-message">Reply</button>');
					}
				}
				else if(response.status == "failed")
				{
					$("#message-reply-popup #message-body").html('<p>Unable to fetch data</p>');
				}	
			},
			error:function(){
				alert("Unable to fetch data...")
				$("#message-reply-popup").modal("hide");
			}
		});
		
	});
	
	$("#messageboxform").validate({
		rules: {
			message: {
				required: true,
				maxlength:500
			},
		},
	});
	$("#message-reply-popup" ).on( "click", ".send-message", function() {
		var is_valid_form = $("#messageboxform").valid();
		if(!is_valid_form)
		{
			return false;
		}
		var message = $("#message-box").val();
		var reciever = $("#reciever_h").val();
		var mid = $("#mid_h").val();
		$.ajax({
			method:'POST',
			url:'/default/myaccount/sendmessage',
			data:{"reciever":reciever, "message":message, "mid":mid, "ajax":1, "<?php echo $this->security->get_csrf_token_name()?>":"<?php echo $this->security->get_csrf_hash()?>"},
			dataType:'json',
			beforeSend:function(){
				$("#message-reply-popup .modal-footer").html('<img src="<?php echo base_url();?>assets/front/img/ajax-loader2.gif" />');
			},
			success:function(response){
				if(response.status == "success")
				{
					location.href = "/default/myaccount/mymessages";
				}
				else if(response.status == "failed")
				{
					alert("Unable to send message");
					$("#message-reply-popup .modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary send-message">Reply</button>');
				}	
			},
			error:function(){
				alert("Unable to fetch data...")
				$("#message-reply-popup").modal("hide");
			}
		});
	});
  });
  </script>
