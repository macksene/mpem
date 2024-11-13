<style>
.table > tbody > tr > td,
{
  padding: 2px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
}

.titre{
	color:##0892b1;
	font-weight:bold;
	background-color: #08b1a4;
}

.thtitre{
	color:##0892b1;
	font-weight:bold;
	background-color:#08b1a4;
}

.table th, .table td { 
        border-top: none !important;
        border-left: none !important;
    }

</style>

<div class="content__header content__boxed overlapping">
	<div class="content__wrap">

		<!-- Page title and information -->
		<h1 class="page-title mb-2">Arborescence des menus</h1>
		<!-- <p>Ici vous pouvez gerer les differents profils de la plateforme.</p> -->
		<!-- <button type="button" id="btn_add" data-bs-toggle="modal" class="btn btn-primary">Ajouter</button> -->

	

		<!-- END : Page title and information -->
	</div>

</div>

<div class="content__boxed">
	<div class="content__wrap mt-4">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
				<?php 
				$k = 0;  ///Incremente les parcours de la table data_menu
				$i = 0;  /// Pointeur sur les menus
				$menu_parent = '';
				foreach($menu_liste as $smenu){
					$k = $smenu->id_sous_menu;
					if($i != $smenu->id_menu){
						$i = $smenu->id_menu;
						if($menu_parent != ''){  ///On a dépassé le premier tour
						?>
						</table>
						<?php 		
						}
						///Cela nous servira de repere pour pouvoir fermer le tableau
						$menu_parent = $smenu->m_libelle;
						?>
						<table  width="100%" id="datatable-buttons" class="table table-striped">
							<tr>
								<thead class="titre">
								<td width="30%">MENUS</td>
								<td>SOUS-MENUS</td>
							</thead>
						</tr>
						<tr>
							<td><b><?php echo $menu_parent;?></b></td>
							<td><?php echo $smenu->sm_libelle ?></td>
						</tr>
					<?php 
					}
					else{
					?>
						<tr>
							<td></td>
							<td><?php echo $smenu->sm_libelle ?></td>
						</tr>
					<?php
					}
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>

