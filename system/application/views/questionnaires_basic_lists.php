    <script type="text/javascript">
	$(document).ready(function(){
	    <?php if(count($lists) > 10){ ?>
		$("table").tablesorterPager({container: $("#pager")});
	    <?php } ?>
	    $('.view').click(function(){
                window.location = "<?php echo base_url().index_page()?>/questionnaires/qm_basic/"+$(this).attr('id');
	    });
	    $('.delete').click(function(){
		var confirmdeletion = confirm('Are you sure you want to delete this survey question?');
		if (confirmdeletion) {
		    $.get('<?php echo base_url().index_page()?>/questionnaires/qm_basic_delete/'+$(this).attr('id'), function(){
			window.location = "<?php echo base_url().index_page()?>/questionnaires/qm_basic_lists";
		    });
		}
	    });
	    $('#new-user').click(function(){
		user(0);
	    });
	});
	
    </script>
   <h2>Pre-Qualifying Survey Questions</h2>
	<table cellspacing="1" class="tablesorter">
	    <thead>
		    <tr>
			    <th>ORDER</th>
			    <th>SET ID</th>
			    <th>CAMPAIGN</th>
			    <th>QCODE</th>
			    <th>SCRIPT</th>
			    <th>ACTION</th>
    
		    </tr>
	    </thead>
	    <?php if(count($lists) > 10){ ?>
		<tfoot>
			<tr>
			    <th>ORDER</th>
			    <th>SET ID</th>
			    <th>CAMPAIGN</th>
			    <th>QCODE</th>
			    <th>SCRIPT</th>
			    <th>ACTION</th>
			</tr>
		</tfoot>
	    <?php } ?>
	    <tbody>
		<?php if(!empty($lists)){?>
		    <?php foreach($lists as $l){?>
			<tr>
				<td><?php echo $l->order; ?></td>
				<td><?php echo $l->set_id; ?></td>
				<td><?php echo $l->campaign; ?></td>
				<td><?php echo $l->qcode; ?></td>
				<td><?php echo $l->question; ?></td>
				<td>
				    <img id = "<?php echo $l->survey_question_id ?>" class = "view" src="<?php echo base_url()?>images/view16.png">
				    <img id = "<?php echo $l->survey_question_id ?>" class = "delete" src="<?php echo base_url()?>images/delete16.png">
				</td>
			</tr>
		    <?php } ?>
		<?php } ?>
	    </tbody>
    </table>