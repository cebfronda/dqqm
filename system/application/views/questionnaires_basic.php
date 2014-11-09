    <script type="text/javascript">
	$(document).ready(function(){
	    $('#frm-basic-save').click(function(){
		$.post("<?php echo base_url(),index_page()?>/questionnaires/save/basic/<?php echo $id?>", $("#frm-basic").serialize(), function(data){
		    alert(data);
		    if (data.indexOf('success') > 0) {
			window.location = "<?php echo base_url(),index_page()?>/questionnaires/qm_basic_lists";
		    }
		})
	    });
	    $('#frm-basic-cancel').click(function(){
		window.location = "<?php echo base_url(),index_page()?>/questionnaires/qm_basic_lists";
	    });
	    <?php
		if(!empty($survey)){
		    $options = json_decode($survey->options);
		    foreach($options as $opt){
			$positive = strpos($opt,'+');
			if($positive !== false){
			    $positive = 'T';
			}else{
			    $positive = 'F';
			}
			echo "add_option('".str_replace("+", "", $opt)."', '$positive');";
		    }
		}else{
		    echo "add_option('unanswered');";
		}
	    ?>
	    
	});
	
	function add_option(option, positive){
	    var rand = Math.floor((Math.random() * 100000000000) + 1);
	    var check = "";
	    if (positive == 'T') {
		check = "checked";
	    }
	    var element = "<p id = '"+rand+"'><input type = 'checkbox' name = 'option["+rand+"][positive]' value = '+' "+check+">";
	    element += "&nbsp;<input type = 'text' value = '"+option+"' name = 'option["+rand+"][option]'>";
	    element += "&nbsp; <img src='<?php echo base_url(); ?>images/delete16.png' style = 'cursor:pointer' onclick = 'delete_option("+rand+")'></p>";
	    $( "#survey_options" ).append( element );
	}
	
	function delete_option(id){
	    var element = "#"+id;
	    $( element ).remove();
	}
	
    </script>
<h2><?php echo (empty($survey)? "New ": "Update "). ucwords($type)." ";  ?>Survey Question</h2>
<form id = "frm-basic">
    <input type = 'hidden' value = "basic" name = 'survey[type]'>
    <table>
	<tr>
	    <td>QCODE</td>
	    <td><input type = "text" class = "frm-input" name = "survey[qcode]" value = "<?php echo empty($survey)? "": $survey->qcode; ?>" ></td>
	</tr>
	<tr>
	    <td>Survey Questiont</td>
	</tr> 
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "survey[question]" ><?php echo empty($survey)? "": $survey->question; ?></textarea>
	</tr>
	<tr>
	    <td>Options</td>
	    <td><div id = "survey_options"></div><a href = "javascript:add_option('New Option')">Add Option for this survey</a></td>
	</tr>
	<tr>
	    <td>Points</td>
	    <td><input type = "text" class = "frm-input" name = "survey[points]" value = "<?php echo empty($survey)? "": $survey->points; ?>" ></td>
	</tr>
	<tr>
	    <td>Order</td>
	    <td><input type = "text" class = "frm-input" name = "survey[order]" value = "<?php echo empty($survey)? "": $survey->order; ?>" ></td>
	</tr>
	<tr>
	    <td>Max Cap</td>
	    <td><input type = "text" class = "frm-input" name = "survey[cap]" value = "<?php echo empty($survey)? "": $survey->cap; ?>" ></td>
	</tr>
    </table>
</form>
 <a class="button2" id = "frm-basic-save" href="javascript:void(0);">Save</a>&nbsp; <a id = "frm-basic-cancel" class="button2" href="javascript:void(0);">Cancel</a>