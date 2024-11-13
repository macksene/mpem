<div class="content__header content__boxed overlapping">
	<div class="content__wrap">
		<!-- Page title and information -->
		<h1 class="page-title mb-2">Gestion des annees</h1>
		<!-- <p>Ici vous pouvez gerer les annees de la plateforme.</p> -->
		<?php btn_add_action('LST_ANNEES') ?>
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
								<th>Années</th>
								<th width='10%'>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($all_data as $value) : ?>
								<tr>
									<td class="fs-5"><?= badge_etat((int)$value->etat_annees) ?></td>
									<td><?= $value->libelle_annees ?></td>
									<td class="actions">
										<?php btn_edit_action($value->id_annees, 'LST_ANNEES'); ?> &nbsp;
										<?php btn_delete_action($value->id_annees, 'LST_ANNEES'); ?>
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

<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_formLabel" aria-hidden="true">
	<form action="#" id="form" class="form-horizontal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_formLabel">Ajout d'annee</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body row g-3">
					<input type="text" id="id_annees" name="id_annees" hidden />

					<div class="col-md-6">
						<label for="libelle_annees" class="form-label">libelle_annees <span class="text-danger">*</span></label>
						<!-- TODO: make this a number or a date field -->
						<input name="libelle_annees" id="libelle_annees" type="text" class="form-control" required>
					</div>

					<?= section_etat_form("Etat Annee", "etat_annees"); ?>
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
	$('#datatable-buttons').managing_ajax({
		id_menu: 'menu_annees',
		id_modal_form: 'modal_form',

		id_form: 'form',
		url_submit: "<?php echo site_url('parametres/C_annees/save') ?>",

		title_modal_add: 'Ajouter une annee',
		focus_add: 'libelle_annees',

		title_modal_edit: 'Modifier une annee',
		focus_edit: 'libelle_annees',

		url_edit: "<?php echo site_url('parametres/C_annees/get_record') ?>",
		url_delete: "<?php echo site_url('parametres/C_annees/delete') ?>",
	});
</script>
