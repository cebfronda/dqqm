    <script type="text/javascript">
	$(document).ready(function(){
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
			echo "add_child_option('$form','".str_replace("+", "", $opt)."', '$positive');";
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
	    <td>QCODE</td>
	    <td><input type = "text" class = "frm-input" name = "child[<?php echo $form?>][qcode]" value = "<?php echo empty($survey)? "": $survey->qcode; ?>" ></td>
	</tr>
	<tr>
	    <td colspan= 2>Survey Questiont</td>
	</tr> 
	<tr>
	    <td colspan = 2><textarea class = "frm-input" name = "child[<?php echo $form?>][question]" ><?php echo empty($survey)? "": $survey->question; ?></textarea>
	</tr>
	<tr>
	    <td>Options<br>(Check the checkbox that indicates a positive response)</td>
	    <td><div id = "survey_options<?php echo $form?>"></div><a href = "javascript:add_child_option('<?php echo $form?>','New Option')">Add Option for this survey</a></td>
	</tr>
    </table>