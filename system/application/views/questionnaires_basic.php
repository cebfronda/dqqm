    <script type="text/javascript">
	$(document).ready(function(){
	    $( "#effectivedate" ).datepicker();
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
		if(!empty($options)){
		    foreach($options as $opt){
			if($opt->positive == 't'){
			    $positive = 'T';
			}else{
			    $positive = 'F';
			}
			echo "add_option('$opt->option', '$positive');";
		    }
		}else{
		    echo "add_option('Not Answered');";
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
	    if (option != "Not Answered") {
		element += "&nbsp; <img src='<?php echo base_url(); ?>images/delete16.png' style = 'cursor:pointer' onclick = 'delete_option("+rand+")'>";
	    }
	    element += "</p>";
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
	    <td>SET ID</td>
	    <td><input type = "text" class = "frm-input" name = "survey[set_id]" value = "<?php echo empty($survey)? "": $survey->set_id; ?>" ></td>
	</tr>
	<tr>
	    <td>CAMPAIGN</td>
	    <td><input type = "text" class = "frm-input" name = "survey[campaign]" value = "<?php echo empty($survey)? "": $survey->campaign; ?>" ></td>
	</tr>
	<tr>
	    <td>QCODE</td>
	    <td><input type = "text" class = "frm-input" name = "survey[qcode]" value = "<?php echo empty($survey)? "": $survey->qcode; ?>" ></td>
	</tr>
	<tr>
	    <td colspan= 2>SCRIPT</td>
	</tr> 
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "survey[question]" ><?php echo empty($survey)? "": $survey->question; ?></textarea>
	</tr>
	<tr>
	    <td>RESPONSES<br>(Check the checkbox that indicates a positive response)</td>
	    <td><div id = "survey_options"></div><a href = "javascript:add_option('New Option')">Add Option for this survey</a></td>
	</tr>
	<tr>
	    <td>POINTS</td>
	    <td><input type = "text" class = "frm-input" name = "survey[points]" value = "<?php echo empty($survey)? "": $survey->points; ?>" ></td>
	</tr>
	<tr>
	    <td>DATE OF EFFECTIVITYe</td>
	    <td><input type = "text" id = "effectivedate" class = "frm-input" name = "survey[effectivity_date]" value = "<?php echo empty($survey)? "": date("m/d/Y", strtotime($survey->effectivity_date)); ?>" ></td>
	</tr>
	<tr>
	    <td colspan= 2>REMARKS</td>
	</tr>
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "survey[remarks]" ><?php echo empty($survey)? "": $survey->remarks; ?></textarea>
	</tr>
	<tr>
	    <td>ORDER</td>
	    <td><input type = "text" class = "frm-input" name = "survey[order]" value = "<?php echo empty($survey)? "": $survey->order; ?>" ></td>
	</tr>
    </table>
</form>
 <a class="button2" id = "frm-basic-save" href="javascript:void(0);">Save</a>&nbsp; <a id = "frm-basic-cancel" class="button2" href="javascript:void(0);">Cancel</a>