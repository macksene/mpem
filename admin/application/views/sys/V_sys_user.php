<div class="content__header content__boxed overlapping">
	<div class="content__wrap">
		<!-- Page title and information -->
		<h1 class="page-title mb-2">Gestion des utilisateurs</h1>
		<!-- <p>Ici vous pouvez gerer les differents utilisateurs de la plateforme.</p> -->
		<?php btn_add_action('USR') ?>
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
								<th>Nom complet</th>
								<th>Profil</th>
								<th style="width: 15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($all_data as $value) : ?>
								<tr>
									<td class="fs-5"><?= badge_etat((int)$value->statut) ?></td>
									<td><?= $value->matricule; ?></td>
									<td><?= strtoupper($value->prenom) . ' ' . strtoupper($value->nom); ?></td>
									<td><?= $value->libelle_type_profil; ?></td>									
									<td class="actions">
										<div class="text-nowrap text-center">
											<?php btn_edit_action($value->matricule, 'USR'); ?> &nbsp;
											<?php btn_delete_action($value->id_sys, 'USR'); ?>
										</div>	
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
					<h4 class="modal-title" id="modal_formLabel">title</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input name="id" id="id" type="text" hidden>
					<!-- <input type="hidden" name="code_acces" id="code_acces" /> -->
					<!-- <input type="hidden" name="email_pro" id="email_pro" /> -->

					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">matricule</label>
							<div class="col-md-9">
								<input name="matricule" id="matricule" class="form-control" type="text" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Profile</label>
							<div class="col-md-9">
								<select name="id_profil" id="id_profil" class="form-control" required>
									<?php echo $select_profile; ?>
								</select>
							</div>
						</div>

						<?= section_etat_form("Etat Utilisateur", "statut"); ?>
					</div>
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
</div><!-- /.modal -->


<script type="text/javascript">
	//$(document).ready(function (){

	$('#datatable-buttons').managing_ajax({
		id_menu: 'menu_sys_users', //id du menu dans le fichier de (navigation) dans notre cas left_side_bar
		id_modal_form: 'modal_form', //id du modal qui contient le formulaire

		id_form: 'form', //id du formulaire
		url_submit: "<?php echo site_url('sys/C_sys_user/save') ?>", //url du save (données envoyés par post)

		title_modal_add: 'Nouveau utilisateur', //Title du modal à l'ouverture en mode ajout
		focus_add: 'matricule', //l'emplacement du focus en mode ajout

		title_modal_edit: 'Edition utilisateur', //Title du modal à l'ouverture en mode edit
		focus_edit: 'id_profil', //l'emplacement du focus en mode edit

		url_edit: "<?php echo site_url('sys/C_sys_user/get_record') ?>", //url le fonction qui recupére la données de la ligne
		url_delete: "<?php echo site_url('sys/C_sys_user/delete') ?>", //url de la fonction supprimé
	});

	// NOTE: make the matricule readonly when modifying the user profil
	$(document).on('show.bs.modal', '.modal', function() {
		const userID = $('#form input[name=id]');
		const usermatricule = $('#form input[name=matricule]');

		if (userID.val() !== '') usermatricule.prop('readonly', true);
	});

	$('#datatable tbody').on('click', '.info_conn', function() {

		$('#modal_form').modal('hide');

		//console.log($(this).attr('id'));
		var href = "<?php echo site_url('C_connexions/gen_pass/') ?>" + $(this).attr('id');

		$('#loadingModal').modal('show');
		$.ajax({
			url: href,
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				/*$('#loadingModal').modal('hide');*/
				$('#loadingModal').modal('hide');
				$.Notification.autoHideNotify(data.status, 'bottom right', 'Sending', data.message);
				$('#' + menu_encours).click();
			},
			error: function(jqXHR) {
				content.html(jqXHR.responseText);
				content.show();
			}
		});
		return false;
	});
	//});
</script>
