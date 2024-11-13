<div class="content__header content__boxed overlapping">
	<div class="content__wrap">
		<!-- Page title and information -->
		<h1 class="page-title mb-2">Gestion des personnel de mesure</h1>
		<!-- <p>Ici vous pouvez gerer les differents sous menus de la plateforme.</p> -->
		<?php btn_add_action('LST_PERSONNEL') ?>
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
								<th style="width: 5%">Etat</th>
								<th>matricule</th>
								<th>Prenom</th>
								<th>Nom</th>
								<th>Email</th>
								<th>Structure</th>
								<th style="width: 10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($all_data as $value) : ?>
								<tr>
									<td class="fs-5"><?= badge_etat((int)$value->etat) ?></td>	
									<td><?= $value->matricule ?></td>
									<td><?= $value->prenom ?></td>
									<td><?= $value->nom ?></td>
									<td><?= $value->email_pro ?></td>
									<td><?= $value->sigle_str ?></td>
									<td class="actions">
										<?php btn_edit_action($value->id, 'LST_PERSONNEL'); ?> &nbsp;
										<?php btn_delete_action($value->id, 'LST_PERSONNEL'); ?>
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
					<h4 class="modal-title" id="modal_formLabel">Nouveau indicateur</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body row g-3">
					<input type="text" id="id" name="id" hidden />

					<div class="col-md-6">
						<label for="matricule" class="form-label">matricule <span class="text-danger">*</span></label>
						<input name="matricule" id="matricule" type="text" class="form-control" required>
					</div>

					<div class="col-md-6">
						<label for="prenom" class="form-label">prenom <span class="text-danger">*</span></label>
						<input name="prenom" id="prenom" type="text" class="form-control" required>
					</div>

					<div class="col-md-6">
						<label for="nom" class="form-label">nom <span class="text-danger">*</span></label>
						<input name="nom" id="nom" type="text" class="form-control" required>
					</div>

					<div class="col-md-6">
						<label for="email_pro" class="form-label">email <span class="text-danger">*</span></label>
						<input name="email_pro" id="email_pro" type="text" class="form-control" required>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">Structure</label>
						<div class="col-md-9">
							<select name="code_str" id="code_str" class="form-control" required>
								<?php echo $select_structure; ?>
							</select>
						</div>
					</div>

					<?= section_etat_form("Etat personnel", "etat"); ?>
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
		id_menu: 'menu_personnel',
		id_modal_form: 'modal_form',

		id_form: 'form',
		url_submit: "<?php echo site_url('sys/C_personnel/save') ?>",

		title_modal_add: 'Ajouter un personnel',
		focus_add: 'matricule',

		title_modal_edit: 'Modifier un personnel',
		focus_edit: 'matricule',

		url_edit: "<?php echo site_url('sys/C_personnel/get_record') ?>",
		url_delete: "<?php echo site_url('sys/C_personnel/delete') ?>",
	});
</script>
