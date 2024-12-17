document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('alta');
    const formularios = document.querySelectorAll('.formulario');

    select.addEventListener('change', function () {
        const seleccion = select.value;

        // Ocultar todos los formularios
        formularios.forEach(formulario => {
            formulario.style.display = 'none';
            
        });

        if (seleccion) {
            const formularioSeleccionado = document.getElementById(`form-${seleccion}`);
            if (formularioSeleccionado) {
                formularioSeleccionado.style.display = 'block';
                validarFormulario(formularioSeleccionado); // Validar por si algún campo ya tiene valor
            }
        }
    });

   
});
