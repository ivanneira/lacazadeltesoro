
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
            <form name="frmAlumno" id="frmAlumno" class="form-horizontal">
            <!-- Modal body -->
            <div class="modal-body">

                    <input type="hidden" name="id" id="id">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Nombre (*)</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" tabindex="1">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellido (*)</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" tabindex="2">
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
                                <label >Contacto (*)</label>
                                <input type="text" class="form-control" name="contacto" id="contacto" tabindex="4">
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label >Email (*)</label>
                                <input type="text" class="form-control" name="email" id="email" tabindex="5">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Foto</label>
                                <input id="foto" name="foto" class="form-control" type="file" accept="image/*" tabindex="6" >

                                </div>
                        </div>

                        <div class="col-md-12">
                            {{-- <img class="img-thumbnail" style="min-height: auto; min-width:100%"  name="imagen" id="imagen"/> --}}
                            <canvas name="imagen" id="imagen"  class="img-thumbnail" style="min-height: auto; min-width:100%"  ></canvas>
                            <input type="hidden" name="file_output" id="file_output">

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
                    <h3 class="block-title">Alumnos</h3>
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





    var canvas=document.getElementById("imagen");
    var ctx=canvas.getContext("2d");
    var cw=canvas.width;
    var ch=canvas.height;
    var maxW=640;
    var maxH=480;

    var input = document.getElementById('foto');
    var output = document.getElementById('file_output');
    input.addEventListener('change', handleFiles);

    function handleFiles(e) {
    var img = new Image;
    img.onload = function() {
        var iw=img.width;
        var ih=img.height;
        var scale=Math.min((maxW/iw),(maxH/ih));
        var iwScaled=iw*scale;
        var ihScaled=ih*scale;
        canvas.width=iwScaled;
        canvas.height=ihScaled;
        ctx.drawImage(img,0,0,iwScaled,ihScaled);
    output.value = canvas.toDataURL("image/jpeg",0.5);
    }
    img.src = URL.createObjectURL(e.target.files[0]);
    }

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


function make_base(img, context)
{
  base_image = new Image();
  base_image.src = img;
  base_image.onload = function(){
    context.drawImage(base_image, 0, 0);
  }
}

function scaleToFit(img, canvas){
    // get the scale
    var scale = Math.min(canvas.width / img.width, canvas.height / img.height);
    // get the top left position of the image
    var x = (canvas.width / 2) - (img.width / 2) * scale;
    var y = (canvas.height / 2) - (img.height / 2) * scale;
    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);
}


function scaleToFill(img){

    var canvas = document.getElementById('imagen'),
    ctx = canvas.getContext('2d');
    // get the scale
    var scale = Math.max(canvas.width / img.width, canvas.height / img.height);
    // get the top left position of the image
    var x = (canvas.width / 2) - (img.width / 2) * scale;
    var y = (canvas.height / 2) - (img.height / 2) * scale;
    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);
}

    $('#gridCreate').click(function() {


        $('#btn-save').show();
        $('#btn-save').val("create");
        $('#frmAlumno').trigger("reset");
        $(".modal-title").html("Agregar");
        $("#id").val('');
        $("#btn-save").html("Guardar");
        $('#crud_modal').modal('show');
        var image = new Image();
        image.src = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/wAALCACAAIABAREA/8QAGgABAQEBAQEBAAAAAAAAAAAAAAYFBAMCCf/EADgQAAIBAgEIBwMNAAAAAAAAAAABAgMEBQYREhQhIjFBUVRhcYGSsUKC8RMyMzVEUpGhwcLR4fD/2gAIAQEAAD8A/TgAAAAAAAAAAAAAAAAAAAAAAAAAAGTiuPwsZOlSSq1lxz8I95gVcZva8tteceyG76CljN7Qlsrzl2T3vU38Kx+F9JUqqVKs+GbhLuNYAAAAA4cYvnYWM5x+klux72TOE4bLFLlqTapx2zlz+JXW1pRtIaNGnGC7FtfiLm0o3cNGtTjNdq2rxJHFsNlhdylFt05bYS5/EpsHvnf2MJy+kjuy70dwAAAAJ/K2TULWPJuT9P5OjJemo4fKXOU3nfgjYBj5UU1LD4y5xmsz8Gc+SUm4XUeScX6/wUAAAAAJ7K37J7/7TryZ+rPff6GsDJym+rPfX6nJkl9r9z9xQgAAAAw8qqLnbUaqWyEmn4/A+clbqLpVbdveT00ulc/92m8DByquoqlSt095vTa6Fy/3YfWStFwtq1VrZOSS8PibgAAAAOW/nbSt50rirCEZLNvSSZG6crK60qNVNwe7UjzNy2yrjoJXFGWl96nz8GLnKuOg1b0ZaX3qnLwRh6cr260q1VJze9UlyLKwnbRt4UrerCcYrNuyTZ1AAAA48RxWjhsM83pVH82C4smrzHru7bSn8lB+zT2fmedDB7263o0ZJP2p7PU7aeStxJb9WnDuzs91kl03X4U/7DyS6Lr8af8AZ4VMlbiK3KtOffnRxV8HvbXelRk0vaht9D0s8eu7RpOfy0F7NTb+ZS4dilHEoNw3Zr50HxR2AAAhpSqYriG179WeZZ+SKywwi3sIpxip1OdSS2+HQdoAAOG/wi3v4vSioVOVSK2+PSSsJVMKxDY9+lPM83BouAAAQ2GzVHEaDm9FRms7fIueIAAA4ENiU1WxGu4PSUpvM1zLkAAE3jOAVXXlXto6cZvPKC4p9hlaherZq9fySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGo3vV7jySGoXr2avX8kjVwbAKqrxr3MdCMHnjB8W+0pAAAAAAAAAAAAAAAAAAAAAAAAAD/2Q==';
        image.onload = function(){
            scaleToFill(this);
        }

    });

    $('body').on('click', '#gridEdit', function() {

        $('#btn-save').show();
        var id = $(this).data('id');
			$.get('/alumnos/edit/'+ id, function(data) {

                $(".modal-title").html("Editar");
				$('#btn-save').val("edit-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
                $('#nombre').val(data.nombre);
                $('#apellido').val(data.apellido);
                $('#documento').val(data.documento);
                $('#email').val(data.email);
                $('#contacto').val(data.contacto);




                var image = new Image();
                image.src = data.foto;
                image.onload = function(){
                    scaleToFill(this);
                }
                //make_base(data.foto, context);
                //scaleToFit(data.foto, canvas)

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
			$.get('alumnos/'+ id, function(data) {

                $(".modal-title").html("Detalles");
				$('#btn-save').val("view-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
				$('#nombre').val(data.nombre);
                $('#apellido').val(data.apellido);
                $('#documento').val(data.documento);
                $('#email').val(data.email);
                $('#contacto').val(data.contacto);
                var image = new Image();
                image.src = data.foto;
                image.onload = function(){
                    scaleToFill(this);
                }


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
                    url: "alumnos/" + id,
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

    if ($("#frmAlumno").length > 0) {
		$("#frmAlumno").validate({
			rules: {
                //"multipleselect[]": { required:true },
            nombre: {required: true},
            apellido: {required: true},
            documento: {required: true},
            contacto: {required: true},
            email: {required: true, email: true},
        	},
			messages: {
				nombre: "Ingresa un nombre.",
                apellido: "Ingresa un apellido.",
                documento: "Ingresa un documento.",
                contacto: "Ingresa un nro de contacto.",
                email: "Ingresa una dirección de correo.",
			},

			submitHandler: function(form) {
				var actionType = $('#btn-save').val();
                $('#btn-save').html('Guardando..');
                $.ajax({
					data: $('#frmAlumno').serialize(),
					url: "/alumnos/store",
                    type: "POST",
                    global: true,
					dataType: 'json',
					success: function(data) {
						$('#frmAlumno').trigger("reset");
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
              url: "alumnos/list",
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
              {data: 'foto', name: 'foto',orderable: true, searchable: false,className: 'text-center',
               "render" : function(data, type, row) {
                return data != "" ? '<img class="img-thumbnail" style="max-width:100%; max-height:100px" src="'+data+'"></span>' : "Sin Foto";
               }
              },

              {data: 'nombre', name: 'nombre',orderable: true, searchable: false, className: 'vcenter'},
              {data: 'apellido', name: 'apellido',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'documento', name: 'documento',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'contacto', name: 'contacto',orderable: true, searchable: false,className: 'vcenter'},
              {data: 'email', name: 'email',orderable: true, searchable: false,className: 'vcenter'},

              //{data: 'email', name: 'description',orderable: true, searchable: false,className: 'd-none d-sm-table-cell'},
              {
                  data: 'active', name: 'active',
                  'className': 'text-center vcenter',orderable: true, searchable: false,
					"render": function(data, type, row) {

						return data == true ? '<span class="badge badge-success">Activo</span>' :
							'<span class="badge badge-danger badge">Inactivo</span>';
					}

              },
              {data: 'action', name: 'action', orderable: false, searchable: false,className: 'text-center vcenter'},
          ]
      });

    });


  </script>


  @endsection
