<div class="content__header content__boxed overlapping">
	<div class="content__wrap">
		<!-- Page title and information -->
		<h1 class="page-title mb-2">Gestion des structures</h1>
		<!-- <p>Ici vous pouvez gerer les structures de la plateforme.</p> -->
		<?php btn_add_action('LST_STRUCTURE') ?>
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
								<th>Libelle</th>
								<th>Sigle</th>
								<th>Categorie</th>
								<th>Email</th>
								<th>Telephone</th>
								<th width='10%'>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($all_data as $value) : ?>
								<tr>
									<td class="fs-5"><?= badge_etat((int)$value->etat_str) ?></td>
									<td><?= $value->libelle ?></td>
									<td><?= $value->sigle_str ?></td>
									<td><?= $value->categorie ?></td>
									<td><?= $value->email_str ?></td>
									<td><?= $value->tel_str ?></td>
									<td class="actions">
										<?php btn_edit_action($value->code_str, 'LST_STRUCTURE'); ?> &nbsp;
										<?php btn_delete_action($value->code_str, 'LST_STRUCTURE'); ?>
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
					<h4 class="modal-title" id="modal_formLabel">Nouvelle structure</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body row g-3">
					<input type="text" id="code_str" name="code_str" hidden />

					<div class="col-md-12">
						<label for="libelle" class="form-label">libelle </label>
						<input name="libelle" id="libelle" type="text" class="form-control" required>
					</div>
					<div class="col-md-6">
						<label for="sigle_str" class="form-label">Sigle </label>
						<input name="sigle_str" id="sigle_str" type="text" class="form-control" required>
					</div>
					<div class="col-md-6">
						<label for="categorie" class="form-label">Categorie </label>
						<select id="categorie" name="categorie" class="form-select" required>
							<option value="central"> Niveau central</option>
							<option value="deconcentre">Niveau deconcentre</option>
							<option value="autre">Autre</option>
						</select>
					</div>
					
					<div class="col-md-6">
						<label for="email_str" class="form-label">Email </label>
						<!-- TODO: make this a number or a date field -->
						<input name="email_str" id="email_str" type="text" class="form-control" required>
					</div>
					<div class="col-md-6">
						<label for="tel_str" class="form-label">Telephone </label>
						<!-- TODO: make this a number or a date field -->
						<input name="tel_str" id="tel_str" type="text" class="form-control" required>
					</div>

					<?= section_etat_form("Etat Structure", "etat_str"); ?>
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
		id_menu: 'menu_structure',
		id_modal_form: 'modal_form',

		id_form: 'form',
		url_submit: "<?php echo site_url('sys/C_structure/save') ?>",

		title_modal_add: 'Ajouter une structure',
		focus_add: 'code_str',

		title_modal_edit: 'Modifier une structure',
		focus_edit: 'libelle',

		url_edit: "<?php echo site_url('sys/C_structure/get_record') ?>",
		url_delete: "<?php echo site_url('sys/C_structure/delete') ?>",
	});
</script>
