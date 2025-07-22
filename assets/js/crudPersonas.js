let Seleccion = null;
//LLENADO Prestamos
document.addEventListener("DOMContentLoaded", async() =>{
    try{
        const Data = new URLSearchParams();
        Data.append("rol", rol)
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=CRUDlistarPersonas',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data.toString()
        });
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
                    <td>${element.cedula}</td>
                    <td>${element.nombre}</td>
                    <td>${element.apellido_paterno}</td>
                    <td>${element.apellido_materno}</td>
                    <td>${element.correo}</td>
                    <td>${element.direccion}</td>
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
document.getElementById("InsertarNuevoUser").addEventListener("submit", async (event)=>{
    event.preventDefault();
    const cedula = document.getElementById('cedula').value.trim();
    const nombre = document.getElementById('nombre').value.trim();
    const apellido_paterno = document.getElementById('apellido_paterno').value.trim();
    const apellido_materno = document.getElementById('apellido_materno').value.trim();
    const correo = document.getElementById('correo').value.trim();
    const direccion = document.getElementById('direccion').value.trim();
    const contrasena = document.getElementById('contrasena').value.trim();

    const data = new URLSearchParams();
    data.append("cedula", cedula);
    data.append("nombre", nombre);
    data.append("apellido_paterno", apellido_paterno);
    data.append("apellido_materno", apellido_materno);
    data.append("correo", correo);
    data.append("direccion", direccion);
    data.append("contrasena", contrasena);
    data.append("rol", rol);

    const respon = await fetch('/BibliotecaProyectoG01/index.php?accion=registrarUsuarioCRUD',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data.toString()
    });
    const resol = await respon.json();
    if (resol){
        alert ("Usuario registrado correctamente");
        location.reload();
    }else{
        alert ("No se pudo registrar el Usuario.");
    }
});
//abrir el modal para modificar
function AbrirModal(btnEdit){
    const fila = btnEdit.closest("tr");
    const celdas = fila.children;
    Seleccion = {
        cedula: celdas[0].textContent.trim(),
        nombre: celdas[1].textContent.trim(),
        apellido1: celdas[2].textContent.trim(),
        apellido2: celdas[3].textContent.trim(),
        correo: celdas[4].textContent.trim(),
        direccion: celdas[5].textContent.trim()
    };
    document.getElementById("edit-cedula").value = Seleccion.cedula;
    document.getElementById("edit-Nombre").value = Seleccion.nombre;
    document.getElementById("edit-Apellido").value = Seleccion.apellido1;
    document.getElementById("edit-ApellidoMaterno").value = Seleccion.apellido2;
    document.getElementById("edit-correo").value = Seleccion.correo;
    document.getElementById("edit-Direccion").value = Seleccion.direccion;

    document.getElementById("modalEditar").style.display = "block";
}
function cerrarModal(){
    document.getElementById("modalEditar").style.display = "none";
}
async function EditarUsuario(){
    const Data = new URLSearchParams;
    Data.append("cedula", document.getElementById("edit-cedula").value);
    Data.append("nombre", document.getElementById("edit-Nombre").value);
    Data.append("apellido", document.getElementById("edit-Apellido").value);
    Data.append("apellidoMaterno", document.getElementById("edit-ApellidoMaterno").value);
    Data.append("correo", document.getElementById("edit-correo").value);
    Data.append("direccion", document.getElementById("edit-Direccion").value);
    Data.append("rol", rol);
    try{
        const respuesta = await fetch('/BibliotecaProyectoG01/index.php?accion=EditarUsuario',{
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
        Data.append("cedula", celdas[0].textContent.trim())
        try{
            const respuesta = await fetch('/BibliotecaProyectoG01/index.php?accion=EliminarUsuario',{
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
