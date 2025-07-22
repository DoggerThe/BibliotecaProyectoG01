let Seleccion = null;
//LLENADO DE LIBROS
document.addEventListener("DOMContentLoaded", async() =>{
    try{
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=CRUDlistarLiros');
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
                    <td>${element.ISBN}</td>
                    <td>${element.titulo}</td>
                    <td>${element.genero}</td>
                    <td>${element.autor}</td>
                    <td>${element.editorial}</td>
                    <td>${element.cantidad}</td>
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
                btnElim.addEventListener("click", () => eliminarLibro(btnElim));
                
                tbody.appendChild(tr);
            });
        }
    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
    llenadoGeneros("genero");
});
async function llenadoGeneros($id){
    try{
        const respuesta = await fetch('/BibliotecaProyectoG01/index.php?accion=ListarGeneros');
        const resul = await respuesta.json();
        const selectGenero = document.getElementById($id);
        resul.forEach(genero =>{
            const option = document.createElement('option');
            option.value = genero.id;
            option.textContent = genero.genero;
            selectGenero.appendChild(option);
        });
    }catch(error){
        console.error('error en solicitud: ', error.message);
    }
}
//INSERSION DE LIBROS
document.getElementById("InsertarNuevoLibro").addEventListener("submit", async (event)=>{
    event.preventDefault();
    const isbn = document.getElementById('isbn').value.trim();
    const titulo = document.getElementById('titulo').value.trim();
    const genero = document.getElementById('genero').value.trim();
    const cantidad = document.getElementById('cantidad').value.trim();
    const autor = document.getElementById('autor').value.trim();
    const editorial = document.getElementById('editorial').value.trim();

    const data = new URLSearchParams();
    data.append("isbn", isbn);
    data.append("titulo", titulo);
    data.append("genero", genero);
    data.append("cantidad", cantidad);
    data.append("autor", autor);
    data.append("editorial", editorial);

    const respon = await fetch('/BibliotecaProyectoG01/index.php?accion=CRUDinsertarLibro',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data.toString()
    });
    const resol = await respon.json();
    if (resol){
        alert ("Libro registrado correctamente");
        location.reload();
    }else{
        alert ("No se pudo registrar el libro.");
    }
});



function AbrirModal(btnEdit){
    const fila = btnEdit.closest("tr");
    const celdas = fila.children;
    Seleccion = {
        isbn: celdas[0].textContent.trim(),
        titulo: celdas[1].textContent.trim(),
        genero: celdas[2].textContent.trim(),
        autor: celdas[3].textContent.trim(),
        editorial: celdas[4].textContent.trim(),
        cantidad: celdas[5].textContent.trim()
    };
    document.getElementById("edit-isbn").value = Seleccion.isbn;
    document.getElementById("edit-titulo").value = Seleccion.titulo;
    document.getElementById("edit-autor").value = Seleccion.autor;
    document.getElementById("edit-editorial").value = Seleccion.editorial;
    document.getElementById("edit-cantidad").value = Seleccion.cantidad;

    document.getElementById("modalEditar").style.display = "block";
    llenadoGeneros("generoModal");
}
function cerrarModal(){
    document.getElementById("modalEditar").style.display = "none";
}
async function EditarLibro(){
    const Data = new URLSearchParams;
    Data.append("isbn", document.getElementById("edit-isbn").value);
    Data.append("titulo", document.getElementById("edit-titulo").value);
    Data.append("genero",document.getElementById("generoModal").value);
    Data.append("autor",document.getElementById("edit-autor").value);
    Data.append("editorial",document.getElementById("edit-editorial").value);
    Data.append("cantidad",document.getElementById("edit-cantidad").value);
    try{
        const respuesta = await fetch('/BibliotecaProyectoG01/index.php?accion=EditarLibros',{
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
async function eliminarLibro(btnElim){
    const fila = btnElim.closest("tr");
    const celdas = fila.children;
    if (confirm("Seguro que desea eliminar?")){
        const Data = new URLSearchParams;
        Data.append("isbn", celdas[0].textContent.trim())
        try{
            const respuesta = await fetch('/BibliotecaProyectoG01/index.php?accion=EliminarLibro',{
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
