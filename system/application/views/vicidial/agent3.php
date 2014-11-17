	<script type="text/javascript">
		$( document ).ready(function() {
			$('#btn-next').off('click');
			$('#btn-next').click(function(){
				$.get("<?php echo base_url().index_page()?>/vicidial/intro/", function(data){
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
		<h1>CUSTOMER CLOSING</h1>
		<ul>
			<li style = "font-size: 18px;">
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</li>
		</ul>
	</div>
