var empleados = [];

function agregarEmpleado() {
    var nombre = document.getElementById('nombre').value;
    var edad = parseInt(document.getElementById('edad').value);
    var estadoCivil = document.getElementById('estadoCivil').value;
    var sexo = document.getElementById('sexo').value;
    var sueldo = document.getElementById('sueldo').value;

    var empleado = {
        nombre: nombre,
        edad: edad,
        estadoCivil: estadoCivil,
        sexo: sexo,
        sueldo: sueldo
    };

    empleados.push(empleado);

    // Reiniciar los campos del formulario
    document.getElementById('nombre').value = '';
    document.getElementById('edad').value = '';
    document.getElementById('estadoCivil').value = 'Soltero(a)';
    document.getElementById('sexo').value = 'Femenino';
    document.getElementById('sueldo').value = 'Menos de 1000 Bs.';

    calcularEstadisticas();
}

function calcularEstadisticas() {
    var totalFemenino = 0;
    var totalHombresCasados = 0;
    var totalMujeresViudas = 0;
    var sumaEdadHombres = 0;
    var totalHombres = 0;

    for (var i = 0; i < empleados.length; i++) {
        var empleado = empleados[i];

        if (empleado.sexo === 'Femenino') {
            totalFemenino++;
        }

        if (empleado.sexo === 'Masculino') {
            totalHombres++;

            if (empleado.estadoCivil === 'Casado(a)' && empleado.sueldo === 'Más de 2500 Bs.') {
                totalHombresCasados++;
            }

            if (empleado.estadoCivil === 'Viudo(a)' && empleado.sueldo === 'Más de 1000 Bs.') {
                totalMujeresViudas++;
            }

            sumaEdadHombres += empleado.edad;
        }
    }

    var edadPromedioHombres = totalHombres > 0 ? sumaEdadHombres / totalHombres : 0;

    document.getElementById('totalFemenino').textContent = totalFemenino;
    document.getElementById('totalHombresCasados').textContent = totalHombresCasados;
    document.getElementById('totalMujeresViudas').textContent = totalMujeresViudas;
    document.getElementById('edadPromedioHombres').textContent = edadPromedioHombres.toFixed(2);
}
