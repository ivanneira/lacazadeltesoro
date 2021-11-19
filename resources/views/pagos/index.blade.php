
@extends('layouts.backend')

@section('content')
    <!-- The Modal -->
    <div class="modal" id="crud_modal" data-backdrop="static" >
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form name="frmPagos" id="frmPagos" class="form-horizontal">
            <!-- Modal body -->
            <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ddAlumno">Alumno (*)</label>
                                <select class="select2 select2-container form-control" name="ddAlumno" id="ddAlumno" tabindex="2"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Monto (*)</label>
                                <input type="text" class="form-control" name="monto" id="monto" tabindex="2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desde" >Desde (*)</label>
                                <input data-date-format="dd/mm/yyyy" id="desde" name="desde" class="js-datepicker form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hasta" >Hasta (*)</label>
                                <input type="text" class="js-datepicker form-control" name="hasta" id="hasta" tabindex="4">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-1 text-center">
                        <button type="submit" class="btn btn-round btn-success" id="btn-save" value="create" tabindex="8">Guardar</button>
                        <button type="button" class="btn btn-danger modal_cancel" data-dismiss="modal" tabindex="9">Cerrar</button>
                    </div>
            </div>
            </form>
            <!-- Modal footer -->
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-success modal_ok"></button> --}}
            </div>

        </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid px-0">
        <div class="col-md-12 col-lg-12">
            <!-- Default Elements -->
            <div class="block ">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Pagos</h3>


                    <div class="block-options">
                        <button type="button" id="gridCreate" class="btn btn-success">
                            <i class="si si-plus"></i> Agregar

                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <table id="dt" class="table table-bordered table-hover nowrap" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="d-none d-sm-table-cell">#ID</th>
                                <th class="text-center" >Foto</th>
                                <th class="text-center" >Nombre</th>
                                <th class="text-center" >Apellido</th>
                                <th class="text-center" >Documento</th>
                                <th class="text-center" >Contacto</th>
                                <th class="text-center" >Email</th>

                                <th class="text-center" >Monto</th>
                                <th class="text-center" >Desde</th>
                                <th class="text-center" >Hasta</th>

                                <th class="text-center" style="width:30%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
@endsection

@section('js_after')



<script type="text/javascript">

    $('.select2').select2({
        dropdownParent: $('#crud_modal')
    });

    $(".js-datepicker").flatpickr({
        dateFormat: "d/m/Y",
        "locale": "es"  // locale for this instance only
    });

    $('#ddAlumno').select2({
        //minimumInputLength: 1,
        placeholder: "Seleccione un alumno",
        language: {
            searching: function() {
                return "Buscando...";
            },
            noResults: function() {
                return "No hay resultado";
            },
            inputTooShort: function () {
                return 'Ingrese 1 caracteres min.';
            }
        },
        ajax: {
            url: "/alumnos/dd/list",
            type: "get",
            dataType: 'json',
            global:false,
            delay: 10,
            data: function (params) {
                return {
                    search: params.term, // search term
                    //table: 'states',
                };
            },
            processResults: function (response) {
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            text: item.nombre + ', ' + item.apellido + ' - ' + item.documento,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#crud_modal').on('shown.bs.modal', function () {
        $('#name').focus();

    })

    $("#search").keyup(function() {
        var oTable = $('#dt').dataTable();
        oTable.fnDraw(false);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#gridCreate').click(function() {

        $("#ddAlumno").empty();
        $('#ddAlumno').prop('disabled',false);
        $('#monto').prop('disabled',false);
        $('#desde').prop('disabled',false);
        $('#hasta').prop('disabled',false);
        $('#btn-save').show();
        $('#btn-save').val("create");
        $('#frmPagos').trigger("reset");
        $(".modal-title").html("Agregar");
        $("#id").val('');
        $("#btn-save").html("Guardar");
        $('#crud_modal').modal('show');

    });

    $('body').on('click', '#gridEdit', function() {
        $("#ddAlumno").empty();
        $('#ddAlumno').prop('disabled',false);
        $('#monto').prop('disabled',false);
        $('#desde').prop('disabled',false);
        $('#hasta').prop('disabled',false);
        $('#btn-save').show();
        var id = $(this).data('id');
			$.get('/pagos/edit/'+ id, function(data) {

                $(".modal-title").html("Editar");
				$('#btn-save').val("edit-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
                $('#nombre').val(data.nombre);
                $('#monto').val(data.monto);
                $('#desde').val(moment(data.desde).format('DD/MM/YYYY'));
                $('#hasta').val(moment(data.hasta).format('DD/MM/YYYY'));


                var alumno_id = data.alumno_id;


                $.get('/alumnos/dd/item/'+ alumno_id, function(data) {
                if ($("#ddAlumno").find("option[value=" + data.data[0].id + "]").length) {
                    $("#ddAlumno").val(data.data[0].nombre + ', ' + data.data[0].apellido + ' - ' + data.data[0].documento ).trigger("change");
                    } else {
                    // Create the DOM option that is pre-selected by default
                    var item = new Option(data.data[0].nombre + ', ' + data.data[0].apellido + ' - ' + data.data[0].documento, data.data[0].id, true, true);
                    // Append it to the select
                    $("#ddAlumno").append(item).trigger('change');
                    }
                })

 			})
    })

    $('body').on('click', '#gridDetail', function() {
        $("#ddAlumno").empty();
        $('#ddAlumno').prop('disabled',true);
        $('#monto').prop('disabled',true);
        $('#desde').prop('disabled',true);
        $('#hasta').prop('disabled',true);
        $('#btn-save').hide();
        var id = $(this).data('id');
			$.get('pagos/'+ id, function(data) {

                $(".modal-title").html("Detalles");
				$('#btn-save').val("view-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
                $('#nombre').val(data.nombre);
                $('#monto').val(data.monto);
                $('#desde').val(moment(data.desde).format('DD/MM/YYYY'));
                $('#hasta').val(moment(data.hasta).format('DD/MM/YYYY'));


                var alumno_id = data.alumno_id;


                $.get('/alumnos/dd/item/'+ alumno_id, function(data) {
                if ($("#ddAlumno").find("option[value=" + data.data[0].id + "]").length) {
                    $("#ddAlumno").val(data.data[0].nombre + ', ' + data.data[0].apellido + ' - ' + data.data[0].documento ).trigger("change");
                    } else {
                    // Create the DOM option that is pre-selected by default
                    var item = new Option(data.data[0].nombre + ', ' + data.data[0].apellido + ' - ' + data.data[0].documento, data.data[0].id, true, true);
                    // Append it to the select
                    $("#ddAlumno").append(item).trigger('change');
                    }
                })

 			})
    })

    $('body').on('click', '#gridActive', function() {

        Swal.fire({
            title: 'Eliminar registro ?',
            text: "El registro será eliminado sistema.-",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar',
            cancelButtonText: 'Cancelar',
          }).then((result) => {
            if (result.value) {

                var id = $(this).data("id");
                $.ajax({
                    type: "delete",
                    url: "pagos/" + id,
                    global: true,
                    success: function(data) {
                        var oTable = $('#dt').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(data) {

                        var j = JSON.parse(data.responseText)
                                        if(j.message == 'CSRF token mismatch.'){
                                            swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Su sesión expriró, reingrese a la plataforma o presiona la tecla F5.',
                                            })
                                        }
                    }
                });
            }
          });
    });

    if ($("#frmPagos").length > 0) {
		$("#frmPagos").validate({
			rules: {
                //"multipleselect[]": { required:true },

            monto: {required: true},
            desde: {required: true},
            hasta: {required: true},
            ddAlumno : {required: true},
        	},
			messages: {
                monto: "Ingresa un monto.",
                desde: "Fecha desde.",
                hasta: "Fecha hasta.",
                ddAlumno : "Seleccione un alumno."
			},

			submitHandler: function(form) {
				var actionType = $('#btn-save').val();
                $('#btn-save').html('Guardando..');
                $.ajax({
					data: $('#frmPagos').serialize(),
					url: "/pagos/store",
                    type: "POST",
                    global: true,
					dataType: 'json',
					success: function(data) {
						$('#frmPagos').trigger("reset");
						$('#crud_modal').modal('hide');
						$('#btn-save').html('Guardar');
						var oTable = $('#dt').dataTable();
                        oTable.fnDraw(false);
					},
					error: function(data) {

                        $('#btn-save').html('Error al actualizar');
                        var j = JSON.parse(data.responseText)
                                if(j.message == 'CSRF token mismatch.'){
                                    swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Su sesión expriró, reingrese a la plataforma o presiona la tecla F5.',
                                    })
                                }
					}
				});
            }
        })
    }

    $(document).ready(function() {

    var columns = []; // array
    var response = null;

      var table = $('#dt').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        searching: true,
          lengthMenu: [
            [10, 25, 100, 250],
            [10, 25, 100, 250]
        ],
        pageLength: 10,
          language: {

            url: '{{ asset('spanish.json') }}',
          },
          ajax: {
              url: "pagos/list",
              data: function(d)
              {
                 d.search = $('input[type="search"]').val()
                // d.search = $('#search').val()
                //console.log("a buscar: "+d)
              },
              type: "GET",
              error: function (xhr, error, code)
              {
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: (code == 'Unauthorized') ? "Su sesion expriró, reingrese a la plataforma o presione la tecla F5" : "Reintente nuevamente." ,
                  })
              },
          },

          columns: [
              {data: 'id', name: 'id',orderable: true, searchable: false, className: 'd-none d-sm-table-cell',className: 'text-center vcenter'},
              {data: 'alumnos.foto', name: 'foto',orderable: true, searchable: false,className: 'text-center',
               "render" : function(data, type, row) {
                return data != "" ? '<img class="img-thumbnail" style="max-width:100%; max-height:100px" src="'+data+'"></span>' : "Sin Foto";
               }
              },

              {data: 'alumnos.nombre', name: 'nombre',orderable: true, searchable: false, className: 'vcenter'},
              {data: 'alumnos.apellido', name: 'apellido',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'alumnos.documento', name: 'documento',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'alumnos.contacto', name: 'contacto',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'alumnos.email', name: 'email',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'monto', name: 'monto',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'desde', name: 'desde',orderable: true, searchable: false,className: 'vcenter',
                "render" : function(data, type, row)
                {
                    return moment(data).format('DD/MM/YYYY')
                }
              },
              {data: 'hasta', name: 'hasta',orderable: true, searchable: false,className: 'vcenter',
                  "render" : function(data, type, row)
                {
                    return moment(data).format('DD/MM/YYYY')
                }
              },
              {data: 'action', name: 'action', orderable: false, searchable: false,className: 'text-center vcenter'},
          ]
      });

    });


  </script>


  @endsection
