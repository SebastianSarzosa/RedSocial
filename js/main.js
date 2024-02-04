function mostrarImagen(input) {
    var vistaPrevia = document.querySelector(".portada");
    vistaPrevia.innerHTML = '';

    if (input.files && input.files[0]) {
        var lector = new FileReader();

        lector.onload = function (e) {
            // Crear la imagen
            var imagen = document.createElement('img');
            imagen.src = e.target.result;
            imagen.style.width = "100%";
            vistaPrevia.appendChild(imagen);

            // Agregar de nuevo el botón
            var subirImagen = document.createElement('button');
            subirImagen.type = "button";
            subirImagen.className = "subirImagen";
            subirImagen.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16"><!-- Tu código SVG aquí --></svg>Editar portada';
            subirImagen.onclick = function () {
                // Aquí puedes agregar la lógica para subir la imagen a la base de datos
                subirImagenADatabase(input.files[0]);
            };
            vistaPrevia.appendChild(subirImagen);
        };

        lector.readAsDataURL(input.files[0]);
    }
}

function subirImagenADatabase(imagen) {
    // Utiliza AJAX para enviar la imagen al servidor y guardarla en la base de datos
    var formData = new FormData();
    formData.append('imagen', imagen);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_imagen.php', true);

    xhr.onload = function () {
        // Manejar la respuesta del servidor si es necesario
        if (xhr.status === 200) {
            console.log('Imagen guardada exitosamente.');
        } else {
            console.error('Error al guardar la imagen.');
        }
    };

    xhr.send(formData);
}
