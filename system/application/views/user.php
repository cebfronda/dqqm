    <script type="text/javascript">
	$(document).ready(function(){
	    $('#frm-user-save').click(function(){
		$.post("<?php echo base_url(),index_page()?>/users/save/<?php echo $user_id?>", $("#frm-user").serialize(), function(data){
		    alert(data);
		    if (data.indexOf('success') > 0) {
			window.location = "<?php echo base_url(),index_page()?>/users";
		    }
		})
	    });
	    $('#frm-user-cancel').click(function(){
		window.location = "<?php echo base_url(),index_page()?>/users";
	    });
	    
	});
	
    </script>
<h2><?php echo (empty($user_id)? "New " : "" )?>User Details</h2>
<form id = "frm-user">
    <table>
	<tr>
	    <td>Username</td>
	    <td><input type = "text" class = "frm-input" name = "users[username]" value = "<?php echo empty($user)? "": $user->username; ?>" ></td>
	</tr>
	<?php if(empty($user)){?>
	    <tr>
		<td>Password</td>
		<td><input type = "password" class = "frm-input" name = "users[password]" value = "<?php echo empty($user)? "": $user->password; ?>" ></td>
	    </tr>
	<?php } ?>
	<tr>
	    <td>First Name</td>
	    <td><input type = "text" class = "frm-input" name = "users[first_name]" value = "<?php echo empty($user)? "": $user->first_name; ?>" ></td>
	</tr>
	<tr>
	    <td>Last Name</td>
	    <td><input type = "text" class = "frm-input" name = "users[last_name]" value = "<?php echo empty($user)? "": $user->last_name; ?>" ></td>
	</tr>
	<tr>
	    <td>Middle Name</td>
	    <td><input type = "text" class = "frm-input" name = "users[middle_name]" value = "<?php echo empty($user)? "": $user->middle_name; ?>" ></td>
	</tr>
	<tr>
	    <td>User Status</td>
	    <td>
		<select class = "frm-input" name = "users[user_status_id]">
		    <?php foreach($user_status as $status){ ?>
			<option value = "<?php echo $status->user_status_id ?>" <?php echo (empty($user)? "" : ($user->user_status_id == $status->user_status_id ) ? "selected = 'selected'": "" ) ?>><?php echo $status->user_status; ?></option>
		    <?php } ?>
		</select>
	    </td>
	</tr>
	<tr>
	    <td>Position</td>
	    <td><input type = "text" class = "frm-input" name = "users[position]" value = "<?php echo empty($user)? "": $user->position; ?>" ></td>
	</tr>
	<tr>
	    <td>Contact Details</td>
	    <td><textarea class = "frm-input" name = "users[contact_details]" ><?php echo empty($user)? "": $user->contact_details; ?></textarea>
	</tr>
    </table>
</form>
 <a class="button2" id = "frm-user-save" href="javascript:void(0);">Save</a>&nbsp; <a id = "frm-user-cancel" class="button2" href="javascript:void(0);">Cancel</a>