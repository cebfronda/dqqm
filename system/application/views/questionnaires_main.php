    <script type="text/javascript">
	$(document).ready(function(){
	    $( "#effectivedate" ).datepicker();
	    $('#frm-main-save').click(function(){
		$.post("<?php echo base_url(),index_page()?>/questionnaires/save/main/<?php echo $id?>", $("#frm-main").serialize(), function(data){
		    alert(data);
		    if (data.indexOf('success') > 0) {
			window.location = "<?php echo base_url(),index_page()?>/questionnaires/qm_main_lists";
		    }
		})
	    });
	    $('#frm-main-cancel').click(function(){
		window.location = "<?php echo base_url(),index_page()?>/questionnaires/qm_main_lists";
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
		    echo "add_option('Not Answered');";
		}
	    ?>
	    
	    <?php
		if(!empty($dependents)){
		    foreach($dependents as $dependent){
			echo "add_dependents($dependent->survey_question_id);";
		    }
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
	
	function add_child_option(form, option, positive){
	    var rand = Math.floor((Math.random() * 100000000000) + 1);
	    var check = "";
	    if (positive == 'T') {
		check = "checked";
	    }
	    var element = "<p id = 'child"+rand+"'><input type = 'checkbox' name = 'child["+form+"]["+rand+"][positive]' value = '+' "+check+">";
	    element += "&nbsp;<input type = 'text' value = '"+option+"' name = 'child["+form+"]["+rand+"][option]'>";
	    element += "&nbsp; <img src='<?php echo base_url(); ?>images/delete16.png' style = 'cursor:pointer' onclick = 'delete_child_option("+rand+")'></p>";
	    $( "#survey_options"+form ).append( element );
	}
	
	function delete_option(id){
	    var element = "#"+id;
	    $( element ).remove();
	}
	
	function delete_child_option(id){
	    var element = "#child"+id;
	    $( element ).remove();
	}
	
	function add_dependents(id = 0){
	    $.get("<?php echo base_url(),index_page()?>/questionnaires/qm_child/"+id, function (data){
		$( "#dependents" ).append( data );
	    });
	}
	
    </script>
<h2><?php echo (empty($survey)? "New ": "Update "). ucwords($type)." ";  ?>Survey Question</h2>
<form id = "frm-main">
    <input type = 'hidden' value = "main" name = 'survey[type]'>
    <table>
	<tr>
	    <td>QCODE</td>
	    <td><input type = "text" class = "frm-input" name = "survey[qcode]" value = "<?php echo empty($survey)? "": $survey->qcode; ?>" ></td>
	</tr>
	<tr>
	    <td colspan= 2>Survey Questiont</td>
	</tr> 
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "survey[question]" ><?php echo empty($survey)? "": $survey->question; ?></textarea>
	</tr>
	<tr>
	    <td>Options<br>(Check the checkbox that indicates a positive response)</td>
	    <td><div id = "survey_options"></div><a href = "javascript:add_option('New Option')">Add Option for this survey</a></td>
	</tr>
	<tr>
	    <td>Status</td>
	    <td>
		<select class = "frm-input" name = "survey[status_id]">
		    <?php foreach($status as $stat){ ?>
			<option value = "<?php echo $stat->status_id ?>" <?php echo (empty($survey)? "" : ($stat->status_id == $survey->status_id ) ? "selected = 'selected'": "" ) ?>><?php echo $stat->status; ?></option>
		    <?php } ?>
		</select>
	    </td>
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
	    <td>Max Cap for Positive Response</td>
	    <td><input type = "text" class = "frm-input" name = "survey[cap]" value = "<?php echo empty($survey)? "": $survey->cap; ?>" ></td>
	</tr>
	<tr>
	    <td>Effective Date</td>
	    <td><input type = "text" id = "effectivedate" class = "frm-input" name = "survey[effectivity_date]" value = "<?php echo empty($survey)? "": date("m/d/Y", strtotime($survey->effectivity_date)); ?>" ></td>
	</tr>
	<tr>
	    <td colspan= 2>Remarks</td>
	</tr> 
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "survey[remarks]" ><?php echo empty($survey)? "": $survey->remarks; ?></textarea>
	</tr>
	<tr>
	    <td colspan= 2><div id = "dependents"></div><a href = "javascript:add_dependents()">Add child for this survey</a></td>
	</tr> 
    </table>
</form>
 <a class="button2" id = "frm-main-save" href="javascript:void(0);">Save</a>&nbsp;
 <a id = "frm-main-cancel" class="button2" href="javascript:void(0);">Cancel</a>