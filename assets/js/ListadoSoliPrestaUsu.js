// Evento que se ejecuta cuando el DOM ha sido completamente cargado.
// Realiza una solicitud POST para obtener los libros que un usuario ha solicitado.
document.addEventListener("DOMContentLoaded", async() => {//REFAC
    // Realiza una solicitud POST al backend para obtener los libros prestados por el usuario.
    const datos = new URLSearchParams();
    datos.append("id_usuario",idUsuario);
    datos.append("estado", 3);

    try{
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=listarPrestamos',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: datos.toString()
        });
        const resol = await response.json();
    
        const tbody = document.querySelector("#tablaLibros tbody");
        if (resol.length === 0){
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan = "5" class="text-center">No hay libros Prestados</td>`;
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
                    <td class="acciones">
                        <button class="btn-confirmar" title="Confirmar">
                            <i class="fas fa-check"></i> Ver Detalles
                        </button>
                    </td>
                `;
                // Selecciona el botón "Ver Detalles" y agrega un evento de click para mostrar detalles del libro
                const btn = tr.querySelector(".btn-confirmar");
                btn.addEventListener("click", () => VerDetalles(btn));
                // Agrega la nueva fila a la tabla
                tbody.appendChild(tr);
            });
        }
    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
});
/*
 * Cierra el modal sin realizar ninguna acción.
 */
function cerrarModal() {//REFAC
    document.getElementById("modal").style.display = "none";
}
function VerDetalles(btn) {//REFAC
    const fila = btn.closest("tr");
    const celdas = fila.children;
    // Muestra los datos del préstamo en el modal
    document.getElementById("modalNumPres").textContent = celdas[0].textContent;
    document.getElementById("modalLibro").textContent = celdas[1].textContent;
    document.getElementById("modalFechaInicio").textContent = celdas[2].textContent;
    document.getElementById("modalFechaFin").textContent = celdas[3].textContent;
    // Muestra el modal
    document.getElementById("modal").style.display = "block";
}
async function cancelarSolicitud(){
    if(confirm("Seguro que ya no desea solicitar de este libro.")){
        const id_pres = parseInt(document.getElementById("modalNumPres").textContent);
        const Data = new URLSearchParams();
        Data.append("estado", 4);
        Data.append("idUser", idUsuario);
        Data.append("id_prestamo", id_pres);

        try{
            const response = await fetch('/BibliotecaProyectoG01/index.php?accion=cancelarSolicitudLibro',{
                method: "POST",
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: Data.toString()
            });
            const resol = await response.json();
            if (resol.success){
                alert (resol.mensaje);
                cerrarModal();
                location.reload();
            }else{
                alert (resol.mensaje);
            }
        }catch(error){
            console.error('No se pudo hacer la solicitud: ', error.message);
            alert(`Ocurrió un error.`);
        }
    }else{
        cerrarModal();
    }
}