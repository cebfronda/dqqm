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
			$('.JBoxSel').focus(function(){
				$(".JBoxDark li").attr('class', '');
				$("#"+$(this).attr('reference')).attr('class',"JActive");
			});
			$('#btn-dispose').off('click');
			$('#btn-dispose').click(function(){
				$.get("<?php echo base_url().index_page()?>/vicidial/intro",function(data){
					$('#JContainer').html(data);
				});	
			});
			$('#btn-next').off('click');
			$('#btn-next').click(function(){
				$.post("<?php echo base_url().index_page()?>/vicidial/close", $("#frm-survey").serialize(), function(data){
					$('#JContainer').html(data);
				});	
			});
			$('.JBoxSel').change(function() {
				var inputs = $(this).closest('form').find(':input');
				inputs.eq( inputs.index(this)+ 1 ).focus();
			});
		});
	</script>
	<!--
	<div class="ContainerTopBot">
		<a href="#" class="BotHide">HIDE SCRIPTS</a>
		<a href="#" class="BotShow">SHOW SCRIPTS</a>
	</div>
	-->
	<form id = "frm-survey">
	<div class="JBox JBoxDark">
		<h1>SURVEY QUESTIONS</h1>
		<ul>
			<?php if(!empty($scripts)){?>
				<?php foreach($scripts as $script){ ?>
				<?php $options = $this->vicidial_model->get_survey_options($script->survey_question_id); ?>
				<li id = "<?php echo $script->survey_question_id ?>">
					<div class="JBoxTitle">QCODE(<?php echo $script->qcode ?>)</div>
					<div class="JBoxDesc">
						<div class="JBoxDescQuestion"><?php echo $script->question ?></div>
						<select class="JBoxSel" reference = "<?php echo $script->survey_question_id ?>" name = "survey[<?php echo $script->survey_question_id ?>]">
							<option value = "" ></option>
							<?php foreach($options as $opt){?>
								<option value = "<?php echo $opt->option_id ?>" ><?php echo $opt->option ?></option>
							<?php } ?>
						</select>
						<!-- <div class="JBoxDescHint">Sample Script</div> -->
					</div>
				</li>				
				<?php }?>
			<?php }?>
		</ul>
	</div>
	</form>