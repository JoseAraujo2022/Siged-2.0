document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registroForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío tradicional del formulario.

        const formData = new FormData(form);

        fetch("bd/crud.php", {
            method: "POST",
            body: formData,
        })
            .then(response => response.json()) // Asegúrate de que `crud.php` devuelve JSON.
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Exito",
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    form.reset(); // Limpia el formulario si es necesario.
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: "error",
                    title: "Error inesperado",
                    text: "Ha ocurrido un error. Intenta nuevamente.",
                });
                console.error("Error:", error);
            });
    });
});