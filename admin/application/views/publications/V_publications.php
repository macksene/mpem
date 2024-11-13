
<div class="content__header content__boxed overlapping">
	<div class="content__wrap">

		<!-- Page title and information -->
		<h1 class="page-title mb-2">Gestion des publications</h1>
		<!-- <p>Ici vous pouvez gerer les differents publications de la plateforme.</p> -->
		<!-- <button type="button" id="btn_add" data-bs-toggle="modal" class="btn btn-primary">Ajouter</button> -->

		<?php btn_add_action('LST_PUBLICATIONS') ?>

		<!-- END : Page title and information -->
	</div>

</div>

<div class="content__boxed">
	<div class="content__wrap mt-4">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-buttons" class="table table-striped">
						<thead>
							<tr>
								<th width='5%'>Etat</th>
								<th>Departement</th>
								<th>Categorie</th>
								<th>Citre</th>
								<th>Description</th>
								<th>Date</th>
								<th>Publie</th>
                                <th width='10%'>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($all_data as $value) : ?>
								<tr>
									<td class="fs-5"><?= badge_etat((int)$value->etat) ?></td>
									<td><?= $value->departement ?></td>
									<td><?= $value->categorie ?></td>
									<td><?= $value->titre ?></td>
									<td><?= $value->description ?></td>
									<td><?= date_parse_en2fr($value->date_creation); ?></td>	
                                    <td class="fs-5"><?= badge_etat((int)$value->publie) ?></td>
									<td class="actions">
										<?php btn_edit_action($value->id_publications, 'LST_PUBLICATIONS'); ?> &nbsp;
										<?php btn_delete_action($value->id_publications, 'LST_PUBLICATIONS'); ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="modal_form" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="modal_formLabel" aria-hidden="true">
	<form action="#" id="form" class="form-horizontal" enctype = "multipart/form-data">
		<div class="modal-dialog modal-xl" style="width:100%">
			<div class="modal-content">


				<div class="modal-header">
					<h4 class="modal-title" id="modal_formLabel">Ajout d'une publication</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<div class="modal-body">
				<input type="hidden" id="id_publications" name="id_publications"/>

                    <div class="row g-3">
						<div class="col-sm-4">
							<input name="titre" id="titre" type="text" class="form-control" placeholder="Titre" aria-label="titre" required>
						</div>
						<div class="col-sm-8">
							<textarea name="description" id="description" class="form-control" placeholder="description" rows="1"></textarea>
						</div>
						<div class="form-floating col-sm-4">
							<select class="form-select" id="departement" name="departement" aria-label="departement">
								<option value="energie">Energie</option>
								<option value="petrole">Pétrole</option>
								<option value="mines">Mines et Géologie</option>
							</select>
							<label for="floatingSelect">Departement</label>
						</div>
						<div class="form-floating col-sm-4">
							<select class="form-select" id="categorie" name="categorie" aria-label="categorie">
								<option value="convention">Convention</option>
								<option value="lois">Lois et decrets</option>
								<option value="contrat">Contrat</option>
								<option value="offre">Offre</option>
							</select>
							<label for="floatingSelect">Categorie</label>
						</div>

						<div class="form-floating col-sm-4">
							<select class="form-select" id="publie" name="publie" aria-label="publie">
								<option value="1">OUI</option>
								<option value="-1">NON</option>
							</select>
							<label for="floatingSelect">Publie</label>
						</div>

						<div class="mb-6">
							<label for="floatingSelect">Photo</label>	
							<input id="photo" name="photo" type="file" class="form-control" placeholder="photo" aria-label="photo" required>
						</div>
						<div class="mb-6">
							<label for="floatingSelect">Fichier</label>	
							<input id="fichier" name="fichier" type="text" class="form-control" placeholder="fichier" aria-label="fichier" required>
						</div>

				    </div> 
					<?= section_etat_form("Etat publication", "etat"); ?>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Enregistrer" />
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</form>
	<!-- /.modal -->
</div>

<script type="text/javascript">

        //$(document).ready(function () {

            $('#datatable-buttons').managing_ajax({
                id_menu: 'menu_publications', 
                id_modal_form: 'modal_form',

                id_form: 'form',
                url_submit: "<?php echo site_url('publications/C_publications/save')?>",

                title_modal_add: 'Ajouter une publication',
                focus_add: 'id_publications',

                title_modal_edit: 'Modifier une publication',
                focus_edit: 'titre',

                url_edit: "<?php echo site_url('publications/C_publications/get_record')?>",
                url_delete: "<?php echo site_url('publications/C_publications/delete')?>",
            });

       // });

    </script>

