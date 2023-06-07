var registros = [];

function agregarRegistro() {
    var cedula = document.getElementById("cedula").value;
    var nombre = document.getElementById("nombre").value;
    var matematicas = parseFloat(document.getElementById("matematicas").value);
    var fisica = parseFloat(document.getElementById("fisica").value);
    var programacion = parseFloat(document.getElementById("programacion").value);

    registros.push({
        cedula: cedula,
        nombre: nombre,
        matematicas: matematicas,
        fisica: fisica,
        programacion: programacion
    });

    document.getElementById("cedula").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("matematicas").value = "";
    document.getElementById("fisica").value = "";
    document.getElementById("programacion").value = "";
}

function calcularResultados() {
    var resultadosTable = document.getElementById("resultados");
    resultadosTable.style.display = "table";

    var materias = ["matematicas", "fisica", "programacion"];
    var notasPromedio = [];
    var alumnosAprobados = [];
    var alumnosAplazados = [];
    var alumnosTodasMaterias = 0;
    var alumnosUnaMateria = 0;
    var alumnosDosMaterias = 0;
    var notasMaximas = [];

    for (var i = 0; i < materias.length; i++) {
        var materia = materias[i];
        var notas = [];

        registros.forEach(function (registro) {
            var nota = registro[materia];
            notas.push(nota);

            if (nota >= 6) {
                if (!alumnosAprobados.includes(registro.cedula)) {
                    alumnosAprobados.push(registro.cedula);
                }
            } else {
                if (!alumnosAplazados.includes(registro.cedula)) {
                    alumnosAplazados.push(registro.cedula);
                }
            }
        });

        var notaPromedio = calcularPromedio(notas);
        notasPromedio.push(notaPromedio);

        var notaMaxima = Math.max(...notas);
        notasMaximas.push(notaMaxima);
    }

    registros.forEach(function (registro) {
        var numAprobadas = 0;
        materias.forEach(function (materia) {
            var nota = registro[materia];
            if (nota >= 6) {
                numAprobadas++;
            }
        });

        if (numAprobadas === 3) {
            alumnosTodasMaterias++;
        } else if (numAprobadas === 1) {
            alumnosUnaMateria++;
        } else if (numAprobadas === 2) {
            alumnosDosMaterias++;
        }
    });

    for (var i = 0; i < materias.length; i++) {
        var materia = materias[i];
        var fila = resultadosTable.insertRow();

        var celdaMateria = fila.insertCell();
        celdaMateria.innerHTML = materia;

        var celdaPromedio = fila.insertCell();
        celdaPromedio.innerHTML = notasPromedio[i].toFixed(2);

        var celdaAprobados = fila.insertCell();
        celdaAprobados.innerHTML = alumnosAprobados.length;

        var celdaAplazados = fila.insertCell();
        celdaAplazados.innerHTML = alumnosAplazados.length;

        var celdaTodasMaterias = fila.insertCell();
        celdaTodasMaterias.innerHTML = alumnosTodasMaterias;

        var celdaUnaMateria = fila.insertCell();
        celdaUnaMateria.innerHTML = alumnosUnaMateria;

        var celdaDosMaterias = fila.insertCell();
        celdaDosMaterias.innerHTML = alumnosDosMaterias;

        var celdaMaxima = fila.insertCell();
        celdaMaxima.innerHTML = notasMaximas[i];
    }
}

function calcularPromedio(notas) {
    var total = 0;
    for (var i = 0; i < notas.length; i++) {
        total += notas[i];
    }
    return total / notas.length;
}
