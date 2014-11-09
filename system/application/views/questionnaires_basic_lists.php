    <script type="text/javascript">
	$(document).ready(function(){
	    $("table").tablesorter();
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
			    <th>QCode</th>
			    <th>Survey Question</th>
			    <th>Action</th>
    
		    </tr>
	    </thead>
	    <?php if(count($lists) > 10){ ?>
		<tfoot>
			<tr>
				<th>QCode</th>
				<th>Survey Question</th>
				<th>Action</th>
	
			</tr>
		</tfoot>
	    <?php } ?>
	    <tbody>
		<?php if(!empty($lists)){?>
		    <?php foreach($lists as $l){?>
			<tr>
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
<?php if(count($lists) > 10){ ?>
    <div id="pager" class="pager">
	    <form>
		    <img src="<?php echo base_url() ?>css/tablesorter/first.png" class="first"/>
		    <img src="<?php echo base_url() ?>css/tablesorter/prev.png" class="prev"/>
		    <input type="text" style = "width: 50px; height: 18px; " class="pagedisplay"/>
		    <img src="<?php echo base_url() ?>css/tablesorter/next.png" class="next"/>
		    <img src="<?php echo base_url() ?>css/tablesorter/last.png" class="last"/>
		    <select class="pagesize">
			    <option selected="selected"  value="10">10</option>
			    <option value="20">20</option>
			    <option value="30">30</option>
			    <option  value="40">40</option>
		    </select>
	    </form>
    </div>
<?php } ?>