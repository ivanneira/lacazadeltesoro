
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
            <form name="frmUsers" id="frmUsers" class="form-horizontal">
            <!-- Modal body -->
            <div class="modal-body">

                    <input type="hidden" name="id" id="id">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Nombre (*)</label>
                                <input type="text" class="form-control" name="name" id="name" tabindex="1">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellido (*)</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" tabindex="2">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label >Documento (*)</label>
                                <input type="text" class="form-control" name="documento" id="documento" tabindex="3">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Cuit </label>
                                <input type="text" class="form-control" name="cuit" id="cuit" tabindex="4">
                            </div>

                        </div>

                        {{--
                        <div class="col-md-6">
                            <div class="form-group" style="display:none">
                                <label>Email</label>
                                <input type="text" class="form-control" name= "email" id="email" tabindex="5">
                            </div>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Matrícula (*)</label>
                                <input type="text" class="form-control" name= "matricula" id="matricula" tabindex="6">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Condición (*)</label>
                                <select class="form-control"  id="condicion" name="condicion" tabindex="7">
                                        <option value="Ninguno">Ninguno</option>
                                        <option value="Responsable Inscripto">Responsable Inscripto</option>
                                        <option value="Monotributista">Monotributista</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12">
                        <label>Fondo Común</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Porcentaje de descuento </label>
                                <input type="text" class="form-control" name= "fondo" id="fondo" tabindex="2">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Aplicar a partición</label>
                                <select class="form-control" type="text"  id="particion" name="particion" tabindex="7">
                                        <option value="0">Niguna</option>
                                        <option value="1">40%</option>
                                        <option value="2">60%</option>
                                        <option value="3">Todas</option>
                                </select>
                            </div>
                        </div>



                        {{-- <div class="col-md-6">
                            <div class="form-group" style="display:none">
                                <label >Password</label>
                                <input type="text" class="form-control" name= "password" id="password" tabindex="8">
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-6">
                            <div class="form-group" style="display:none">
                                <label >Rol</label>
                                <select class="select2 select2-container form-control"  id="rol" name="rol[]" multiple="multiple" tabindex="9" >

                                </select>
                            </div>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="active" id="active" checked tabindex="10">
                                    <label class="custom-control-label" for="active">Inactivo / Activo</label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-12 col-xs-1 text-center">
                        <button type="submit" class="btn btn-round btn-info" id="btn-save" value="create" tabindex="11">Guardar</button>
                        <button type="button" class="btn btn-danger modal_cancel" data-dismiss="modal" tabindex="12">Cerrar</button>
                    </div>

                    <!-- -->

                    <!-- -->

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
    <div class="content">
        <div class="col-md-12 col-lg-12">
            <!-- Default Elements -->
            <div class="block ">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Usuarios</h3>
                    <div class="block-options">
                        <button type="button" id="gridCreate" class="btn btn-secondary">
                            <i class="si si-plus"></i> Agregar
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <table id="dt" class="table table-bordered table-striped table-vcenter js-dataTable-full" style="width: 100%" >
                        <thead>
                            <tr>
                                <th class="d-none d-sm-table-cell">#ID</th>
                                <th class="text-center" >Nombre</th>
                                <th class="text-center" >Apellido</th>
                                <th class="text-center" >Matrícula</th>
                                <th class="text-center" >Fondo Desc. s/total</th>
                                <th class="text-center" >Partición</th>
                                {{-- <th class="d-none d-sm-table-cell" style="width:20%">Email</th> --}}
                                <th class="text-center" style="width:10%">Estado</th>
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

    $('#crud_modal').on('shown.bs.modal', function () {
        $('#name').focus();
    })

    $('#rol').select2({
        //minimumInputLength: 1,
        multiple: true,
        placeholder: "Seleccione un Rol",
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
            url: "roles",
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
                            text: item.name,
                            id: item.name
                        }
                    })
                };
            },
            cache: true
        }
    });

    /*$('.select2').select2({
        dropdownParent: $('#crud_modal'),
        multiple: true,

    });*/

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


        $('#btn-save').show();
        $('#btn-save').val("create");
        $('#frmUsers').trigger("reset");
        $(".modal-title").html("Agregar");
        $("#id").val('');
        $("#btn-save").html("Guardar");
        $('#crud_modal').modal('show');
    });

    $('body').on('click', '#gridEdit', function() {

        $('#btn-save').show();
        var id = $(this).data('id');
			$.get('/users/edit/'+ id, function(data) {
				console.log(data);
                $(".modal-title").html("Editar");
				$('#btn-save').val("edit-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
				$('#name').val(data.name);
                $('#lastname').val(data.lastname);
                $('#matricula').val(data.matricula);
                $('#documento').val(data.documento);

                $('#cuit').val(data.cuit);


                $('#email').val(data.email);
                $('#password').val(data.password);
                //profile.lastname
                if(data.active == 1){
                    $('#active').prop('checked',true);
                }
                else {
                    $('#active').prop('checked',false);
                }

                $('#active').prop('disabled',false);

                $('#fondo').val(data.fondo);

                particion = data.particion;

                $('#particion').find('option').each(function(i,e){
                        console.log($(e).val());
                        if($(e).val() == particion){
                            //alert(rol);
                            $('#particion').prop('selectedIndex',i);
                        }
                });

                condicion = data.condicion;
                    //console.log(rol);
                    $('#condicion').find('option').each(function(i,e){
                        console.log($(e).val());
                        if($(e).val() == condicion){
                            //alert(rol);
                            $('#condicion').prop('selectedIndex',i);
                        }
                    });

                var selectedValuesTest = data.rol;
                console.log(data.rol)
                $('#rol').val(selectedValuesTest).trigger('change');
 			})
    })

    $('body').on('click', '#gridDetail', function() {
        $('#btn-save').hide();
        var id = $(this).data('id');
			$.get('users/'+ id, function(data) {
				//console.log(data);
                $(".modal-title").html("Detalles");
				$('#btn-save').val("view-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
				$('#name').val(data.name);
                $('#lastname').val(data.lastname);
                $('#matricula').val(data.matricula);
                $('#documento').val(data.documento);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#cuit').val(data.cuit);
                //$('#password').val(data.password);

                $('#fondo').val(data.fondo);

                particion = data.particion;

                $('#particion').find('option').each(function(i,e){
                        console.log($(e).val());
                        if($(e).val() == particion){
                            //alert(rol);
                            $('#particion').prop('selectedIndex',i);
                        }
                });

                if(data.active == 1){
                    $('#active').prop('checked',true);
                }
                else {
                    $('#active').prop('checked',false);
                }

                $('#active').prop('disabled',true);

                condicion = data.condicion;
                    //console.log(rol);
                    $('#condicion').find('option').each(function(i,e){
                        console.log($(e).val());
                        if($(e).val() == condicion){
                            //alert(rol);
                            $('#condicion').prop('selectedIndex',i);
                        }
                    });

                var selectedValuesTest = data.rol;
                $('#rol').val(selectedValuesTest).trigger('change');

 			})
    })

    $('body').on('click', '#gridActive', function() {

        Swal.fire({
            title: 'Modificar registro ?',
            text: "El registro activará o inactivará para el sistema.-",
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
                    url: "users/" + id,
                    global: true,
                    success: function(data) {
                        var oTable = $('#dt').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(data) {
                        //console.log('Error:', data);
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

    if ($("#frmUsers").length > 0) {
		$("#frmUsers").validate({
			rules: {
                //"multipleselect[]": { required:true },
            name: {required: true},
            lastname: {required: true},
            documento: {required: true},
            matricula: {required: true},
            fondo: {required: true},
            particion: {required: true},
            //"rol[]": { required : true },
        	},
			messages: {
				name: "Ingresa un nombre",
                lastname: "Ingresa un apellido",
                documento: "Ingresa un documento",
                matricula: "Ingresa un matrícula",
                fondo: "Ingresa un valor numérico",
                particion: "Seleccione a que partición a aplicar",
                //"rol[]": "Seleccione un rol."
			},

			submitHandler: function(form) {
				var actionType = $('#btn-save').val();
                $('#btn-save').html('Guardando..');
                $.ajax({
					data: $('#frmUsers').serialize(),
					url: "/users/store",
                    type: "POST",
                    global: true,
					dataType: 'json',
					success: function(data) {
						$('#frmUsers').trigger("reset");
						$('#crud_modal').modal('hide');
						$('#btn-save').html('Guardar');
						var oTable = $('#dt').dataTable();
                        oTable.fnDraw(false);
					},
					error: function(data) {
						//console.log('Error:', data);
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

        processing: false,
        serverSide: true,
        responsive: true,
        searching: false,
          lengthMenu: [
            [10, 25, 100, 250],
            [10, 25, 100, 250]
        ],
        pageLength: 10,
          language: {

            url: '{{ asset('spanish.json') }}',
          },
          ajax: {
              url: "users/list",
              data: function(d)
              {
                d.search = $('#search').val()
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
              {data: 'id', name: 'id',orderable: true, searchable: false, className: 'd-none d-sm-table-cell'},
              {data: 'name', name: 'name',orderable: true, searchable: false},
              {data: 'lastname', name: 'name',orderable: true, searchable: false},
              {data: 'matricula', name: 'matricula',orderable: true, searchable: false},
              {data: 'fondo', name: 'fondo',orderable: true, searchable: false},
              {data: 'particion', name: 'particion',orderable: true, searchable: false,
              "render": function(data, type, row) {
                        //console.dir(row);
                        switch(data)
                        {
                            case 0:
                            {
                                return '<span class="badge badge-danger">Ninguno</span>'
                            }break;

                            case 1:
                            {
                                return '<span class="badge badge-success">40%</span>'
                            }break;

                            case 2:
                            {
                                return '<span class="badge badge-success">60%</span>'
                            }break;

                            case 3:
                            {
                                return '<span class="badge badge-success">Todas</span>'
                            }break;
                        }
					}
              },
            //   {data: 'email', name: 'description',orderable: true, searchable: false,className: 'd-none d-sm-table-cell'},
              {
                  data: 'active', name: 'active',
                  'className': 'text-center',orderable: true, searchable: false,
					"render": function(data, type, row) {
                        //console.dir(row);
						return data == true ? '<span class="badge badge-success">Activo</span>' :
							'<span class="badge badge-danger badge">Inactivo</span>';
					}

              },
              {data: 'action', name: 'action', orderable: false, searchable: false,className: 'text-center'},
          ]
      });

    });


  </script>


  @endsection
