import { db } from './firebase-config.js';
import { ref, get, set } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-database.js";

document.getElementById('sorteoForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const nombreConsulta = document.getElementById('nombreConsulta').value.trim().toLowerCase();
    
    if (nombreConsulta) {
        const consultaRef = ref(db, 'sorteos/' + nombreConsulta);

        // Verificamos si ya tiene un amigo secreto asignado
        get(consultaRef)
            .then((snapshot) => {
                if (snapshot.exists()) {
                    // Si ya tiene un amigo secreto, lo mostramos
                    const amigoSecreto = snapshot.val();
                    mostrarResultado(amigoSecreto);
                } else {
                    // Si no tiene un amigo asignado, realizamos el sorteo
                    realizarSorteo(nombreConsulta);
                }
            })
            .catch((error) => {
                console.error('Error al consultar los datos:', error);
            });
    } else {
        alert('Por favor, ingresa tu nombre.');
    }
});

function realizarSorteo(nombreConsulta) {
    get(ref(db, 'registros')).then((snapshot) => {
        if (snapshot.exists()) {
            const registros = snapshot.val();
            const nombres = Object.keys(registros);
            const disponibles = nombres.filter(n => n !== nombreConsulta);
            
            if (disponibles.length > 0) {
                const amigoSecretoNombre = disponibles[Math.floor(Math.random() * disponibles.length)];
                const amigoSecreto = registros[amigoSecretoNombre];
                
                // Guardamos el resultado del sorteo
                set(ref(db, 'sorteos/' + nombreConsulta), amigoSecreto)
                    .then(() => {
                        mostrarResultado(amigoSecreto);
                    })
                    .catch((error) => {
                        console.error('Error al guardar el sorteo:', error);
                    });
            } else {
                alert('No hay suficientes participantes disponibles.');
            }
        } else {
            console.log("No hay datos disponibles.");
        }
    }).catch((error) => {
        console.error("Error al realizar el sorteo:", error);
    });
}

function mostrarResultado(amigoSecreto) {
    document.getElementById('resultado').style.display = 'block';
    document.getElementById('amigoSecretoResultado').textContent = `Tu amigo secreto es: ${amigoSecreto.nombre}`;
    document.getElementById('gustosResultado').textContent = `Le gusta: ${amigoSecreto.gustos}`;
    document.getElementById('noGustosResultado').textContent = `No le gusta: ${amigoSecreto.noGustos}`;
}
