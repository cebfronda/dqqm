<script>
    $(document).ready(function(){
	$("#frm-login-btn-submit").click(function(){
	    $.post('<?php echo base_url().index_page() ?>/control/login', $('#frm-login').serialize(), function(data){
		if (data.indexOf('success') > 0) {
		    alert(data);
		    window.location = "<?php echo base_url().index_page()?>/admin"				
		}else{
		    alert(data);
		}
	    });
	});
	
	$("#frm-login-btn-forgotpassword").click(function(){
	    $.get('<?php echo base_url().index_page(); ?>control/forgot_password', function(data){
		$('#content-area').html(data);
	    });
	});
    });
		
</script>
<h2>Log In</h2>
<form id = 'frm-login'>
    <p><input type="text" class = "login" name = "username" value="Username/Email" onBlur="javascript:if(this.value==''){this.value=this.defaultValue;}" onFocus="javascript:if(this.value==this.defaultValue){this.value='';}"></p>
    <p><input class = "login" type="password" name = "password" value="Password" onBlur="javascript:if(this.value==''){this.value=this.defaultValue;}" onFocus="javascript:if(this.value==this.defaultValue){this.value='';}"></p>
    <p>
	<a id = "frm-login-btn-submit" class="button1" href="javascript:void(0)">Log In</a>
	    <!--<input id = "frm-login-btn-forgotpassword" type="button" value="Forgot Password" class="btn2">--></p>
</form>