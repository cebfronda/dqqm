    <script type="text/javascript">
	$(document).ready(function(){
	    $( "#effectivedate" ).datepicker();
	     $( "#dialog" ).dialog({
		autoOpen: false,
		show: {
			effect: "blind",
			duration: 1000
			},
		hide: {
			    effect: "explode",
			    duration: 1000
			}
	    });
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
	    $('#selectionlink').change(function(){
		$.get("<?php echo base_url(),index_page()?>/questionnaires/view_survey/"+$(this).val(), function (data){
		    $('#view_survey').html(data);
		});
		    
	    });
	    <?php
		if(!empty($options)){
		    foreach($options as $opt){
			if($opt->positive == 't'){
			    $positive = 'T';
			}else{
			    $positive = 'F';
			}
			echo "add_option('$opt->option', '$opt->linkto','$positive');";
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
	
	function add_option(option, linkto, positive){
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
	
	function add_child_option(form, option, positive){
	    var rand = Math.floor((Math.random() * 100000000000) + 1);
	    var check = "";
	    if (positive == 'T') {
		check = "checked";
	    }
	    var element = "<p id = 'child"+rand+"'><input type = 'checkbox' name = 'child["+form+"]["+rand+"][positive]' value = '+' "+check+">";
	    element += "&nbsp;<input type = 'text' value = '"+option+"' name = 'child["+form+"]["+rand+"][option]'>";
	    if (option != "Not Answered") {
		element += "&nbsp; <img src='<?php echo base_url(); ?>images/delete16.png' style = 'cursor:pointer' onclick = 'delete_child_option("+rand+")'>";
	    }
	    element += "</p>";
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
	
	function add_option_link(title){
	    $( "#dialog" ).dialog( "open" );
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
	<tr style = "background-color: black; color: white; font-size: 16px;">
	    <td colspan= 2>LOGIC QUESTIONS</td>
	</tr>
	<?php foreach($logic as $l){?>
	    <tr>
		<td><?php echo "Set ID : $l->set_id (QCODE:#$l->qcode)<br>$l->question" ?></td>
		<td>
		    <select name = "logic[<?php echo $l->survey_question_id ?>][]" multiple>
		    <?php
			$selected = $this->qm_model->get_logic_questions_selection($l->survey_question_id, $id);
			$selected = (!empty($selected)? json_decode($selected->inclusion) : array());
			$o = $this->qm_model->get_survey_options($l->survey_question_id);
		    ?>
		    <?php foreach($o as $opt){?>
			<option value = "<?php echo $opt->option ?>" <?php echo (in_array($opt->option, $selected) ? "selected = 'selected'" : "" ) ?>><?php echo $opt->option ?></option>
		    <?php } ?>
		    </select>
		</td>
	    </tr>
	<?php }?>
	<tr>
	    <td colspan= 2><hr></td>
	</tr>
	<tr style = "background-color: black; color: white; font-size: 16px;">
	    <td colspan= 2>QUESTION PROFILE</td>
	</tr>
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
	    <td>CAP TYPE</td>
	    <td>
		<select class = "frm-input" name = "survey[cap_type]">
		    <option value = "capped" <?php echo (empty($survey)? "" : ($survey->cap_type == 'capped' ) ? "selected = 'selected'": "" ) ?>>CAPPED</option>
		    <option value = "uncapped" <?php echo (empty($survey)? "" : ($survey->cap_type == 'uncapped' ) ? "selected = 'selected'": "" ) ?>>UNCAPPED</option>

		</select>
	    </td>
	</tr>
	<tr>
	    <td>CAP ALLOCATION</td>
	    <td><input type = "text" class = "frm-input" name = "survey[cap]" value = "<?php echo empty($survey)? "": $survey->cap; ?>" ></td>
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
	<tr>
	    <td>STATUS</td>
	    <td>
		<select class = "frm-input" name = "survey[status_id]">
		    <?php foreach($status as $stat){ ?>
			<option value = "<?php echo $stat->status_id ?>" <?php echo (empty($survey)? "" : ($stat->status_id == $survey->status_id ) ? "selected = 'selected'": "" ) ?>><?php echo $stat->status; ?></option>
		    <?php } ?>
		</select>
	    </td>
	</tr>
	<tr>
	    <td colspan= 2><div id = "dependents"></div><a href = "javascript:add_dependents()">Add child for this survey</a></td>
	</tr> 
    </table>
</form>
 <a class="button2" id = "frm-main-save" href="javascript:void(0);">Save</a>&nbsp;
 <a id = "frm-main-cancel" class="button2" href="javascript:void(0);">Cancel</a>
 <div id="dialog" title="Link Survey Response">
    <?php
	$srv = $this->qm_model->main_survey_lists();
    ?>
    <?php if(!empty($srv)){?>
    SELECT CAMPAIGN:
    <select id = "selectionlink">
	<option value = "">Select from survey lists</option>
	<?php foreach($srv  as $svy){ ?>
	    <option value = "<?php echo $svy->survey_question_id?>">Set UD#<?php echo $svy->set_id?> (QCODE : <?php echo $svy->qcode ?>)</option>
    	<?php }?>
    </select> <button id = "checkout">Link</button>
    <div id = "view_survey"></div>
    <?php }else{ ?>
	No Survey Available
    <?php } ?>
</div>