	<script type="text/javascript">
		$( document ).ready(function() {
			$(".BotHide").click(function() {
				$(this).hide();
				$(".BotShow").show();
				$(".JBoxDescHint").hide();
			});
			$(".BotShow").click(function() {
				$(this).hide();
				$(".BotHide").show();
				$(".JBoxDescHint").show();
			});
			$('.JBoxInp').focus(function(){
				$(".JBoxDark li").attr('class', '');
				$("#"+$(this).attr('reference')).attr('class',"JActive");
			});
			$('#save_changes').click(function(){
				$.get("<?php echo base_url().index_page()?>/vicidial/intro2", function(data){
					$('#JContainer').html(data);
				});	
			});
			$('#btn-dispose').off('click');
			$('#btn-dispose').click(function(){
				$.get("<?php echo base_url().index_page()?>/vicidial/intro",function(data){
					$('#JContainer').html(data);
				});	
			});
			$('#btn-next').off('click');
			$('#btn-next').click(function(){
				$.post("<?php echo base_url().index_page()?>/vicidial/intro2/", $("#frm-av").serialize(), function(data){
					$('#JContainer').html(data);
				});	
			});
		});
	</script>
	<div class="ContainerTopBot">
		<a href="#" class="BotHide">HIDE SCRIPTS</a>
		<a href="#" class="BotShow">SHOW SCRIPTS</a>
		<a href="javascript:void(0);" id = "save_changes">SAVE CHANGES</a>
	</div>
	<form id = "frm-av">
	<div class="JBox JBoxDark">
		<h1>Customer Information</h1>
		<ul>
			<?php if(!empty($scripts)){?>
				<?php foreach($scripts as $script){ ?>
					<li id = '<?php echo $script->reference; ?>'>
						<div class="JBoxTitle"><?php echo ucwords(str_replace("_", " ", $script->reference));  ?></div>
						<div class="JBoxDesc">
							<input type="text" name = "customer[<?php echo $script->reference?>]" reference = '<?php echo $script->reference ?>' class="JBoxInp" />
							<div class="JBoxDescHint"><?php echo $script->script?></div>
						</div>
		
					</li>					
				<?php }?>
			<?php }?>
		</ul>
	</div>
	</form>