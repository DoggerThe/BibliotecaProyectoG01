cargarTablaLibros();

async function cargarTablaLibros() {
    const Data = new URLSearchParams();
    Data.append("rolUsuario", rolUsuario);
    try {
        const response = await fetch('/BibliotecaProyectoG01/index.php?accion=listarLibros',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data.toString()
        });
        if (!response.ok) {
            throw new Error('Error al cargar los libros');
        }
        const libros = await response.json();

        const tbody = document.querySelector('#tablaLibros tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos datos
        if (libros.length === 0) {
            // Si no hay libros, muestra un mensaje
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan = "3" class="text-center">No hay libros disponibles :C</td>`;
            tbody.appendChild(tr);
            return;
        } else {
            // Si hay libros, los agrega a la tabla
            libros.forEach(libro => {
                const tr = document.createElement("tr");
                tr.innerHTML=`
                    <td>${libro.titulo}</td>
                    <td>${libro.autor}</td>
                    <td>${libro.cantidad}</td>
                `;
                tbody.appendChild(tr);
            });
        }
    } catch (error) {
        // Maneja cualquier error que ocurra durante la solicitud
        console.error('Error al cargar los libros:', error.message)
    };
}
// Función que maneja el evento de búsqueda
document.getElementById('form-busqueda').addEventListener('submit', async (event)=>{
    // Evita que se recargue la página al enviar el formulario
    event.preventDefault();
    
    const termino = document.getElementById('busqueda').value.trim();
    const Data = new URLSearchParams;
    Data.append("termino", termino);
    Data.append("rolUsuario", rolUsuario);
    try{
        const response = await fetch(`/BibliotecaProyectoG01/index.php?accion=buscarLibro`,{
            method: 'POST',
            headers:{
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data.toString()
        });
        if (!response.ok) {
            throw new Error('Error en la búsqueda');
        }
        const resultados = await response.json();

        const tbody = document.querySelector('#tablaLibros tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos resultados
        if (resultados.length === 0) {
            // Si no se encontraron resultados, muestra un mensaje
            tbody.innerHTML = '<tr><td colspan="3">No se encontraron resultados</td></tr>';
        } else {
            // Si hay resultados, los agrega a la tabla
            resultados.forEach(libro => {
                const fila = `
                    <tr>
                        <td>${libro.titulo}</td>
                        <td>${libro.autor}</td>
                        <td>${libro.cantidad}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    }catch(error) {
        // Maneja cualquier error que ocurra durante la solicitud
        console.error('Error al buscar:', error.message);
    };

})
