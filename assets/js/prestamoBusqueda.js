
cargarTablaActivos();
cargarTablaInactivos();
/*
 * Función para buscar préstamos activos según un término ingresado por el usuario.
 * Se activa con el evento submit del formulario o botón correspondiente.
*/
function cargarTablaActivos() {//REFAC
    const tipo = 1;
    const estado = 'Activos';
    const tbody = '#tablaLibroPres tbody';
    const columnas = 7;

    cargar(tipo, estado, tbody, columnas);
};
function cargarTablaInactivos() {//REFAC
    const tipo = 2;
    const estado = 'Inactivos';
    const Ntbody = '#tablaLibroPres2 tbody';
    const columnas = 6;

    cargar(tipo, estado, Ntbody, columnas);
};
async function cargar(tipo, estado, Ntbody, columnas){//REFAC
    const Data = new URLSearchParams;
    Data.append ("estado", tipo);
    try{
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=listarPrestamosBibli',{
            method: 'POST',
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: Data.toString()
        });
        if (!response.ok) {
            throw new Error(`Error al cargar los préstamos ${estado}`);
        }
        const prestamos = await response.json();

        const tbody = document.querySelector(`${Ntbody}`);
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos datos
        if (prestamos.length === 0) {
            // Si no hay préstamos activos, muestra un mensaje
            tbody.innerHTML = `<tr><td colspan="${columnas}">No hay préstamos ${estado}</td></tr>`;
        } else {
            if(tipo == 1){
                prestamos.forEach(p => {
                    const tr = document.createElement("tr");
                    tr.innerHTML=`
                            <td>${p.id_prestamo}</td>
                            <td>${p.cedula_usuario}</td>
                            <td>${p.titulo_libro}</td>
                            <td>${p.fecha_solicitud}</td>
                            <td>${p.fecha_inicio}</td>
                            <td>${p.fecha_fin}</td>
                            <td></td>
                    `;
                    const celdaAccion = tr.querySelector("td:last-child");
                    const boton = document.createElement("button");
                    boton.textContent = "Devolver";
                    boton.className = "btn";
                    boton.onclick = function(){
                        marcarDevolucion(p);
                    };
                    celdaAccion.appendChild(boton);

                    tbody.appendChild(tr);
                });
            }else{
                tbody.innerHTML="";
                prestamos.forEach(p => {
                    const fila =`
                        <tr>
                            <td>${p.id_prestamo}</td>
                            <td>${p.cedula_usuario}</td>
                            <td>${p.titulo_libro}</td>
                            <td>${p.fecha_solicitud}</td>
                            <td>${p.fecha_inicio}</td>
                            <td>${p.fecha_fin}</td>
                        </tr>
                    `;
                    tbody.innerHTML += fila;
                });
            }
        }
    }catch (error) {
        // Maneja cualquier error que ocurra durante la solicitud
        console.error('Error al cargar los préstamos activos:', error);
        alert(`Ocurrió un error.`);
    }
}
document.getElementById('BusquedaActivos').addEventListener('submit', async (event)=>{
    event.preventDefault();

    const termino = document.getElementById('busquedaAct').value.trim();
    if (termino === '') {
        cargarTablaActivos(); // Si el término está vacío, recarga la tabla completa
        return;
    }
    const Data = new URLSearchParams;
    Data.append('termino', termino);
    Data.append('estado', 1);
    try {
        const response = await fetch(`/BibliotecaProyectoG01/index.php?accion=buscarPrestamos`,{
            method: 'POST',
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: Data.toString()
        });
        if (!response.ok) {
            throw new Error('Error al buscar préstamos activos');
        }
        const resultados = await response.json();

        const tbody = document.querySelector('#tablaLibroPres tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos resultados
        if (resultados.length === 0) {
            // Si no se encontraron resultados, muestra un mensaje
            tbody.innerHTML = '<tr><td colspan="7">No se encontraron resultados</td></tr>';
        } else {
            // Si hay resultados, los agrega a la tabla
            resultados.forEach(p => {
                const tr = document.createElement("tr");
                tr.innerHTML=`
                        <td>${p.id_prestamo}</td>
                        <td>${p.cedula_usuario}</td>
                        <td>${p.titulo_libro}</td>
                        <td>${p.fecha_solicitud}</td>
                        <td>${p.fecha_inicio}</td>
                        <td>${p.fecha_fin}</td>
                        <td></td>
                `;
                const celdaAccion = tr.querySelector("td:last-child");
                const boton = document.createElement("button");
                boton.textContent = "Devolver";
                boton.className = "btn";
                boton.onclick = function(){
                    marcarDevolucion(p);
                };
                celdaAccion.appendChild(boton);

                tbody.appendChild(tr);
            });
        }
    } catch (error) {
        console.error('Error al buscar préstamos activos:', error);
        alert(`Ocurrió un error: ${error.message}`);
    }
})

document.getElementById('BusquedaInactivos').addEventListener('submit', async (event)=>{
    event.preventDefault();
    const termino = document.getElementById('busquedaInac').value.trim();
    if (termino === '') {
        cargarTablaInactivos(); // Si el término está vacío, recarga la tabla completa
        return;
    }
    const Data = new URLSearchParams;
    Data.append('termino', termino);
    Data.append('estado', 2);
    try {
        const response = await fetch(`/BibliotecaProyectoG01/index.php?accion=buscarPrestamos`,{
            method: 'POST',
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: Data.toString()
        });
        if (!response.ok) {
            throw new Error('Error al buscar préstamos inactivos');
        }
        const resultados = await response.json();

        const tbody = document.querySelector('#tablaLibroPres2 tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos resultados
        if (resultados.length === 0) {
            // Si no se encontraron resultados, muestra un mensaje
            tbody.innerHTML = '<tr><td colspan="6">No se encontraron resultados</td></tr>';
        } else {
            // Si hay resultados, los agrega a la tabla
            resultados.forEach(p => {
                const fila = `
                    <tr>
                        <td>${p.id_prestamo}</td>
                        <td>${p.cedula_usuario}</td>
                        <td>${p.titulo_libro}</td>
                        <td>${p.fecha_solicitud}</td>
                        <td>${p.fecha_inicio}</td>
                        <td>${p.fecha_fin}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    } catch (error) {
        console.error('Error al buscar préstamos inactivos:', error);
    }
})
async function marcarDevolucion(prestamo){//REFAC
    if(confirm("Seguro que desea marcar como devuelto el prestamo: " + prestamo.id_prestamo)){
        try{
            const datos = new URLSearchParams();
            datos.append("idPrestamo", prestamo.id_prestamo);
            datos.append("estado", 2);
            const respon = await fetch('/BibliotecaProyectoG01/index.php?accion=marcarDevolucion',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: datos.toString()
            });
            const resol = await respon.json();
            if (resol){
                alert ("Prestamo marcado como devuelto.");
                location.reload();
            }else{
                alert ("No se pudo continuar con la solicitud.");
            }
        }catch(error){
            console.error('Error en la búsqueda:', error);
            alert('Error al tratar de cambiar el estado');
        }
    }else{
        alert ("Cancelado.")
        location.reload();
    }
}