let Seleccion = null;
//LLENADO Prestamos
document.addEventListener("DOMContentLoaded", async() =>{
    try{
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=CRUDlistarPrestamos');
        const resol = await response.json();
        const tbody = document.querySelector("#tablaLibros tbody");
        if(resol.length === 0){
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan = "7" class="text-center">No hay Libros :c</td>`;
            tbody.appendChild(tr);
            return;
        }
        else{
            tbody.innerHTML = "";
            resol.forEach(element => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${element.id}</td>
                    <td>${element.cedula_usuario}</td>
                    <td>${element.libro}</td>
                    <td>${element.fecha_solicitud}</td>
                    <td>${element.fecha_inicio_prestamo}</td>
                    <td>${element.fecha_fin_prestamo}</td>
                    <td class="acciones">
                        <a class="btn-editar">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a class="btn-eliminar">
                            <i class="bi bi-trash"></i> Eliminar
                        </a>
                    </td>
                `;
                const btnEdit = tr.querySelector(".btn-editar");
                btnEdit.addEventListener("click", () => AbrirModal(btnEdit));
                
                const btnElim = tr.querySelector(".btn-eliminar");
                btnElim.addEventListener("click", () => eliminar(btnElim));
                
                tbody.appendChild(tr);
            });
        }
    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
});
//INSERSION DE Prestamos
document.getElementById("InsertarNuevoPrestamo").addEventListener("submit", async (event)=>{
    event.preventDefault();
    const id_bibliotecario = document.getElementById('id_bibliotecario').value.trim();
    const id_usuario = document.getElementById('id_usuario').value.trim();
    const id_libro = document.getElementById('id_libro').value.trim();
    const fecha_solicitud = document.getElementById('fecha_solicitud').value.trim();
    const fecha_inicio_prestamo = document.getElementById('fecha_inicio_prestamo').value.trim();
    const fecha_fin_prestamo = document.getElementById('fecha_fin_prestamo').value.trim();

    const data = new URLSearchParams();
    data.append("id_bibliotecario", id_bibliotecario);
    data.append("id_usuario", id_usuario);
    data.append("id_libro", id_libro);
    data.append("fecha_solicitud", fecha_solicitud);
    data.append("fecha_inicio_prestamo", fecha_inicio_prestamo);
    data.append("fecha_fin_prestamo", fecha_fin_prestamo);

    const respon = await fetch('/BibliotecaProyectoG01/index.php?accion=CRUDinsertarPrestamo',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data.toString()
    });
    const resol = await respon.json();
    if (resol){
        alert ("Prestamo registrado correctamente");
        location.reload();
    }else{
        alert ("No se pudo registrar el prestamo.");
    }
});
//abrir el modal para modificar
function AbrirModal(btnEdit){
    const fila = btnEdit.closest("tr");
    const celdas = fila.children;
    Seleccion = {
        id: celdas[0].textContent.trim(),
        cedula: celdas[1].textContent.trim(),
        libro: celdas[2].textContent.trim(),
        fechaSoli: celdas[3].textContent.trim(),
        fechaInic: celdas[4].textContent.trim(),
        fechaFin: celdas[5].textContent.trim()
    };
    document.getElementById("edit-id").value = Seleccion.id;
    document.getElementById("edit-cedula").value = Seleccion.cedula;
    document.getElementById("edit-libro").value = Seleccion.libro;
    document.getElementById("edit-fechaSoli").value = Seleccion.fechaSoli;
    document.getElementById("edit-fechaInic").value = Seleccion.fechaInic;
    document.getElementById("edit-fechaFin").value = Seleccion.fechaFin;

    document.getElementById("modalEditar").style.display = "block";
}
function cerrarModal(){
    document.getElementById("modalEditar").style.display = "none";
}
async function EditarPrestamo(){
    const Data = new URLSearchParams;
    Data.append("id", document.getElementById("edit-id").value);
    Data.append("fechaSoli", document.getElementById("edit-fechaSoli").value);
    Data.append("fechaInic",document.getElementById("edit-fechaInic").value);
    Data.append("fechaFin",document.getElementById("edit-fechaFin").value);

    try{
        const respuesta = await fetch('/BibliotecaProyectoG01/index.php?accion=EditarPrestamo',{
            method: "POST",
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: Data.toString()
        });
        const resul = await respuesta.json();
        if (resul){
            alert ("Cambiado");
            cerrarModal();
            location.reload();
        }else{
            alert ("Error en el cambiado");
        }
    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
}
async function eliminar(btnElim){
    const fila = btnElim.closest("tr");
    const celdas = fila.children;
    if (confirm("Seguro que desea eliminar?")){
        const Data = new URLSearchParams;
        Data.append("id", celdas[0].textContent.trim())
        try{
            const respuesta = await fetch('/BibliotecaProyectoG01/index.php?accion=EliminarPrestamo',{
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: Data.toString()
            });
            const resul = await respuesta.json();
            if (resul){
                alert ("Eliminado");
                location.reload();
            }else{
                alert ("Error al eliminar");
            }
        }catch(error){
            console.error('error en solicitud: ', error.message);
        }
    }
}
