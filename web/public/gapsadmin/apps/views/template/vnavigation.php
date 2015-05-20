		<div id="sidebar-left" class="col-xs-2 col-sm-2">			
			<ul class="nav main-menu">
				<li>
					<a href="<?php echo site_url();?>" class="active">
						<i class="fa fa-dashboard"></i>
						<span class="hidden-xs">Dashboard</span>
					</a>
				</li>
				 <?php foreach ($ACCESS_MENU as $ky ) { ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa <?=$ky['css']?>"></i>
						<span class="hidden-xs"><?=$ky['title']?></span>
					</a>
					<ul class="dropdown-menu">
						<?php foreach ($ky['child'] as $key => $value) { ?>
		                  <li>
		                    <a href="<?php echo site_url($value) ?>"><?=$key?></a>
		                  </li>
		                <?php } ?>

					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>