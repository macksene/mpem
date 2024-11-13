			<!-- SAB BANNER START-->
			<!-- <div class="sab_banner overlay">
				<div class="container">
					<div class="sab_banner_text">
						<h2>News Post</h2>
						<ul class="breadcrumb">
						  <li class="breadcrumb-item"><a href="#">Home</a></li>
						  <li class="breadcrumb-item active">News Post</li>
						</ul>
					</div>
				</div>
			</div> -->
			<!-- SAB BANNER END-->
			
			<!-- CITY EVENT2 WRAP START-->
			<div class="city_blog2_wrap">
				<div class="container">
					
					<div class="col-md-12">
							<div class="city_health2_row">

								<!--CITY HEALTH TEXT START-->
								<div class="city_health2_text text2">
									<!--SECTION HEADING START-->
									<div class="section_heading">
										<h3>CONTRATS</h3>
									</div>
									<!--SECTION HEADING END-->
									<p>Le Sénégal s’est doté d’un dispositif juridique rigoureux et performant qui traverse le temps : il s’agit de la Loi 98-05 du 8 janvier 1998 portant code pétrolier, qui définit les conditions d’exploration, de développement et d’exploitation des hydrocarbures. Ladite Loi n°98-05 du 8 janvier 1998 portant Code pétrolier et son décret d’application (n°98-810 du 6 octobre 1998) régissent « la prospection, la recherche, l’exploitation et le transport des hydrocarbures, ainsi que le régime fiscal de ces activités ». Un exercice de révision de cette Loi est en cours.</p>
									<p>En vertu du Code pétrolier de 1998, l’État peut « autoriser une ou plusieurs personnes physiques ou morales de son choix, de nationalité sénégalaise ou étrangère, à entreprendre des opérations pétrolières ». De même, « l’État, directement ou par l’intermédiaire d’une société d’État, se réserve le droit de participer à tout ou partie des opérations pétrolières en s’associant avec les titulaires d’un titre minier d’hydrocarbures »</p>
								</div>
								<!--CITY HEALTH TEXT END-->
								
							</div>
						</div>
					<div class="row">
					<?php 
						if (! empty($contrats) && is_array($contrats)) : ?>
						<?php foreach ($contrats as $pub): ?>
						<div class="col-md-6">
							<div class="city_news2_post post2">
								<figure class="box">
									<div class="box-layer layer-1"></div>
									<div class="box-layer layer-2"></div>
									<div class="box-layer layer-3"></div>
									<img src="admin/assets/upload/publications/<?php echo $pub['photo'];?>" alt="">
								</figure>
								<div class="city_news2_detail">
									<ul class="city_meta_list">
										<li><a href="#"><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime(str_replace('/', '-', $pub['date_creation'])));?></a></li>
									</ul>
									<h4><?php echo $pub['titre'];?></h4>
									<a class="theam_btn bg-color color" href="admin/assets/upload/publications/<?php echo $pub['fichier'];?>" target="_blank" tabindex="0">voir</a>
								</div>
							</div>						
						</div>
						<?php endforeach; ?>
						<?php endif ?>
						<div class="pagination">
						<!-- pagination -->
						<?= $pager->links()?>
						<!-- pagination -->	
					</div>
					</div>	
				</div>
			</div>
			<!-- CITY EVENT2 WRAP END-->