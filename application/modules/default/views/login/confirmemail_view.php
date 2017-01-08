
<!--Reggistration area-->
<div class="white_space" style="height:80px;"></div>
<div id="resistration">
	<div class="container">
		<div class=" col-md-12">
			<div class="resistration_form">
				<div class="form_heading"><h3>Thank You!</h3></div>
				<div class="confirmtext">
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p class="text-center bg-success bg-success-helper"><strong>Congratulations!</strong> You have been registered with us suucessfully. Please confirm your email to activate your account.</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>        
			</div>
		</div>
    </div>
</div>
<div class="white_space" style="height:80px;"></div>
<script>
$(document).ready(function(){
	$("#createaccountform-submit").click(function(){
		$("#createaccountform").submit();
	});
	$("#createaccountform").validate({
		rules: {
			fullname: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 6
			},
			confpassword: {
				required: true,
				minlength: 6,         
				equalTo: function(){
                    return "#password";
                } 
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>
