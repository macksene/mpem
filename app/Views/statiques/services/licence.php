
			
			<!-- CITY EVENT2 WRAP START-->
			<div class="city_event2_wrap">
				<div class="container">
					<!--SECTION HEADING START-->
					
					<div class="section_heading margin-bottom">
						<span>MEPM</span>
						<h2>Les licences de distribution</h2>
					</div>
					<!--SECTION HEADING END-->
					<div class="row">
						<div class="col-md-3">
							<div class="sidebar_widget">
								<!-- EVENT SIDEBAR START-->
								<div class="event_sidebar">
									<h4 class="sidebar_heading">Services</h4>
									<div class="categories_list">
										<ul>
											<li><a href="licence">Licences de distribution</a></li>
											<li><a href="titre">Titres miniers</a></li>
											<li><a href="permis">Permis de recherche</a></li>
											<li><a href="autorisations">Autorisations d'exploitation</a></li>
										</ul>
									</div>
								</div>
								<!-- EVENT SIDEBAR END-->
							</div>
						</div>
						<div class="col-md-9">
							<div class="city_event2_list2">
								<ul>
								<?php 
								if (! empty($licence) && is_array($licence)) : ?>
								<?php foreach ($licence as $pub): ?>	
									<li>
										<div class="city_event2_list2_row">
											<div class="city_event2_list2_fig">
												<figure class="box">
													<div class="box-layer layer-1"></div>
													<div class="box-layer layer-2"></div>
													<div class="box-layer layer-3"></div>
													<img src="admin/assets/upload/services/<?php echo $pub['photo'];?>" alt="">
													<div class="event_categories_date">
														<h5><?php echo date('d', strtotime(str_replace('/', '-', $pub['date_creation'])));?></h5>
														<p><?php echo date('m-Y', strtotime(str_replace('/', '-', $pub['date_creation'])));?></p>
													</div>
												</figure>
											</div>
											<div class="city_blog_text event2">
												<span><?php echo $pub['departement'];?></span>
												<h4><a href="#"><?php echo $pub['titre'];?></a></h4>
												<ul class="city_meta_list">

													<li><a href="#"></a></li>
												</ul>
												<p><?php echo $pub['description'];?></p>
												<div class="city_blog_social">
													<a class="theam_btn border-color" href="admin/assets/upload/services/<?php echo $pub['fichier'];?>" target="_blank" tabindex="0">Voir</a>
													
												</div>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
								<?php endif ?>
								</ul>
								
								<div class="pagination">
								<!-- pagination -->
								<?= $pager->links()?>
								<!-- pagination -->	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- CITY EVENT2 WRAP END-->