<div class="content__header content__boxed overlapping">
	<div class="content__wrap">

		<!-- Page title and information -->
		<h1 class="page-title mb-2">Gestion des profils</h1>
		<!-- <p>Ici vous pouvez gerer les differents profils de la plateforme.</p> -->
		<!-- <button type="button" id="btn_add" data-bs-toggle="modal" class="btn btn-primary">Ajouter</button> -->
		<?php btn_add_action('PROFIL') ?>
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
								<th>Libelle</th>
								<th>Roles</th>
								<th style="width: 10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($all_data as $value) : ?>
								<tr>
									<td class="fs-5"><?= badge_etat((int)$value->etat) ?></td>
									<td><?= $value->libelle_type_profil ?></td>
									<td>
										<button profil="<?php echo $value->libelle_type_profil; ?>" id_profil="<?php echo $value->id_type_profil; ?>" type="button" class="btn btn-light hstack gap-2 rounded-pill btn-role">
											<i class="demo-pli-male" />
											Role
										</button>
									</td>
									
									<td class="actions" style="width: 1%; text-align: center; white-space: nowrap">
										<?php btn_edit_action($value->id_type_profil, 'PROFIL'); ?> &nbsp;
										<?php btn_delete_action($value->id_type_profil, 'PROFIL'); ?>&nbsp;
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

<div id="modal_role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="row">
		<div class="col-md-12">
			<div class="modal-dialog" style="max-width: 1024px">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel">
							CONFIGURATION DES ROLES POUR
							<span style="color:#F00; text-transform:uppercase;" id="role_profil">
								<?php ///echo $value->libelle_type_profil ; 
								?>
							</span>
						</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" id="modal-body">
					</div>
				</div><!-- /.modal-content -->
			</div>
		</div>
	</div>
	<!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_formLabel" aria-hidden="true">
	<form action="#" id="form" class="form-horizontal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_formLabel">Ajout de profil</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_type_profil" name="id_type_profil" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Libelle</label>

							<div class="col-md-9">
								<input name="libelle_type_profil" id="libelle_type_profil" class="form-control" type="text" required>
							</div>
						</div>
					</div>

					<?= section_etat_form("Etat Profil", "etat"); ?>
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
		id_menu: 'menu_sys_profils', //id du menu dans le fichier de (navigation) dans notre cas left_side_bar
		id_modal_form: 'modal_form', //id du modal qui contient le formulaire

		id_form: 'form', //id du formulaire
		url_submit: "<?php echo site_url('sys/C_sys_profil/save') ?>", //url du save (données envoyés par post)

		title_modal_add: 'Nouveau profil', //Title du modal à l'ouverture en mode ajout
		focus_add: 'libelle', //l'emplacement du focus en mode ajout

		title_modal_edit: 'Edition de profil', //Title du modal à l'ouverture en mode edit
		focus_edit: 'libelle', //l'emplacement du focus en mode edit

		url_edit: "<?php echo site_url('sys/C_sys_profil/get_record') ?>", //url le fonction qui recupére la données de la ligne
		url_delete: "<?php echo site_url('sys/C_sys_profil/delete') ?>", //url de la fonction supprimé
	});

	$('.btn-role').on('click', function(event) {
		var id_cur_profil = $(this).attr('id_profil');
		var cur_profil = $(this).attr('profil');

		//Appel controller/action/id
		$.ajax({
			url: '<?php echo site_url('sys/C_sys_profil/get_menu_liste/') ?>' + id_cur_profil,
			type: "GET",
			dataType: "HTML",
			success: function(data) {
				//alert(data);
				$('#modal-body').html(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
			}
		});

		$("#role_profil").text(cur_profil);
		$("#id_role_profil").val(id_cur_profil);
		$('#modal_role').modal('show');
	});
</script>
