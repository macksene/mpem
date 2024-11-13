<div class="content__header content__boxed overlapping">
	<div class="content__wrap">

		<!-- Page title and information -->
		<h1 class="page-title mb-2">Gestion des menus</h1>
		<!-- <p>Ici vous pouvez gerer les differents profils de la plateforme.</p> -->
		<!-- <button type="button" id="btn_add" data-bs-toggle="modal" class="btn btn-primary">Ajouter</button> -->

		<?php btn_add_action('LST_MENU') ?>

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
								<th style="width: 35%">Code</th>
								<th >Libelle</th>
								
								<th style="width: 10%">Action</th>
							</tr>


						</thead>
						<tbody>
							<?php foreach ($menu_liste as $value) : ?>
								<tr>
									<td class="fs-5"><?= badge_etat((int)$value->etat) ?></td>
									<td><?= $value->code ?></td>
									<td><?= $value->libelle ?></td>
									
									<td class="actions" style="width: 1%; text-align: center; white-space: nowrap">
										<?php btn_edit_action($value->id_menu, 'LST_MENU'); ?> &nbsp;
										<?php btn_delete_action($value->id_menu, 'LST_MENU'); ?>&nbsp;
									</td>
								</tr>
							<?php endforeach; ?>
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
					<h4 class="modal-title" id="modal_formLabel">Ajout de menu</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_menu" name="id_menu" />

					<div class="form-group">
						<label class="control-label col-md-4">Code <span class="text-danger">*</span></label>

						<div class="col-md-8">
							<input name="code" id="code" type="text" class="form-control" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-4">Libelle <span class="text-danger">*</span></label>

						<div class="col-md-8">
							<input name="libelle" id="libelle" type="text" class="form-control" required>
						</div>
					</div>

					<?= section_etat_form("Etat Menu", "etat"); ?>
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
		id_modal_form: 'modal_form',

		id_form: 'form',
		url_submit: "<?php echo site_url('sys/C_sys_menu/save_menu') ?>",

		title_modal_add: 'Ajouter un menu',
		focus_add: 'code',

		title_modal_edit: 'Modifier un menu',
		focus_edit: 'libelle',

		url_edit: "<?php echo site_url('sys/C_sys_menu/get_record_menu') ?>",
		url_delete: "<?php echo site_url('sys/C_sys_menu/delete_menu') ?>",
	});

	// });
</script>
