    <script type="text/javascript">
	$(document).ready(function(){
	    $( "#<?php echo $form?>effectivedate" ).datepicker();
	    <?php
		if(!empty($options)){
		    foreach($options as $opt){
			if($opt->positive == 't'){
			    $positive = 'T';
			}else{
			    $positive = 'F';
			}
			echo "add_child_option('$form','$opt->option', '$positive');";
		    }
		}else{
		    echo "add_child_option($form, 'Not Answered');";
		}
	    ?>	
	    
	});
	
    </script>
 <hr style = "display:block">   
<h2 style = "font-size: 110%">Survey Question(Child)</h2>
    <input type = 'hidden' value = "main" name = 'child[<?php echo $form?>][type]'>    
    <table>
	<tr>
	    <td>SET ID</td>
	    <td><input type = "text" class = "frm-input" name = "child[<?php echo $form?>][set_id]" value = "<?php echo empty($survey)? "": $survey->set_id; ?>" ></td>
	</tr>
	<tr>
	    <td>CAMPAIGN</td>
	    <td><input type = "text" class = "frm-input" name = "child[<?php echo $form?>][campaign]" value = "<?php echo empty($survey)? "": $survey->campaign; ?>" ></td>
	</tr>
	<tr>
	    <td>QCODE</td>
	    <td><input type = "text" class = "frm-input" name = "child[<?php echo $form?>][qcode]" value = "<?php echo empty($survey)? "": $survey->qcode; ?>" ></td>
	</tr>
	<tr>
	    <td colspan= 2>SCRIPT</td>
	</tr> 
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "child[<?php echo $form?>][question]" ><?php echo empty($survey)? "": $survey->question; ?></textarea>
	</tr>
	<tr>
	    <td>RESPONSES<br>(Check the checkbox that indicates a positive response)</td>
	    <td><div id = "survey_options<?php echo $form?>"></div><a href = "javascript:add_child_option('<?php echo $form?>','New Option')">Add Option for this survey</a></td>
	</tr>
	<tr>
	    <td>CAP TYPE</td>
	    <td>
		<select class = "frm-input" name = "child[<?php echo $form?>][cap_type]">
		    <option value = "capped" <?php echo (empty($survey)? "" : ($survey->cap_type == 'capped' ) ? "selected = 'selected'": "" ) ?>>CAPPED</option>
		    <option value = "uncapped" <?php echo (empty($survey)? "" : ($survey->cap_type == 'uncapped' ) ? "selected = 'selected'": "" ) ?>>UNCAPPED</option>

		</select>
	    </td>
	</tr>
	<tr>
	    <td>POINTS</td>
	    <td><input type = "text" class = "frm-input" name = "child[<?php echo $form?>][points]" value = "<?php echo empty($survey)? "": $survey->points; ?>" ></td>
	</tr>
	<tr>
	    <td>CAP ALLOCATION</td>
	    <td><input type = "text" class = "frm-input" name = "child[<?php echo $form?>][cap]" value = "<?php echo empty($survey)? "": $survey->cap; ?>" ></td>
	</tr>
	<tr>
	    <td>DATE OF EFFECTIVITYe</td>
	    <td><input type = "text" id = "<?php echo $form?>effectivedate" class = "frm-input" name = "child[<?php echo $form?>][effectivity_date]" value = "<?php echo empty($survey)? "": date("m/d/Y", strtotime($survey->effectivity_date)); ?>" ></td>
	</tr>
	<tr>
	    <td colspan= 2>REMARKS</td>
	</tr>
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "child[<?php echo $form?>][remarks]" ><?php echo empty($survey)? "": $survey->remarks; ?></textarea>
	</tr>
	<tr>
	    <td>STATUS</td>
	    <td>
		<select class = "frm-input" name = "child[<?php echo $form?>][status_id]">
		    <?php foreach($status as $stat){ ?>
			<option value = "<?php echo $stat->status_id ?>" <?php echo (empty($survey)? "" : ($stat->status_id == $survey->status_id ) ? "selected = 'selected'": "" ) ?>><?php echo $stat->status; ?></option>
		    <?php } ?>
		</select>
	    </td>
	</tr>
    </table>