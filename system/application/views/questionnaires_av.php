    <script type="text/javascript">
	$(document).ready(function(){
	    $('#frm-av-save').click(function(){
		$.post("<?php echo base_url(),index_page()?>/questionnaires/save/av/<?php echo $id?>", $("#frm-av").serialize(), function(data){
		    alert(data);
		    if (data.indexOf('success') > 0) {
			window.location = "<?php echo base_url(),index_page()?>/questionnaires/av_lists";
		    }
		})
	    });
	    $('#frm-av-cancel').click(function(){
		window.location = "<?php echo base_url(),index_page()?>/questionnaires/av_lists";
	    });
	    
	});
	
    </script>
<h2>Account Verification Script<?php echo empty($av)? "": " for ".ucwords(str_replace("_", " ", $av->reference)); ?></h2>
<form id = "frm-av">
    <table>
    	<tr>
	    <td>Reference</td>
	    <td>
		<select class = "frm-input" name = "av[reference]">
		    <?php foreach($reference as $r){ ?>
			<option value = "<?php echo $r ?>" <?php echo (empty($av)? "" : ($r == $av->reference ) ? "selected = 'selected'": "" ) ?>><?php echo ucwords(str_replace("_", " ", $r)); ?></option>
		    <?php } ?>
		</select>
	    </td>
	</tr>
	<tr>
	    <td>Survey Script</td>
	</tr> 
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "av[script]" ><?php echo empty($av)? "": $av->script; ?></textarea>
	</tr>
	                                                                                            <
	<tr>
	    <td>Points</td>
	    <td><input type = "text" class = "frm-input" name = "av[points]" value = "<?php echo empty($av)? "": $av->points; ?>" ></td>
	</tr>
	<tr>
	    <td>Order</td>
	    <td><input type = "text" class = "frm-input" name = "av[order]" value = "<?php echo empty($av)? "": $av->order; ?>" ></td>
	</tr>
    </table>
</form>
 <a class="button2" id = "frm-av-save" href="javascript:void(0);">Save</a>&nbsp; <a id = "frm-av-cancel" class="button2" href="javascript:void(0);">Cancel</a>