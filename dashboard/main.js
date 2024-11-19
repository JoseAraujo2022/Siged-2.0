$(document).ready(function () {
  // Inicialización de la tabla de Deportistas
  tablaDeportistas = $("#tablaDeportistas").DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>",
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

  // Botón nuevo
  $("#btnNuevo").click(function () {
    $("#formDeportistas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Deportista");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; // alta
  });

  var fila; // Capturar la fila para editar o borrar el registro

  // Botón EDITAR
  $(document).on("click", ".btnEditar", function () {
    fila = $(this).closest("tr");
    id = fila.find("td:eq(0)").text();
    nombre = fila.find("td:eq(1)").text();
    apellidos = fila.find("td:eq(2)").text();
    deporte = fila.find("td:eq(3)").text(); // Se debe pasar el ID del deporte, no su nombre
    fecha_nacimiento = fila.find("td:eq(4)").text();
    provincia = fila.find("td:eq(5)").text();

    // Llenar los campos del formulario
    $("#id").val(id);
    $("#nombre").val(nombre);
    $("#apellidos").val(apellidos);
    $("#fecha_nacimiento").val(fecha_nacimiento);

    // Asignar el deporte seleccionado
    $("#deporte").val(deporte); // Asegúrate de pasar el ID del deporte, no el nombre
    $("#provincia").val(provincia);

    opcion = 2; // Editar

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Deportista");
    $("#modalCRUD").modal("show");
  });

  // Enviar formulario
  $("#formDeportistas").submit(function (e) {
    e.preventDefault();
    nombre = $("#nombre").val();
    apellidos = $("#apellidos").val();
    deporte = $("#deporte").val();
    fecha_nacimiento = $("#fecha_nacimiento").val();
    provincia = $("#provincia").val();

    $.ajax({
      url: "bd/crud_deportistas.php",
      type: "POST",
      dataType: "json",
      data: {
        id: id,
        nombre: nombre,
        apellidos: apellidos,
        deporte: deporte,
        fecha_nacimiento: fecha_nacimiento,
        provincia: provincia,
        opcion: opcion,
      },
      success: function (data) {
        console.log(data);
        id = data[0].PER_ID;
        nombre = data[0].PER_NOMBRES;
        apellidos = data[0].PER_APELLIDOS;
        deporte = data[0].DEPORTE;
        fecha_nacimiento = data[0].PER_FECHANACIMIENTO;
        provincia = data[0].PROVINCIA;

        if (opcion == 1) {
          tablaDeportistas.row.add([id, nombre, apellidos, deporte, fecha_nacimiento, provincia]).draw();
        } else {
          tablaDeportistas.row(fila).data([id, nombre, apellidos, deporte, fecha_nacimiento, provincia]).draw();
        }
      },
    });
    $("#modalCRUD").modal("hide");
  });
});
