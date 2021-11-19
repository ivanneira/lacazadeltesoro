
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
            <form name="frmCalendario" id="frmCalendario" class="form-horizontal">
            <!-- Modal body -->
            <div class="modal-body">

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="date" id="date">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ddAlumno">Alumno (*)</label>
                                <select class="select2 select2-container form-control" name="ddAlumno" id="ddAlumno" tabindex="2"></select>
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
                                <input data-date-format="dd/mm/yyyy"   name="hasta" id="hasta"  class="js-datepicker form-control">
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
                    <h3 class="block-title">
                        Calendario
                        <br><div class="container text-center"> <i class="fa fa-circle text-danger"></i> Impago | <i class="fa fa-circle text-success"></i> Pago</div>
                    </h3>
                    <div class="block-options">

                    </div>
                </div>

                <div class="block">
                    <div class="block-content">
                        <div class="row items-push">
                            <div class="col-12">
                                <!-- Calendar Container -->
                                <div id="calendar" class="js-calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>

@endsection

@section('js_after')


<script type="text/javascript">


    $(".js-datepicker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
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
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#gridCreate').click(function() {


        $('#btn-save').show();
        $('#btn-save').val("create");
        $('#frmCalendario').trigger("reset");
        $(".modal-title").html("Agregar");
        $("#id").val('');
        $("#btn-save").html("Guardar");
        $('#crud_modal').modal('show');
        $('#detalle').empty();



    });


    $('body').on('click', '#gridEdit', function() {

        $('#btn-save').show();
        var id = $(this).data('id');



			$.get('/calendario/edit/'+ id, function(data) {

                $(".modal-title").html("Editar");
				$('#btn-save').val("edit-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
                $('#nombre').val(data.nombre);
 			})
    })

    $('body').on('click', '#gridDetail', function() {
        $('#btn-save').hide();
        var id = $(this).data('id');



			$.get('calendario/'+ id, function(data) {

                $(".modal-title").html("Detalles");
				$('#btn-save').val("view-media");
				$('#crud_modal').modal('show');
				$('#id').val(data.id);
                $('#nombre').val(data.nombre);
                $('#detalle').val(data.detalle);





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
                    url: "calendario/" + id,
                    global: true,
                    success: function(data) {

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

    if ($("#frmCalendario").length > 0) {
		$("#frmCalendario").validate({
			rules: {
                //"multipleselect[]": { required:true },
            ddAlumno: {required: true},
            desde: {required: true},
            hasta: {required: true},

        	},
			messages: {
				ddAlumno: "Ingresa un alumno.",
                desde: "Ingresa hora desde.",
                hasta: "Ingrese hora hasta."
			},

			submitHandler: function(form) {

				var actionType = $('#btn-save').val();
                $('#btn-save').html('Guardando..');
                $.ajax({
					data: $('#frmCalendario').serialize(),
					url: "calendario/store",
                    type: "POST",
                    global: true,
					dataType: 'json',
					success: function(data) {

						$('#frmCalendario').trigger("reset");
						$('#crud_modal').modal('hide');
						$('#btn-save').html('Guardar');
                        $('#calendar').fullCalendar('refetchEvents');

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


    $('#calendar').fullCalendar({
      weekends: true,
      locale: 'es',
    //   defaultView: 'agendaWeek',

    //   selectable: true,
      timeZone: 'local', // the default (unnecessary to specify)



        events: {
            url: 'calendario/eventos',
            type: 'POST',
            error: function() {
            alert('Hubo un problema, refresque la página!');
            },

            success : function(){
            // color: 'yellow',   // a non-ajax option
            // textColor: 'black' // a non-ajax option
            }
        },


        // editable: true,
        // droppable: true, // this allows things to be dropped onto the calendar

        buttonText : {
            today:    'HOY',
            month:    'MES',
            week:     'SEMANA',
            day:      'DIA',
            list:     'LISTADO'
        },


      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
        },



        dayClick: function(date, jsEvent, view) {
            //alert('Clicked on: ' + date.format());
            //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            //alert('Current view: ' + view.name);
            // change the day's background color just for fun
            //$(this).css('background-color', 'red');

            $(".modal-title").html("Asignar " + moment(date.format()).format('DD/MM/YYYY'));
            $('#btn-save').show();
            $('#date').val(moment(date.format()).format('DD/MM/YYYY'));
            $('#btn-save').val("create");
            $('#frmCalendario').trigger("reset");

            $("#id").val('');
            $("#btn-save").html("Guardar");
            $('#crud_modal').modal('show');
            $('#detalle').empty();

        },

        eventClick: function(calEvent, jsEvent, view) {



            var id = calEvent.id;
            var title = calEvent.title;
            Swal.fire({
            title: 'Eliminar registro ?',
            text: "El registro " + title + " será eliminado del día seleccionado.-",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar',
            cancelButtonText: 'Cancelar',
          }).then((result) => {
            if (result.value) {


                $.ajax({
                    type: "delete",
                    url: "calendario/" + id,
                    global: true,
                    success: function(data) {
                        $('#calendar').fullCalendar('refetchEvents');
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

        }

        // dateClick: function(info) {
        //     alert('Date: ' + info.dateStr);
        //     alert('Resource ID: ' + info.resource.id);
        // }

    });

    });
  </script>


  @endsection
