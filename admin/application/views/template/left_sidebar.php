<!-- MAIN NAVIGATION -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<nav id="mainnav-container" class="mainnav">
	<div class="mainnav__inner">
		<!-- DEBUT MENU DE NAVIGATION -->
		<div class="mainnav__top-content scrollable-content pb-5">
			<!-- PROFILES -->
			<div class="mainnav__profile mt-3 d-flex3">
				<!-- <div class="mt-2 d-mn-max">
				</div> -->
					<!-- photo de profil  -->
				<div class="mininav-toggle text-center py-2">
					<img class="mainnav__avatar img-md rounded-circle border" src="<?= $this->session->photo ?>" alt="Photo de profil">
				</div>
				<div class="mininav-content collapse d-mn-max">
					<div class="d-grid">
						<!-- User name and position -->
						<button class="d-block btn shadow-none p-2" data-bs-toggle="collapse" data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
							<span class="dropdown-toggle d-flex justify-content-center align-items-center">
								<h6 class="mb-0 me-3"><?php echo strtoupper($_SESSION["prenom"]) . " " . strtoupper($_SESSION["nom"]); ?></h6>
							</span>
							<small class="text-muted"><?php echo  $_SESSION['profil']; ?></small>
						</button>
						<!-- Collapsed user menu -->
						<div id="usernav" class="nav flex-column collapse">
							<a href="<?php echo base_url(); ?>se_deconnecter" class="nav-link">
								<i class="demo-pli-unlock fs-5 me-2"></i>
								<span class="ms-1">Se deconnecter</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<!-- FIN PROFILES -->
			<?php
			$menu_roles = $_SESSION['menu_roles'];
			$smenu_roles = $_SESSION['smenu_roles']; 
			?>
			<!-- DEBUT RAPPORT -->
			<div class="mainnav__categoriy py-3 border-top pb-2" id="sidebar-menu" >
				<!-- <h6 class="mainnav__caption mt-0 px-3 fw-bold">RAPPORTS</h6> -->
				<ul class="mainnav__menu nav flex-column">
					<!-- Link with submenu -->
					<?php if (isset($smenu_roles['DASH']['d_read'])): ?>
					<li class="nav-item has-sub">
						<a href="<?php echo base_url(); ?>dashboard" class="mininav-toggle nav-link collapsed"><i class="demo-pli-bar-chart fs-5 me-2"></i>
							<span class="nav-label ms-1">RAPPORTS</span>
						</a>
						<!-- Charts submenu list -->
						<ul class="mininav-content nav collapse">
							<li class="nav-item">
								<a href="<?php echo base_url(); ?>dashboard" class="nav-link">GENERAL</a>
							</li>
						</ul>
						<!-- END : App Views submenu list -->
					</li>
					<!-- END : Link with submenu -->
					<?php endif; ?>
				</ul>
			</div>	
			<!-- FIN RAPPORT -->
			<!-- DEBUT GESTION -->  
			<div class="mainnav__categoriy py-3" id="sidebar-menu">
				<!-- <h6 class="mainnav__caption mt-0 px-3 fw-bold">PARAMETRAGE</h6> -->
				<ul class="mainnav__menu nav flex-column">
				<?php if (isset($menu_roles['GESTION'])) : ?>
					<li class="nav-item has-sub">
						<a href="#" class="mininav-toggle nav-link collapsed"><i class="demo-pli-gear fs-5 me-2"></i>
							<span class="nav-label ms-1">GESTION</span>
						</a>
						<!-- Tables submenu list -->
						<ul class="mininav-content nav collapse">
							<?php if (isset($smenu_roles['LST_ARTICLES']['d_read'])) : ?>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>articles/C_articles" class="nav-link menu" id="menu_articles">ARTICLES</a>
								</li>
							<?php endif; ?>
							<?php if (isset($smenu_roles['LST_PUBLICATIONS']['d_read'])) : ?>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>publications/C_publications" class="nav-link menu" id="menu_publications">PUBLICATIONS</a>
								</li>
							<?php endif; ?>
							<?php if (isset($smenu_roles['LST_SERVICES']['d_read'])) : ?>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>services/C_services" class="nav-link menu" id="menu_services">SERVICES</a>
								</li>
							<?php endif; ?>
						</ul>
						<!-- END : Tables submenu list -->
					</li>
				<?php endif; ?>
				</ul>
			</div>
			<!-- FIN GESTION -->
			<!-- DEBUT PARAMETRAGE -->  
			<div class="mainnav__categoriy py-3" id="sidebar-menu">
				<!-- <h6 class="mainnav__caption mt-0 px-3 fw-bold">PARAMETRAGE</h6> -->
				<ul class="mainnav__menu nav flex-column">
				<?php if (isset($menu_roles['PARAMETRES'])) : ?>
					<li class="nav-item has-sub">
						<a href="#" class="mininav-toggle nav-link collapsed"><i class="demo-pli-gear fs-5 me-2"></i>
							<span class="nav-label ms-1">PARAMETRES</span>
						</a>
						<!-- Tables submenu list -->
						<ul class="mininav-content nav collapse">
							<?php if (isset($smenu_roles['LST_ANNEES']['d_read'])) : ?>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>parametres/C_annees" class="nav-link menu" id="menu_annees">ANNEES</a>
								</li>
							<?php endif; ?>
						</ul>
						<!-- END : Tables submenu list -->
					</li>
				<?php endif; ?>
				</ul>
			</div>
			<!-- FIN PARAMETRAGE -->
			<!-- DEBUT SECURITE -->
			<div class="mainnav__categoriy py-3" id="sidebar-menu">
			<?php if (isset($menu_roles['SECURITE'])) : ?>
				<h6 class="mainnav__caption mt-0 px-3 fw-bold">ADMINISTRATION</h6>
				<ul class="mainnav__menu nav flex-column">
					<!-- Link with submenu -->
					
						<li class="nav-item has-sub">
							<a href="#" class="mininav-toggle nav-link collapsed"><i class="demo-pli-computer-secure fs-5 me-2"></i>
								<span class="nav-label ms-1">SECURITE</span>
							</a>
							<!-- App Views submenu list -->
							<ul class="mininav-content nav collapse">
								<?php if (isset($smenu_roles['LST_STRUCTURE']['d_read'])) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url(); ?>sys/C_structure" class="nav-link menu" id="menu_structure">STRUCTURE</a>
									</li>
								<?php endif; ?>
								<?php if (isset($smenu_roles['LST_PERSONNEL']['d_read'])) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url(); ?>sys/C_personnel" class="nav-link menu" id="menu_personnel">PERSONNEL</a>
									</li>
								<?php endif; ?>

								<?php if (isset($smenu_roles['USR']['d_read'])) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url(); ?>sys/C_sys_user" class="nav-link menu" id="menu_sys_users">UTILISATEUR</a>
									</li>
								<?php endif; ?>

								<?php if (isset($smenu_roles['MENU']['d_read'])) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url(); ?>sys/C_sys_menu" class="nav-link menu" id="menu_sys_menu">MENUS</a>
									</li>
								<?php endif; ?>

								<?php if (isset($smenu_roles['LST_MENU']['d_read'])) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url(); ?>sys/C_sys_menu/list_menu" class="nav-link menu" id="menu_list_menu">LISTE MENUS</a>
									</li>
								<?php endif; ?>

								<?php if (isset($smenu_roles['LST_S_MENU']['d_read'])) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url(); ?>sys/C_sys_menu/list_sous_menu" class="nav-link menu" id="menu_list_sous_menu">LISTE SOUS MENUS</a>
									</li>
								<?php endif; ?>

								<?php if (isset($smenu_roles['PROFIL']['d_read'])) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url(); ?>sys/C_sys_profil" class="nav-link menu" id="menu_sys_profils">PROFILS</a>
									</li>
								<?php endif; ?>

							</ul>
							<!-- END : App Views submenu list -->
						</li>
						<!-- END : Link with submenu -->
					<?php endif; ?>
				</ul>
			</div>
			<!-- FIN SECURITE -->
		</div>
		<!-- FIN MENU DE NAVIGATION -->
		<!-- DEBUT DECONNECTION -->
		<div class="mainnav__bottom-content border-top pb-2">
			<ul id="mainnav" class="mainnav__menu nav flex-column">
				<li class="nav-item has-sub">
					<a href="<?php echo base_url(); ?>se_deconnecter" class="nav-link mininav-toggle collapsed" aria-expanded="false">
						<i class="demo-pli-unlock fs-5 me-2"></i>
						<span class="nav-label ms-1">Se deconnecter</span>
					</a>

				</li>
			</ul>
		</div>
		<!-- FIN DECONNECTION -->
	</div>
</nav>
<?php unset($menu_roles, $smenu_roles, $tab_data_ses); ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END - MAIN NAVIGATION -->

