// Función para eliminar una categoría
function eliminarCategoria(id) {
    if (confirm('¿Estás seguro de eliminar esta categoría?')) {
        $.ajax({
            type: 'POST',
            url: 'eliminar.php',
            data: { id: id },
            success: function(response) {
                if (response === 'ok') {
                    // Eliminar la fila de la tabla
                    $('#categoria-' + id).remove();
                    alert("CATEGORIA ELIMINADA CORECTAMENTE")
                } else {
                    alert('Error al eliminar la categoría');
                }
            }
        });
    }
}

// Función para actualizar el nombre de una categoría
function editarCategoria(id) {
    const nuevoNombre = prompt('Nuevo nombre para la categoría:');
    if (nuevoNombre) {
        $.ajax({
            type: 'POST',
            url: 'editar.php',
            data: { id: id, nombre: nuevoNombre },
            success: function(response) {
                if (response === 'ok') {
                    // Actualizar el nombre en la tabla
                    $('#nombre-' + id).text(nuevoNombre);
                    alert("CATEGORIA EDITADA CORRECTAMENTE")
                } else {
                    alert('Error al actualizar la categoría');
                }
            }
        });
    }
}
