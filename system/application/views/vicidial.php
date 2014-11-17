 <!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Title of the document</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/template.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				$.get("<?php echo base_url().index_page()?>/vicidial/account_verification/", function(data){
					$('#JContainer').html(data);	
				});
			});
		</script>
	</head>
	<body>
		<?php echo $this->load->view('vicidial/header'); ?>
		<?php echo $this->load->view('vicidial/sidebar'); ?>
		<?php echo $this->load->view('vicidial/client'); ?>
		<div id="JContainer"></div>
	</body>
</html>