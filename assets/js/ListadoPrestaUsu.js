// Evento que se ejecuta cuando el DOM ha sido completamente cargado.
// Realiza una solicitud POST para obtener los libros que un usuario ha solicitado.
document.addEventListener("DOMContentLoaded", async() => {//REFAC
    // Realiza una solicitud POST al backend para obtener los libros prestados por el usuario.
    const Data = new URLSearchParams();
    Data.append("id_usuario",idUsuario);
    Data.append("estado", 1);

    try{
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=listarPrestamos',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data.toString()
        });
        const resol = await response.json();

        const tbody = document.querySelector("#tablaLibros tbody");
        if (resol.length === 0){
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan = "4" class="text-center">No hay libros Prestados</td>`;
            tbody.appendChild(tr);
            return;
        }
        else{
            tbody.innerHTML = "";// Limpia la tabla antes de agregar nuevos datos
            // Itera sobre cada libro obtenido y crea una nueva fila en la tabla para mostrar los datos
            resol.forEach(Libro => {
                const tr = document.createElement("tr");
                // Inserta los datos del libro en la fila de la tabla
                tr.innerHTML = `
                    <td>${Libro.id_prestamo}</td>
                    <td>${Libro.libro}</td>
                    <td>${Libro.fecha_inicio}</td>
                    <td>${Libro.fecha_fin}</td>
                `;
                // Agrega la nueva fila a la tabla
                tbody.appendChild(tr);
            });
        }

    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
});