<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Pages</title>
	<link href="http://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/admin.css" rel="stylesheet" type="text/css" media="all" />	
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/start/jquery-ui-1.9.2.custom.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/start/jquery-ui-1.9.2.custom.min.css" type="text/css">
	
	<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery-1.8.3.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery-ui-1.9.2.custom.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery-ui-1.9.2.custom.min.js'></script>
	
	
	<!--TableSorter -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/tablesorter/themes/blue/style.css" type="text/css" media="print, projection, screen" />    
	<script type="text/javascript" src="<?php echo base_url(); ?>js/tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/tablesorter/pager/jquery.tablesorter.pager.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			 	
		});
		
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="wrapper-bgtop">
			<div id="header-wrapper">
				<?php $this->load->view('template/header');?>	
			</div>
			<div id="page" class="container">
				<div id="content">
					<div>
						<?php $this->load->view($page_view);?>	
					</div>
					
				</div>
				<?php if(isset($page_side)){ ?>
					<div id="sidebar">
						<div class="sidebar-box">
							<?php $this->load->view($page_side);?>	
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<div id="footer">
		<?php echo $this->load->view('template/footer');?>
	</div>
	
</body>
</html>