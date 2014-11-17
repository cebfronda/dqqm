	<script type="text/javascript">
		$( document ).ready(function() {
			$('#btn-next').off('click');
			$('#btn-next').click(function(){
				$.get("<?php echo base_url().index_page()?>/vicidial/logic/", function(data){
					$('#JContainer').html(data);
				});	
			});
			$('#btn-dispose').off('click');
			$('#btn-dispose').click(function(){
				$.get("<?php echo base_url().index_page()?>/vicidial/intro",function(data){
					$('#JContainer').html(data);
				});	
			});
		});
	</script>
	<div class="JBox JBoxDark">
		<h1>CUSTOMER GO-AHEAD 2</h1>
		<ul>
			<li style = "font-size: 18px;">
			Before we go to the questions I need to let you know that based on your answers &ls;CAMPAIGN HANDLE&gt; and its trusted partners name on the survey may like to contact you in the future either by phone or by mail. Shall we start? / Can we begin? / Is this ok?
			</li>
		</ul>
	</div>
