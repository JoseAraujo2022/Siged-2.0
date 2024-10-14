$(document).ready(function () {
  tablaDeportistas = $("#tablaDeportistas").DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar' ><i class='fas fa-edit'></button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>",
      },
    ],
    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando...",
    },
  });

  $("#btnNuevo").click(function () {
    $("#formDeportistas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; //alta
  });

  var fila; //capturar la fila para editar o borrar el registro
  //botón EDITAR    
  $(document).on("click", ".btnEditar", function () {
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text());
    nombre = fila.find("td:eq(1)").text();
    apellidos = fila.find("td:eq(2)").text();
    federaciones = fila.find("td:eq(3)").text();
    fecha_nacimiento = parseInt(fila.find("td:eq(4)").text());
    pais_nacimiento = fila.find("td:eq(5)").text();

    $("#nombre").val(nombre);
    $("#apellidos").val(apellidos);
    $("#federaciones").val(federaciones);
    $("#fecha_nacimiento").val(fecha_nacimiento);
    $("#pais_nacimiento").val(pais_nacimiento);
    opcion = 2; //editar

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Listo para salir?");
    $("#modalCRUD").modal("show");
  });
  //botón BORRAR
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id = parseInt($(this).closest("tr").find("td:eq(0)").text());

    opcion = 3; //borrar
    var respuesta = confirm(
      "¿Está seguro de eliminar el registro: " + id + "?" );
    if (respuesta) {
      $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: { opcion: opcion, id: id },
        success: function () {
          tablaDeportistas.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });

  $("#formDeportistas").submit(function (e) {
    e.preventDefault();
    nombre = $.trim($("#nombre").val());
    apellidos = $.trim($("#apellidos").val());
    federaciones = $.trim($("#feredaciones").val());
    fecha_nacimiento = $.trim($("#fecha_nacimiento").val());
    pais_nacimiento = $.trim($("#pais_nacimiento").val());
    $.ajax({
      url: "bd/crud.php",
      type: "POST",
      dataType: "json",
      data: {
        nombre: nombre,
        apellidos: apellidos,
        federaciones: federaciones,
        fecha_nacimiento: fecha_nacimiento,
        pais_nacimiento: pais_nacimiento,
        id: id,
        opcion: opcion,
      },
      success: function (data) {
        console.log(data);
        id = data[0].id;
        nombre = data[0].nombre;
        apellidos = data[0].apellidos;
        federaciones = data[0].federaciones;
        fecha_nacimiento = data[0].fecha_nacimiento;
        pais_nacimiento = data[0].pais_nacimiento;
        if (opcion == 1) {
          tablaDeportistas.row
            .add([
              id,
              nombre,
              apellidos,
              federaciones,
              fecha_nacimiento,
              pais_nacimiento,
            ])
            .draw();
        } else {
          tablaDeportistas
            .row(fila)
            .data([
              id,
              nombre,
              apellidos,
              federaciones,
              fecha_nacimiento,
              pais_nacimiento,
            ])
            .draw();
        }
      },
    });
    $("#modalCRUD").modal("hide");
  });
});
