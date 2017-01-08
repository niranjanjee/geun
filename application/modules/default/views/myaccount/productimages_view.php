
<!--file upload css files-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/fileupload/jquery.fileupload.css">
<!--Light box css files-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/gems/blueimp-gallery.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/gems/bootstrap-image-gallery.css">
<!--file upload js files-->
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.ui.widget.js"></script> 
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.iframe-transport.js"></script> 
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.fileupload.js"></script>
<!--Light box js files-->
<script src="<?php echo base_url(); ?>assets/front/js/gems/blueimp-gallery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/gems/bootstrap-image-gallery.min.js"></script>

<section class="clearfix productimages" id="myaccount-section">
	<div class="container">
	  <div class="row">
		<div class="col-xs-12 account-nav">
		  <?php $this->load->view('myaccount_nav_view');?>
		</div>
	  </div>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="inner-wrapper clearfix">
			<h3>Product's Gallary</h3>
			<p>&nbsp;</p>			
			<div class="pimage-wrapper clearfix">
				<div class="col-md-12 col-sm-12 col-xs-12 no-lt-padding" id="file_upload_form" style="<?php echo (count($gallery) < 6)?'display:block;':'display:none;'?>">					
					<div class="col-md-2 col-sm-4 col-xs-12" id="file_upload_wrapper">
						<?php
						$attributes = array('method' => 'post', 'name' => 'productgalleryuploadform', 'id' => 'productgalleryuploadform', 'class' => 'form-horizontal', 'role' => 'form');
						echo form_open_multipart('/default/myaccount/uploadproductgallery', $attributes);
						?>
						<span class="btn btn-warning fileinput-button">
							<i class="fa fa-picture-o" aria-hidden="true"></i> Add Files
							<input id="fileupload" name="fileupload" type="file">
						</span>
						<input type="hidden" name="sid" id="sid" value="<?php echo isset($sid)?$sid:0?>" />
						<input type="hidden" name="pid" id="pid" value="<?php echo isset($pid)?$pid:0?>" />
						<input type="hidden" name="ajax" id="ajax" value="1" />
						<?php echo form_close();?>	
						<br>
						<p class="img-note"><i>Max Size:10MB</i><br>Accepted Files:gif, jpg, png</p>
					</div>
					<div class="col-md-9 col-sm-4 col-xs-12 progress-wrapper">
						<div id="progress" class="progress" style="display:none;">
							<div class="progress-bar progress-bar-success"></div>
						</div>
						<div id="filessss" class="files"></div>
				    </div>
                </div>
				
				<div class="col-md-12 col-sm-12 col-xs-12" id="pimage-wrapper-inner">	
					<?php
					$is_outer_primary = false;
					if(count($gallery) > 0){
						foreach($gallery as $g)
						{
							$is_primary = false;
							if($g->is_primary == 1)
							{
								$is_primary = true;
								$is_outer_primary  = true;
							}
					?>						
					<div class="col-md-2 col-sm-4 col-xs-12" id="gall<?php echo $g->product_id;?><?php echo $g->id;?>">
						<div class="thumbnail">
							<a href="/assets/front/stores/<?php echo $sid;?>/<?php echo $g->product_id;?>/<?php echo $g->name;?>" data-gallery>
								<img alt="<?php echo $g->name;?>" src="/assets/front/stores/<?php echo $sid;?>/<?php echo $g->product_id;?>/<?php echo $g->name;?>">
							</a>
							<div class="caption text-center">
							<button class="btn <?php echo ($is_primary)?'btn-success':'btn-primary set-default'?>" relsid="<?php echo $sid;?>" relpid="<?php echo $g->product_id;?>" relgid="<?php echo $g->id;?>" data-toggle="tooltip" data-placement="top" title="<?php echo (!$is_primary)?'Set Default':''?>"><i class="fa fa-check-square" aria-hidden="true"></i></button>
							<button class="btn btn-danger set-delete" relsid="<?php echo $sid;?>" relpid="<?php echo $g->product_id;?>" relgid="<?php echo $g->id;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>	
					<?php
						}
					}
					else
					{
					?>
						<div class="col-md-12 col-sm-12 col-xs-12 no-image-note">					
							<p class="bg-primary bg-primary-helper">This product has no images. Please upload images and one image must be default.</p>			
						</div>
					<?php
					}
					
					?>
					
				</div>

					<div class="col-md-12 col-sm-12 col-xs-12 no-image-note" id="no-pimage-note" style="<?php echo (!$is_outer_primary && count($gallery) > 0)?'display:block;':'display:none;';?>">					
						<p class="bg-primary bg-primary-helper"> You have no default image .Please set one image as default.</p>			
					</div>
					<p><small><strong>Note:- </strong>Click on image for large view.</small></p>

			</div>
		  </div>
		</div>
	  </div>
	</div>
  </section>
  
  <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">&lsaquo;</a>
    <a class="next">&rsaquo;</a>
    <a class="close">&times;</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>-->
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-primary next">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$(function () {
$('[data-toggle="tooltip"]').tooltip();  
    'use strict';
	$('#blueimp-gallery').data('useBootstrapModal', false)
    $('#blueimp-gallery').toggleClass('blueimp-gallery-controls', true)
	 $('#image-gallery-button').on('click', function (event) {
    event.preventDefault()
    blueimp.Gallery($('#pimage-wrapper-inner a'), $('#blueimp-gallery').data())
  })
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo base_url()?>default/myaccount/uploadproductgallery';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).on('fileuploadadd', function (e, data) {
		$(".progress .progress-bar-success").css("background-color", "#f0ad4e");
        $("#progress").show();		
    }).on('fileuploaddone', function (e, data) {
		data = data.result;
		if(data.status == "success")
		{
			var ghtml = '<div class="col-md-2 col-sm-4 col-xs-12" id="gall'+data.pid+data.gid+'"><div class="thumbnail">';
				    ghtml += '<a data-gallery="" href="<?php echo base_url()?>assets/front/stores/'+data.sid+'/'+data.pid+'/'+data.upload_data.file_name+'"><img alt="'+data.upload_data.file_name+'" src="<?php echo base_url()?>assets/front/stores/'+data.sid+'/'+data.pid+'/'+data.upload_data.file_name+'"></a>';
					ghtml += '<div class="caption text-center">';
					ghtml += '<button class="btn btn-primary set-default" data-toggle="tooltip" relsid="'+data.sid+'" relpid="'+data.pid+'" relgid="'+data.gid+'" data-placement="top" title="Set Default"><i class="fa fa-check-square" aria-hidden="true"></i></button>';
					ghtml += '&nbsp;<button class="btn btn-danger set-delete" data-toggle="tooltip" relsid="'+data.sid+'" relpid="'+data.pid+'" relgid="'+data.gid+'"  data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
					ghtml += '</div>';
					ghtml += '</div></div>';
				
			$("#pimage-wrapper-inner").prepend(ghtml);
			$("#progress").fadeOut("slow");
			$(".no-image-note").fadeOut("slow");
			if(data.total_gallery == 6)
			{
				$("#file_upload_form").hide();
				alert("You can upload maximum 6 files.")
			}
		}
		else if(data.status == "failed")
		{
			alert(data.error);
			$(".progress .progress-bar-success").css("background-color", "#ffc4c4");	
			$("#progress").fadeOut("slow");
		}
		else
		{
			alert("File is not uploaded. Some technical error happened...");
			$(".progress .progress-bar-success").css("background-color", "#ffc4c4");	
			$("#progress").fadeOut("slow");	
		}
        
    }).on('fileuploadfail', function (e, data) {
		alert("upload failed");
		$(".progress .progress-bar-success").css("background-color", "#ffc4c4");	
		$("#progress").fadeOut("slow");			
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
	//Set Default
	$( ".pimage-wrapper" ).on( "click", ".set-default", function() {
		var obj = $(this);
		var sid = $(this).attr('relsid');
		var pid = $(this).attr('relpid');
		var gid = $(this).attr('relgid');
		$.ajax({
			method:'POST',
			url:'/default/myaccount/setdefaultimage',
			data:{"sid":sid, "pid":pid, "gid":gid, "ajax":1, "<?php echo $this->security->get_csrf_token_name()?>":"<?php echo $this->security->get_csrf_hash()?>"},
			dataType:'json',
			beforeSend:function(){
				obj.html('<img src="<?php echo base_url();?>assets/front/img/ajax-loader.gif" />');
			},
			success:function(response){
				if(response.status == "success")
				{
					location.href = "/default/myaccount/productimages/"+sid+"/"+pid;
				}
				else
				{
					alert("Image has not been set default.");
				}	
			},
			error:function(){
				alert("Unable to set default...")
			}
		});
	});	
	
	//Delete Image
	$( ".pimage-wrapper" ).on( "click", ".set-delete", function() {
		if(confirm("Do ypu want to delete this image?")){
			var obj = $(this);
			var pid = $(this).attr('relpid');
			var gid = $(this).attr('relgid');
			$.ajax({
				method:'POST',
				url:'/default/myaccount/deleteimage',
				data:{"sid":$(this).attr('relsid'), "pid":pid, "gid":gid, "ajax":1, "<?php echo $this->security->get_csrf_token_name()?>":"<?php echo $this->security->get_csrf_hash()?>"},
				dataType:'json',
				beforeSend:function(){
					obj.html('<img src="<?php echo base_url();?>assets/front/img/ajax-loader.gif" />');
				},
				success:function(response){
					if(response.status == "success")
					{
						$("#gall"+pid+gid).remove();
						if(response.total_gallery < 6)
						{
							$("#file_upload_form").show();
							if(response.total_gallery == 0)
							{
								$("#pimage-wrapper-inner").html('<div class="col-md-12 col-sm-12 col-xs-12 no-image-note"><p class="bg-primary bg-primary-helper">This product has no images. Please upload images and one image must be default.</p></div>');
							}							
						}
					}
					else
					{
						alert("Image has not been deleted.");
					}	
				},
				error:function(){
					alert("Unable to deleted...")
				}
			});
		}
	});	
});
</script>