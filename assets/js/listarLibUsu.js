// Evento que se ejecuta cuando el DOM ha sido completamente cargado.
// Solicita al backend la lista de libros disponibles y los muestra en la tabla.
document.addEventListener("DOMContentLoaded", async() =>{//REFAC
    const Data = new URLSearchParams();
    Data.append("rolUsuario", rolUsuario);
    try{
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=listarLibros',{
            method: 'POST',
            headers:{
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data.toString()
        })
        const resol = await response.json();
        
        const tbody = document.querySelector("#tablaLibros tbody");
        tbody.innerHTML = "";// Limpia la tabla antes de agregar nuevos datos
    
        if (resol.length === 0){
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan = "6" class="text-center">No hay libros para solicitar :C</td>`;
            tbody.appendChild(tr);
            return;
        }else{
            resol.forEach(Libro => {
                const tr = document.createElement("tr");
                // Inserta los datos del libro en la fila de la tabla
                tr.innerHTML = `
                    <td>${Libro.id}</td>
                    <td>${Libro.titulo}</td>
                    <td>${Libro.autor}</td>
                    <td>${Libro.genero}</td>
                    <td>${Libro.cantidad}</td>
                    <td class="acciones">
                        <button class="btn-confirmar" title="Confirmar">
                            <i class="fas fa-check"></i> Solicitar
                        </button>
                    </td>
                `;
    
                // Añadir evento al botón desde JS
                const btn = tr.querySelector(".btn-confirmar");
                btn.addEventListener("click", () => Solicitar(btn));
                // Agrega la fila a la tabla
                tbody.appendChild(tr);
            });
        }
    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
});
// Función que maneja la solicitud de un libro cuando el usuario hace clic en "Solicitar"
function Solicitar(btn) {//REFAC
    const fila = btn.closest("tr");
    const celdas = fila.children;
    // Almacena la información del libro seleccionado
    libroSeleccionado = {
        id: celdas[0].textContent.trim(),
        titulo: celdas[1].textContent.trim()
    };

    // Muestra la información del libro en el modal
    document.getElementById("modalId").textContent = celdas[0].textContent;
    document.getElementById("modalLibro").textContent = celdas[1].textContent;
    document.getElementById("modalAutor").textContent = celdas[2].textContent;
    document.getElementById("modalGenero").textContent = celdas[3].textContent;

    // Configura las fechas de inicio y fin del préstamo
    const hoy = new Date();
    const maxInicio = new Date();
    maxInicio.setDate(hoy.getDate() + 3);// Fecha de inicio como máximo 3 días después de hoy

    const fechaInicioInput = document.getElementById("fechaInicio");
    fechaInicioInput.min = hoy.toISOString().split('T')[0];
    fechaInicioInput.max = maxInicio.toISOString().split('T')[0];
    fechaInicioInput.value = '';// Se borra el valor por defecto

    const fechaFinInput = document.getElementById("fechaFin");
    fechaFinInput.value = '';// Se borra el valor por defecto
    fechaFinInput.min = '';// Se restablece el valor mínimo
    fechaFinInput.max = '';// Se restablece el valor máximo
    //muestra el modal
    document.getElementById("modal").style.display = "block";
}
// Ajusta la fecha final en función de la fecha de inicio seleccionada
document.getElementById("fechaInicio").addEventListener("change", function () {//REFAC
    const inicio = new Date(this.value);
    if (isNaN(inicio)) return;// Si la fecha de inicio no es válida, no hace nada

    const minFin = new Date(inicio);
    minFin.setDate(minFin.getDate() + 1); // La fecha final debe ser al menos 1 día después

    const maxFin = new Date(inicio);
    maxFin.setDate(maxFin.getDate() + 20); // La fecha final puede ser máximo 20 días después

    const fechaFinInput = document.getElementById("fechaFin");
    fechaFinInput.min = minFin.toISOString().split('T')[0];// Establece el valor mínimo para la fecha final
    fechaFinInput.max = maxFin.toISOString().split('T')[0];// Establece el valor máximo para la fecha final
    fechaFinInput.value = '';// Resetea el valor de fecha final
});
/*
 * Cierra el modal de solicitud de libro.
 */
function cerrarModal() {//REFAC
    document.getElementById("modal").style.display = "none";
}
/*
 * Función que comunica la solicitud al backend para registrar la solicitud de préstamo.
 * Se envía la fecha de inicio, fecha de fin y otros datos necesarios.
 */
async function confirmarSolicitud() {
    const fechaInicio = document.getElementById("fechaInicio").value;
    const fechaFin = document.getElementById("fechaFin").value;
    // Verifica que ambas fechas estén seleccionadas
    if (!fechaInicio || !fechaFin) {
        alert("Por favor, selecciona ambas fechas.");
        return;
    }

    // Obtener fecha actual en formato YYYY-MM-DD
    const hoy = new Date();
    const fechaSolicitud = hoy.toISOString().split('T')[0];
    // Crea el objeto de datos para la solicitud
    const datos = new URLSearchParams();
    datos.append("id_libro", libroSeleccionado.id);
    datos.append("fecha_inicio", fechaInicio);
    datos.append("fecha_fin", fechaFin);
    datos.append("id_usuario", idUsuario); // idUsuario está disponible en el contexto
    datos.append("fecha_solicitud", fechaSolicitud);

    // Envia los datos al backend para procesar la solicitud
    try{
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=solicitarLibro', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: datos.toString()
        })
        const resol = await response.json();
    
        if (resol.success) {
            alert(resol.mensaje);
            cerrarModal();
            location.reload(); // Recarga la página para actualizar la tabla
        } else {
            alert("Error al realizar la solicitud: " + resol.mensaje);
        }
    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
}