    <script type="text/javascript">
	$(document).ready(function(){
	    $("table").tablesorter();
	    <?php if(count($lists) > 10){ ?>
		$("table").tablesorterPager({container: $("#pager")});
	    <?php } ?>
	    $('.view').click(function(){
                window.location = "<?php echo base_url().index_page()?>/questionnaires/av/"+$(this).attr('list_id');
	    });
	    $('.delete').click(function(){
		var confirmdeletion = confirm('Are you sure you want to delete this account?');
		if (confirmdeletion) {
		    $.get('<?php echo base_url().index_page()?>/questionnaires/av_delete/'+$(this).attr('list_id'), function(){
			window.location = "<?php echo base_url().index_page()?>/users/";
		    });
		}
	    });
	    $('#new-user').click(function(){
		user(0);
	    });
	});
	
    </script>
   <h2>Account Verification Scripts</h2>
	<table cellspacing="1" class="tablesorter">
	    <thead>
		    <tr>
			    <th>Script for</th>
			    <th>Action</th>
    
		    </tr>
	    </thead>
	    <?php if(count($lists) > 10){ ?>
		<tfoot>
			<tr>
				<th>Script for</th>
				<th>Action</th>
	
			</tr>
		</tfoot>
	    <?php } ?>
	    <tbody>
		<?php if(!empty($lists)){?>
		    <?php foreach($lists as $l){?>
			<tr>
				<td><?php echo ucwords(str_replace("_", " ", $l->reference)); ?></td>
				<td>
				    <img list_id = "<?php echo $l->account_verification_id ?>" class = "view" src="<?php echo base_url()?>images/view16.png">
				    <img list_id = "<?php echo $l->account_verification_id ?>" class = "delete" src="<?php echo base_url()?>images/delete16.png">
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