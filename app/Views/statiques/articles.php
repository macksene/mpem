<?php $id_articles = htmlspecialchars($_GET['id']); ?>
<div class="row">
	<?php 
		if (! empty($articles) && is_array($articles)) : ?>
		<?php foreach ($articles as $article): 					
        if($article['id_articles'] == $id_articles):
        ?>			
            <!-- CITY SERVICES2 WRAP START-->
			<div class="city_health_department">
				<div class="container">
					<div class="city_health2_fig">
						<figure class="box">
							<div class="box-layer layer-1"></div>
							<div class="box-layer layer-2"></div>
							<div class="box-layer layer-3"></div>
							<img src="admin/assets/upload/articles/<?php echo $article['photo'];?>" alt="">
						</figure>	
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="sidebar_widget">
								<!-- SIDE SUBMIT FORM START-->
								<form action="message" method="post">
								<div class="side_submit_form">
									<h4 class="sidebar_title">Ecrivez-nous</h4>
									<div class="side_submit_field">
										<input type="text" placeholder="Prenom" name = "prenom">
										<input type="text" placeholder="Nom" name = "nom">
										<input type="email" placeholder="Email" name = "email">
										<input type="text" placeholder="Objet" name = "objet">
										<textarea name = "message">Message</textarea>
										<button type = "submit" class="theam_btn btn2">Envoyer</button>
									</div>
								</div>
								<!-- SIDE SUBMIT FORM END-->
								</form>
							</div>
						</div>
						<div class="col-md-9">
							<div class="city_health2_row">
								<!--CITY HEALTH TEXT START-->
								<div class="city_health2_text">
									<!--SECTION HEADING START-->
									<div class="section_heading">
										<span><?php echo date('d-m-Y', strtotime(str_replace('/', '-', $article['date_creation'])));?></span>
										<h3><?php echo $article['titre'];?></h3>
									</div>
									<!--SECTION HEADING END-->
									<p><?php echo $article['contenu'];?></p>
									
								</div>
								<!--CITY HEALTH TEXT END-->

							</div>
						</div>
					</div>	
				</div>	
			</div>
			<!-- CITY SERVICES2 WRAP END-->
        <?php endif ?>
		<?php endforeach; ?>
		<?php endif ?>
	</div>
</div>
<div class="city_blog2_wrap">
				<div class="container">
					<!--SECTION HEADING START-->
					<div class="section_heading margin-bottom">
							<h2>Denières actualités</h2>
						</div>
						<!--SECTION HEADING END-->
						<div class="row">
						<?php $i = 0;
						if (! empty($articles) && is_array($articles)) : ?>
						<?php foreach ($articles as $article): ?>
						<div class="col-md-4 col-sm-6">
							<div class="city_blog2_fig">
								<figure class="overlay">
									<img src="admin/assets/upload/articles/<?php echo $article['photo'];?>" alt="">
									
								</figure>
								<div class="city_blog2_list">
									<ul class="city_meta_list">
										<li><a href="articles?id=<?php echo $article["id_articles"]; ?>"><i class="fa fa-calendar"></i><?php echo $article['date_creation'];?></a></li>
									</ul>
									<div class="city_blog2_text">
										<h5><a href="articles?id=<?php echo $article["id_articles"]; ?>"><?php echo $article['titre'];?> </a></h5>
										<p><?php echo $article['description'];?></p>
										<a class="see_more_btn" href="articles?id=<?php echo $article["id_articles"]; ?>">LIRE<i class="fa icon-right-arrow"></i></a>
									</div>
								</div>
							</div>
						</div>
					
						<?php if (++$i == 3) break;?>
						<?php endforeach; ?>
						<?php endif ?>
							
						</div>
					</div>
					</div>
				</div>
			</div>



