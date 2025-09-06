$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// confirmAgua = document.querySelector('#reiniciarAgua');

function sumarElemento(id, servicio) {
    let data = new FormData();
    data.append('id', id);
    data.append('elemento', servicio);

    $.ajax({
        url: '/sumarElemento',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(response) {
            if (response.status) {
                console.log('Success');
                
                // Buscar el elemento en el DOM
                let celda = document.getElementById(`valor-${id}-${servicio}`);
                
                if (celda) {
                    // Convertir el texto a número y sumarle 1
                    let valorActual = parseInt(celda.innerText) || 0;
                    celda.innerText = valorActual + 1;
                }

            } else {
                alert("No se ha podido almacenar la información.");
            }
        },
        error: function() {
            alert("Error en la petición al servidor.");
        }
    });
}


function restarElemento(id, servicio) 
{
    let data = new FormData();
    data.append('id', id);
    data.append('elemento', servicio);

    $.ajax({
        url: '/restarElemento',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(response) {
            if (response.status) {
                console.log('Success');

                // Buscar el elemento en el DOM
                let celda = document.getElementById(`valor-${id}-${servicio}`);

                if (celda) {
                    // Convertir el texto a número y restarle 1 sin permitir valores negativos
                    let valorActual = parseInt(celda.innerText) || 0;
                    if (valorActual > 0) {
                        celda.innerText = valorActual - 1;
                    }
                }

            } else {
                alert("No se ha podido almacenar la información.");
            }
        },
        error: function() {
            alert("Error en la petición al servidor.");
        }
    });
}


function reiniciarElemento(id) 
{
    let data = new FormData();
    data.append('id', id);
    $.ajax({
        url: '/reiniciarCorrespondencia',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(response) {
            if (response.status) {
                // Actualiza todos los valores a 0 sin recargar la página
                document.getElementById(`valor-${id}-luz`).innerText = 0;
                document.getElementById(`valor-${id}-agua`).innerText = 0;
                document.getElementById(`valor-${id}-gas`).innerText = 0;
                document.getElementById(`valor-${id}-mensajes`).innerText = 0;
                document.getElementById(`valor-${id}-paquetes`).innerText = 0;

                alert(response.message);
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert("Error en la petición al servidor.");
        }
    });
}

function recepcionServiciosConjuntos(servicio) {
    if (servicio) {
        $.ajax({
            url: '/recepcionServiciosConjuntos',
            method: 'POST',
            dataType: 'json',
            data: { item: servicio },
            success: function(response) {
                if (response.status) {
                    // Iterar sobre todos los elementos que tienen el servicio afectado
                    document.querySelectorAll(`[id^="valor-"][id$="-${servicio.toLowerCase()}"]`).forEach(element => {
                        let valorActual = parseInt(element.innerText);
                        element.innerText = valorActual + 1;
                    });

                    alert(response.message);
                } else {
                    alert("Error en la actualización.");
                }
            },
            error: function(error) {
                console.log(error);
                alert("Error en la petición al servidor.");
            }
        });
    } else {
        alert('Por favor seleccione un servicio');
    }
}

