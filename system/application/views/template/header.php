			<div id="header">
				<div id="logo">
					<h1><a href="#">Admin Panel</a></h1>
				</div>
				<div id="menu">
					<?php if(!empty($_SESSION[SESSION_NAME])){ ?>
					<ul>
						<li class="<?php echo isset($home)? $home : "" ; ?>"><a href="<?php echo base_url().index_page(); ?>/admin" accesskey="1" title="">Dashboard</a></li>
						<li class="<?php echo isset($users)? $users : "" ; ?>"><a href="<?php echo base_url().index_page(); ?>/users" accesskey="2" title="">Users</a></li>
						<li class="<?php echo isset($questionnaires)? $questionnaires : "" ; ?>"><a href="<?php echo base_url().index_page(); ?>/questionnaires" accesskey="3" title="">Questionnaires</a></li>
						<li class="<?php echo isset($reports)? $reports : "" ; ?>"><a href="<?php echo base_url().index_page(); ?>/reports" accesskey="4" title="">Reports</a></li>
						<li><a href="<?php echo base_url().index_page(); ?>/control/logout" accesskey="4" title="">Logout</a></li>
					</ul>
					<?php } ?>
				</div>
			</div>