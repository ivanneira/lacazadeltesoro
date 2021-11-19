
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
            <form name="frmDieta" id="frmDieta" class="form-horizontal">
            <!-- Modal body -->
            <div class="modal-body">

                    <input type="hidden" name="id" id="id">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nombre (*)</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" tabindex="1">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Detalle (*)</label>
                                {{-- <input type="text" class="form-control" name="apellido" id="apellido" tabindex="2"> --}}
                                <textarea class="form-control" name="detalle" id="detalle"></textarea>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="active" id="active" checked tabindex="7">
                                    <label class="custom-control-label" for="active">Inactivo / Activo</label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-12 col-xs-1 text-center">
                        <button type="submit" class="btn btn-round btn-success" id="btn-save" value="create" tabindex="8">Guardar</button>
                        <button type="button" class="btn btn-danger modal_cancel" data-dismiss="modal" tabindex="9">Cerrar</button>
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
    <div class="container-fluid px-0">
        <div class="col-md-12 col-lg-12">
            <!-- Default Elements -->
            <div class="block ">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Dietas</h3>
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
                                <th class="text-center" >Nombre</th>
                                <th class="text-center" >Detalle</th>
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

    var editor= "";

    function stripHtml(html)
    {
    let tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
    }

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


        if(editor != "")
        {
            editor.destroy();
        }

        $('#btn-save').show();
        $('#btn-save').val("create");
        $('#frmDieta').trigger("reset");
        $(".modal-title").html("Agregar");
        $("#id").val('');
        $("#btn-save").html("Guardar");
        $('#crud_modal').modal('show');
        $('#detalle').empty();

        editor =  CKEDITOR.replace('detalle', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            cloudServices_tokenUrl: "{{route('ckeditor.token', ['_token' => csrf_token() ])}}",
            cloudServices_uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
        });


    });

    $('body').on('click', '#gridEdit', function() {

        $('#btn-save').show();
        var id = $(this).data('id');

            if(editor != "")
            {
                editor.destroy();
            }

			$.get('/dietas/edit/'+ id, function(data) {

                $(".modal-title").html("Editar");
				$('#btn-save').val("edit-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
                $('#nombre').val(data.nombre);
                $('#detalle').val(data.detalle);



                editor =  CKEDITOR.replace('detalle', {
                    filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form',
                    cloudServices_tokenUrl: "{{route('ckeditor.token', ['_token' => csrf_token() ])}}",
                    cloudServices_uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
                });

                if(data.active == 1){
                    $('#active').prop('checked',true);
                }
                else {
                    $('#active').prop('checked',false);
                }

                $('#active').prop('disabled',false);

 			})
    })

    $('body').on('click', '#gridDetail', function() {
        $('#btn-save').hide();
        var id = $(this).data('id');

            if(editor != "")
            {
                editor.destroy();
            }

			$.get('dietas/'+ id, function(data) {

                $(".modal-title").html("Detalles");
				$('#btn-save').val("view-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
                $('#nombre').val(data.nombre);
                $('#detalle').val(data.detalle);

                editor =  CKEDITOR.replace('detalle', {
                    filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form',
                    cloudServices_tokenUrl: "{{route('ckeditor.token', ['_token' => csrf_token() ])}}",
                    cloudServices_uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
                });

                if(data.active == 1){
                    $('#active').prop('checked',true);
                }
                else {
                    $('#active').prop('checked',false);
                }

                $('#active').prop('disabled',true);


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
                    url: "dietas/" + id,
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

    if ($("#frmDieta").length > 0) {
		$("#frmDieta").validate({
			rules: {
                //"multipleselect[]": { required:true },
            nombre: {required: true},
            detalle: {required: true},

        	},
			messages: {
				nombre: "Ingresa un nombre.",
                detalle: "Ingresa un detalle.",
			},

			submitHandler: function(form) {
                var messageLength = editor.getData().replace(/<[^>]*>/gi, '').length;
                $("#detalle").val(editor.getData());
				var actionType = $('#btn-save').val();
                $('#btn-save').html('Guardando..');
                $.ajax({
					data: $('#frmDieta').serialize(),
					url: "/dietas/store",
                    type: "POST",
                    global: true,
					dataType: 'json',
					success: function(data) {
                        editor.destroy();
						$('#frmDieta').trigger("reset");
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
              url: "dietas/list",
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
              {data: 'nombre', name: 'nombre',orderable: true, searchable: false},
              {data: 'detalle', name: 'detalle',orderable: true, searchable: false,

                "render": function(data, type, row) {
                return stripHtml(data);
                }
              },
              {
                  data: 'active', name: 'active',
                  'className': 'text-center',orderable: true, searchable: false,
					"render": function(data, type, row) {

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
