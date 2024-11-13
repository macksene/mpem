$.ajaxSetup({ cache: false });

var table = null;
var save_method = null;
var button_click = null;

(function($) {
	$.fn.managing_ajax = function(args) {
		$("#" + id_div_container)
			.find("*")
			.off();
		$("#" + id_div_container).off("click");

		table = null;
		save_method = null;
		button_click = null;

		$.fn.beforeAdd = null;
		$.fn.afterAdd = null;
		$.fn.beforeEdit = null;
		$.fn.afterEdit = null;
		$.fn.beforeSave = null;
		$.fn.afterSave = null;
		$.fn.beforeDelete = null;
		$.fn.afterDelete = null;
		$.fn.afterLoad = null;
		$.fn.searchGrid = null;

		var id_table = $(this)[0].id;
		menu_clicked = args.id_menu != undefined ? args.id_menu : menu_encours;

		//DataTable
		if ($("#" + id_table).length != 0)
			table = $("#" + id_table).DataTable({
				paging: true,
				searching: args.searching != undefined ? args.searching : true,
				columnDefs:
					args.columnDefs == undefined
						? [{ orderable: false, targets: -1 }]
						: args.columnDefs,
				order: args.order == undefined ? [] : args.order,
				lengthMenu: [
					[10, 25, 50, -1],
					[10, 25, 50, "Tout"],
				],
				pageLength: args.pageLength == undefined ? 10 : args.pageLength,
				language: langageFrDataTable(),

				//start ajax
				processing: args.processing != undefined ? args.processing : false,
				serverSide: args.serverSide != undefined ? args.serverSide : false,
				ajax: args.ajax == undefined ? null : { url: args.ajax, type: "POST" },
				aoColumns: args.aoColumns != undefined ? args.aoColumns : null,
				columns: args.colums != undefined ? args.colums : [],
				//end ajax

				drawCallback: function() {
					if ($.fn.afterLoad) $().afterLoad({});
				},
				fnInitComplete: function() { },
				preDrawCallback: function(settings) { },
			});

		//add
		if ($("#btn_add").length != 0 || $(".btn_add").length != 0)
			$("#btn_add,.btn_add").click(function(e) {
				save_method = "add";
				button_click = this;

				$("#" + args.id_form)[0].reset(); // reset form on modals
				$("#" + args.id_modal_form).modal("show"); // show bootstrap modal
				$("#" + args.id_modal_form + " .modal-title").text(
					args.title_modal_add,
				); // Set Title to Bootstrap modal title
			});

		//edit
		if ($("#" + id_table).length != 0)
			$("#" + id_table + " tbody").on("click", ".btn_edit", function() {
				save_method = "update";
				button_click = this;

				var id = $(this).attr("id");
				$("#" + args.id_form)[0].reset(); // reset form on modals

				//beforeEdit
				if ($.fn.beforeEdit) $().beforeEdit({ button: button_click });

				//Ajax Load data from ajax
				$.ajax({
					url: args.url_edit + "/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						load_form_with_data(data);

						//afterEdit
						if ($.fn.afterEdit)
							$().afterEdit({ data: data, button: button_click });

						$("#" + args.id_modal_form).modal("show"); // show bootstrap modal when complete loaded
						$("#" + args.id_modal_form + " .modal-title").text(
							args.title_modal_edit,
						); // Set title to Bootstrap modal title
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert("Error get data from ajax");
					},
				});
			});
		//archiver
		if ($("#" + id_table).length != 0 && args.url_archive != undefined)
			$("#" + id_table + " tbody").on("click", ".btn_archive", function() {
				var id = $(this).attr("id");
				var ltext = "voulez vous confirmer l'archivage ?";
				if ($(this).attr("etat") != undefined && $(this).attr("etat") == "-1") {
					ltext = "voulez vous confirmer la restauration ?";
				}
				swal(
					{
						title: "Alerte",
						text: ltext,
						type: "warning",
						showCancelButton: true,
						dangerMode: true,
						confirmButtonColor: "#f36464",
						cancelButtonColor: "#cccccc",
						cancelButtonText: "Annuler",
						confirmButtonText: "Confirmer",
						closeOnConfirm: true,
						//}).then(function (isConfirm) {
					},
					function(isConfirm) {
						if (isConfirm) {
							// ajax delete data to database
							$.ajax({
								url: args.url_archive + "/" + id,
								type: "GET",
								dataType: "JSON",
								success: function(data) {
									//if success reload ajax table
									$("#" + args.id_modal_form).modal("hide");
									//table.ajax.reload(null, false); //reload datatable ajax

									if (data.status == "success") {
										if (args.link_reload != undefined)
											$("#" + id_div_container)
												.empty()
												.load(args.link_reload)
												.fadeIn("slow");
										else {
											var lhref = $("#" + menu_clicked).attr("href");
											$("#" + id_div_container)
												.empty()
												.load(lhref)
												.fadeIn("slow");
										}

										$.Notification.autoHideNotify(
											"success",
											"bottom right",
											"Alerte",
											data.message,
										);
									} else {
										$.Notification.autoHideNotify(
											"error",
											"bottom right",
											"Alerte",
											data.message,
										);
									}
								},
								error: function(jqXHR, textStatus, errorThrown) {
									alert("Error adding / update data");
								},
							});
						}
					},
				);
			});
		//before ouverture du modal
		if ($("#" + args.id_modal_form).length != 0)
			$("#" + args.id_modal_form).on("show.bs.modal", function(event) {
				if (save_method == "add") {
					if ($.fn.beforeAdd) $().beforeAdd({ button: button_click });
				}
				/*else {
								 if ($.fn.beforeEdit)
								 $().beforeEdit({ });
								 }*/
			});

		//after ouverture du modal
		if ($("#" + args.id_modal_form).length != 0)
			$("#" + args.id_modal_form).on("shown.bs.modal", function(event) {
				if (save_method == "add") {
					$("#" + args.focus_add).focus();
					if ($.fn.afterAdd) $().afterAdd({ button: button_click });
				} else {
					$("#" + args.focus_edit).focus();
				}
			});

		//delete
		if ($("#" + id_table).length != 0)
			$("#" + id_table + " tbody").on("click", ".btn_delete", function() {
				var id = $(this).attr("id");
				swal(
					{
						title: "Alerte",
						text: "voulez vous confirmer la suppression ?",
						type: "warning",
						showCancelButton: true,
						dangerMode: true,
						confirmButtonColor: "#f36464",
						cancelButtonColor: "#f36464",
						cancelButtonText: "Annuler",
						confirmButtonText: "Confirmer",
						closeOnConfirm: true,
						//}).then(function (isConfirm) {
					},
					function(isConfirm) {
						if (isConfirm) {
							// ajax delete data to database
							$.ajax({
								url: args.url_delete + "/" + id,
								type: "GET",
								dataType: "JSON",
								success: function(data) {
									//if success reload ajax table
									$("#" + args.id_modal_form).modal("hide");
									//table.ajax.reload(null, false); //reload datatable ajax

									if (data.status == "success") {
										if (args.link_reload != undefined)
											$("#" + id_div_container)
												.empty()
												.load(args.link_reload)
												.fadeIn("slow");
										else {
											var lhref = $("#" + menu_clicked).attr("href");
											$("#" + id_div_container)
												.empty()
												.load(lhref)
												.fadeIn("slow");
										}

										$.Notification.autoHideNotify(
											"success",
											"bottom right",
											"Alerte",
											data.message,
										);
									} else {
										$.Notification.autoHideNotify(
											"error",
											"bottom right",
											"Alerte",
											data.message,
										);
									}
									/*swal({
																 title: 'Alerte !',
																 text: data.message,
																 type: data.status,
																 showCancelButton: false,
																 confirmButtonColor: '#3085d6',
																 cancelButtonColor: '#d33',
																 confirmButtonText: 'Fermer',
																 closeOnConfirm: true
																 //}).then(function (isConfirm) {
																 }, function(isConfirm) {
																 if(data.status == 'success'){
																 var lhref = $('#'+menu_clicked).attr('href');
																 $('#' + id_div_container).empty().load(lhref).fadeIn('slow');
																 $.Notification.autoHideNotify('success', 'bottom right', 'Alerte', data.message)
																 }
																 else{
																 $.Notification.autoHideNotify('error', 'bottom right', 'Alerte', data.message)
																 }
																 });*/
								},
								error: function(jqXHR, textStatus, errorThrown) {
									alert("Error adding / update data");
								},
							});
						}
					},
				);
			});

		//event validate
		if (args.id_form !== undefined) {
			var validate_rules =
				args.validate_rules == undefined ? [] : args.validate_rules;
			var validate_messages =
				args.validate_messages == undefined ? [] : args.validate_messages;
			validate_form(args.id_form, validate_rules, validate_messages);
		}

		//submit form
		if ($("#" + args.id_form).length != 0)
			$("#" + args.id_form).submit(function(e) {
				var isvalidate = $("#" + args.id_form).valid();
				if (isvalidate === true) {
					var url = args.url_submit;

					//beforeSave
					if ($.fn.beforeSave) {
						if ($().beforeSave({}) == false) return false;
					}

					var url = args.url_submit;

					if ($("#" + args.id_form).attr("enctype") == "multipart/form-data") {
						var form = $("#" + args.id_form)[0];
						// ajax adding data to database
						$.ajax({
							url: url,
							type: "POST",
							enctype: "multipart/form-data",
							data: new FormData(form),
							async: false,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "JSON",
							success: function(data) {
								//if success close modal and reload ajax table
								if (data.status == "success") {
									$("#" + args.id_modal_form).modal("hide");
									$.Notification.autoHideNotify(
										"success",
										"bottom right",
										"Alerte",
										data.message,
									);
								} else {
									$.Notification.autoHideNotify(
										"error",
										"bottom right",
										"Alerte",
										data.message,
									);
								}
								//table.ajax.reload(null, false); //reload datatable ajax
							},
							error: function(jqXHR, textStatus, errorThrown) {
								alert("Error adding / update data");
							},
						});
					} else {
						// ajax adding data to database
						$.ajax({
							url: url,
							type: "POST",
							data: $("#" + args.id_form).serialize(),
							dataType: "JSON",
							success: function(data) {
								//if success close modal and reload ajax table
								if (data.status == "success") {
									$("#" + args.id_modal_form).modal("hide");
									$.Notification.autoHideNotify(
										"success",
										"bottom right",
										"Alerte",
										data.message,
									);
								} else {
									$.Notification.autoHideNotify(
										"error",
										"bottom right",
										"Alerte",
										data.message,
									);
								}
								//table.ajax.reload(null, false); //reload datatable ajax
							},
							error: function(jqXHR, textStatus, errorThrown) {
								alert("Error adding / update data");
							},
						});
					}
				}

				e.preventDefault();
				return false;
			});

		//hidden modal
		if ($("#" + args.id_modal_form).length != 0)
			$("#" + args.id_modal_form).on("hidden.bs.modal", function(event) {
				if (args.link_reload != undefined)
					$("#" + id_div_container)
						.empty()
						.load(args.link_reload)
						.fadeIn("slow");
				else {
					var lhref = $("#" + menu_clicked).attr("href");
					$("#" + id_div_container)
						.empty()
						.load(lhref)
						.fadeIn("slow");
				}
			});

		//btn_search
		if (
			$("#" + args.id_btn_search).length != 0 &&
			$("#" + args.id_form_search).length != 0 &&
			args.processing == undefined
		)
			$("#" + args.id_btn_search).click(function(e) {
				var ldata = $("#" + args.id_form_search).serializeArray();

				if (args.link_reload != undefined)
					$("#" + id_div_container)
						.empty()
						.load(args.link_reload, ldata)
						.fadeIn("slow");
				else {
					var lhref = $("#" + menu_clicked).attr("href");
					$("#" + id_div_container)
						.empty()
						.load(lhref, ldata)
						.fadeIn("slow");
				}
			});

		//btn_search with processing
		if (
			$("#" + args.id_btn_search).length != 0 &&
			args.processing != undefined
		) {
			$("#" + args.id_btn_search).click(function(e) {
				if ($.fn.searchGrid) $().searchGrid({ search: true });
				$("#" + args.id_modal_search).modal("hide");
			});

			$(
				"#" +
				args.id_form_search +
				" input,#" +
				args.id_form_search +
				" select",
			).keypress(function(e) {
				if (e.which == 13 || e.keyCode == 13) {
					if ($.fn.searchGrid) $().searchGrid({ search: true });
					$("#" + args.id_modal_search).modal("hide");
				}
			});
		}

		//btn_search all with processing
		if (
			$("#" + args.id_btn_search_all).length != 0 &&
			args.processing != undefined
		) {
			$("#" + args.id_btn_search_all).click(function(e) {
				$("#" + args.id_form_search)[0].reset();
				if ($.fn.searchGrid) $().searchGrid({ search: false });
				$("#" + args.id_modal_search).modal("hide");
			});
		}

		//search_ien
		if ($("#" + args.id_search_ien).length != 0)
			$("#" + args.id_search_ien).on("click", function() {
				//Ajax Load data from ajax
				$.ajax({
					url: args.url_search_ien + "/" + $("#" + args.input_search_ien).val(),
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						if (data.status == "success") {
							$("#" + args.id_form)[0].reset(); // reset form on modals
							load_form_with_data(data);
							$("#" + args.id_modal_form).modal("show"); // show bootstrap modal when complete loaded
							save_method = "add";
						} else {
							$.Notification.autoHideNotify(
								"error",
								"top center",
								data.message,
							);
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert("Error get data from ajax");
					},
				});
			});
	};

	$.fn.chained_ajax = function(args) {
		var id = $(this)[0].id;
		$("#" + id).change(function(e) {
			var val = $(this).val();
			if (args.id_select != undefined && args.url_select != undefined) {
				$("#" + args.id_select).html("");

				$.ajax({
					url: args.url_select + val,
					type: "GET",
					dataType: "HTML",
					success: function(data) {
						$("#" + args.id_select).html(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert("Error adding / update data");
					},
				});
			}
		});
	};

	$.fn.divcrud = function(args) {
		var id = $(this)[0].id;
		$("#" + id)
			.find("*")
			.off();
		$("#" + id).off("click");

		$.fn.afterSave_divcrud = null;

		//event validate
		if (args.id_form !== undefined) {
			var validate_rules =
				args.validate_rules == undefined ? [] : args.validate_rules;
			var validate_messages =
				args.validate_messages == undefined ? [] : args.validate_messages;
			validate_form(args.id_form, validate_rules, validate_messages);
		}

		//submit form
		if ($("#" + args.id_form).length != 0)
			$("#" + args.id_form).submit(function(e) {
				var isvalidate = $("#" + args.id_form).valid();
				if (isvalidate === true) {
					var url = args.url_submit;
					if ($("#" + args.id_form).attr("enctype") == "multipart/form-data") {
						var form = $("#" + args.id_form)[0];
						// ajax adding data to database
						$.ajax({
							url: url,
							type: "POST",
							enctype: "multipart/form-data",
							data: new FormData(form),
							async: false,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "JSON",
							success: function(data) {
								//if success close modal and reload ajax table
								if (data.status == "success") {
									$.Notification.autoHideNotify(
										"success",
										"bottom right",
										"Alerte",
										data.message,
									);
									if ($.fn.afterSave_divcrud)
										$().afterSave_divcrud({ args: data });
								} else {
									$.Notification.autoHideNotify(
										"error",
										"bottom right",
										"Alerte",
										data.message,
									);
								}
								//table.ajax.reload(null, false); //reload datatable ajax
							},
							error: function(jqXHR, textStatus, errorThrown) {
								alert("Error adding / update data");
							},
						});
					} else {
						// ajax adding data to database
						$.ajax({
							url: url,
							type: "POST",
							data: $("#" + args.id_form).serialize(),
							dataType: "JSON",
							success: function(data) {
								//if success close modal and reload ajax table
								if (data.status == "success") {
									$.Notification.autoHideNotify(
										"success",
										"bottom right",
										"Alerte",
										data.message,
									);
									if ($.fn.afterSave_divcrud)
										$().afterSave_divcrud({ args: data });
								} else {
									$.Notification.autoHideNotify(
										"error",
										"bottom right",
										"Alerte",
										data.message,
									);
								}
								//table.ajax.reload(null, false); //reload datatable ajax
							},
							error: function(jqXHR, textStatus, errorThrown) {
								alert("Error adding / update data");
							},
						});
					}
				} else {
				}
				e.preventDefault();
				return false;
			});
	};
})(jQuery);

//remplissage du formulaire
function load_form_with_data(data) {
	$.each(data, function(key, value) {
		if ($("#" + key).length == 0 || value == null) {
			//cas_de_radio//
			if (
				$("input[name=" + key + "]").length != 0 &&
				$("input[name=" + key + "]")
					.attr("type")
					.toLowerCase() == "radio"
			) {
				var lvalue = value;
				if (value == true) lvalue = "1";
				else if (value == false) lvalue = "0";
				$("input[name=" + key + "][value=" + lvalue + "]").prop(
					"checked",
					true,
				);
			}
			//cas_de_radio//
		} else if (
			$("#" + key)
				.get(0)
				.tagName.toLowerCase() == "input" &&
			$("#" + key)
				.attr("type")
				.toLowerCase() == "checkbox"
		) {
			if (value == "1" || value == true) $("#" + key).prop("checked", true);
			else $("#" + key).prop("checked", false);
		} else if (
			$("#" + key)
				.get(0)
				.tagName.toLowerCase() == "textarea"
		) {
			//input de type textarea
			$("#" + key).val(value);
		} else if (
			$("#" + key)
				.get(0)
				.tagName.toLowerCase() == "input" &&
			($("#" + key)
				.attr("type")
				.toLowerCase() == "text" ||
				$("#" + key)
					.attr("type")
					.toLowerCase() == "number" ||
				$("#" + key)
					.attr("type")
					.toLowerCase() == "date" ||
				$("#" + key)
					.attr("type")
					.toLowerCase() == "hidden")
		) {
			//input de type text
			$("#" + key).val(value);
		} else if (
			$("#" + key)
				.get(0)
				.tagName.toLowerCase() == "select"
		) {
			$("#" + key).val(value);
		}
	});
}

function validate_form(id_form, validate_rules, validate_messages) {
	$("#" + id_form).validate({
		lang: "fr",
		//errorElement: 'div',
		//errorClass: "state-error",
		//validClass: "state-success",
		//errorElement: "em",
		rules: validate_rules == null ? [] : validate_rules,
		messages: validate_messages == null ? [] : validate_messages,
		/*highlight: function (element, errorClass, validClass) {
						$(element).closest('.field').addClass(errorClass).removeClass(validClass);
				},
				unhighlight: function (element, errorClass, validClass) {
						$(element).closest('.field').removeClass(errorClass).addClass(validClass);
				},*/
		errorPlacement: function(error, element) {
			element.after(error);
			/*if (element.is(":radio") || element.is(":checkbox")) {
								element.closest('.option-group').after(error);
						} else {
								error.insertAfter(element.parent());
						}*/
		},
	});
}

//langue fr du DataTable
function langageFrDataTable() {
	return {
		decimal: ",",
		thousands: ".",
		sProcessing: "Traitement en cours ...",
		sLengthMenu: "Afficher _MENU_ lignes",
		sZeroRecords: "Aucun résultat trouvé",
		sEmptyTable: "Aucune donnée disponible",
		sInfo: "Lignes _START_ à _END_ sur _TOTAL_",
		sInfoEmpty: "Aucune ligne affichée",
		sInfoFiltered: "(Filtrer un maximum de _MAX_)",
		sInfoPostFix: "",
		sSearch: "Chercher:",
		sUrl: "",
		sInfoThousands: ",",
		sLoadingRecords: "Chargement...",
		oPaginate: {
			sFirst: "Premier",
			sLast: "Dernier",
			sNext: "Suivant",
			sPrevious: "Précédent",
		},
		oAria: {
			sSortAscending: ": Trier par ordre croissant",
			sSortDescending: ": Trier par ordre décroissant",
		},
	};
}
