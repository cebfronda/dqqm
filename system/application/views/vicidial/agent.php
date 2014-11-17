	<script type="text/javascript">
		$( document ).ready(function() {
			$('#btn-next').off('click');
			$('#btn-next').click(function(){
				$.get("<?php echo base_url().index_page()?>/vicidial/account_verification/", function(data){
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
		<h1>CUSTOMER GO-AHEAD 1</h1>
		<ul>
			<li style = "font-size: 18px;">
			Hi, this is <b>&lt;AGENT HANDLE&gt;</b>. I'm calling from <b>&lt;CAMPAIGN HANDLE&gt;</b>. This is not a sales call. We are conducting a short survey in your area asking only simple questions answering YES or NO. It will only take a few minutes. Shall we start? / Can we begin? / Is this ok?
			</li>
		</ul>
	</div>
