
			<!--DERNIERES NOYVELLES-->
			<div class="city_news_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<!--SECTION HEADING START-->
							<div class="section_heading margin-bottom">
								<span>A la une</span>
								<h2>ALERT</h2>
							</div>
							<!--SECTION HEADING START-->
							<div class="row">
							<?php $i = 0;
							if (! empty($alaune) && is_array($alaune)) : ?>
							<?php foreach ($alaune as $alaun): ?>	
								<?php if ($alaun['alaune'] == 1):?>
									<div class="col-md-12 col-sm-6">
											<div class="city_blog2_fig">
												<figure class="overlay">
													<img src="admin/assets/upload/articles/<?php echo $alaun['photo'];?>" alt="">
												</figure>
												<div class="city_news_text">
													<h2><?php echo $alaun['titre'];?></h2>
													<ul class="city_news_meta">
														<li><a href="articles?id=<?php echo $alaun["id_articles"]; ?>"><?php echo date('d-m-Y', strtotime(str_replace('/', '-', $alaun['date_creation'])));?></a></li>
														<li><a href="articles?id=<?php echo $alaun["id_articles"]; ?>">MEPM</a></li>
													</ul>
													<p><?php echo $alaun['description'];?></p>
													<a class="theam_btn border-color color" href="articles?id=<?php echo $alaun["id_articles"]; ?>" tabindex="0">Lire</a>
												</div>
											</div>
										</div>
									</div>	
							    <?php if (++$i == 1) break;?>
								<?php endif ?>
							<?php endforeach; ?>
							<?php endif ?>
						</div>
						<div class="col-md-4">
						
							<div class="city_news_form">
								<form action="newletter" method="post">
								<div class="city_news_feild">
									<!-- <span>Signup</span> -->
									<h4>Newsletter</h4>
									<p>Inscrivez-vous pour recevoir toutes les nouvelles du ministere  </p>
									<div class="city_news_search">
										<input type="text" name="email" placeholder="Entrer votre adresse email" required>
										<button type = "submit" class="theam_btn border-color color">S'inscrire</button>
									</div>
								</div>
								</form>
								<div class="city_news_feild feild2">
									<span>Recentes</span>
									<h4>Publications</h4>
									<p>Les dernieres publications du ministere. </p>
									<div class="city_document_list">
										<ul>
											<li><a href="assets/docs/UEMOA-Code-minier-communautaire.pdf"><i class="fa icon-document"></i>UEMOA: Code minier communautaire</a></li>
											<li><a href="assets/docs/UEMOA-politique-miniere-commune.pdf" target="_blank"><i class="fa icon-document"></i>UEMOA: Politique miniere commune</a></li>
											<li><a href="assets/docs/CDEAO-model-exploitation-miniere.pdf" target="_blank"><i class="fa icon-document"></i>CDEAO: Modele exploitation miniere</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<!--CITY NEWS WRAP END-->
			<!-- ACTUALITE-->
			<div class="city_blog2_wrap">
				<div class="container">
					<!--SECTION HEADING START-->
					<div class="section_heading center">
						<span>MEPM</span>
						<h2>Actualites</h2>
					</div>
					<!--SECTION HEADING END-->
					<div class="row">
						<?php 
						if (! empty($articles) && is_array($articles)) : ?>
						<?php foreach ($articles as $article): ?>
							<div class="col-md-6 col-sm-6">
								<div class="city_blog2_fig">
									<figure class="overlay">
										<img src="admin/assets/upload/articles/<?php echo $article['photo'];?>" alt="">
									</figure>
									<div class="city_blog2_list">
										<ul class="city_meta_list">
											<li><a href="articles?id=<?php echo $article["id_articles"]; ?>"><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime(str_replace('/', '-', $article['date_creation'])));?></a></li>
										</ul>
										<div class="city_blog2_text">
											<h5><a href="articles?id=<?php echo $article["id_articles"]; ?>"><?php echo $article['titre'];?></a></h5>
											<p><?php echo $article['description'];?></p>
											<a class="see_more_btn" href="articles?id=<?php echo $article["id_articles"]; ?>">LIRE<i class="fa icon-right-arrow"></i></a>
										</div>
									</div>
								</div>
							</div>
						
						<?php endforeach; ?>
						<?php endif ?>
						</div>
					</div>
						
					<div class="pagination">
						<!-- pagination -->
						<?= $pager->links()?>
						<!-- pagination -->	
					</div>
				</div>
			</div>
			<!-- FIN ACTUALITE-->


