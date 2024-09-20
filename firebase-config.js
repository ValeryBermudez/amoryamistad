// Importa las funciones que necesitas del SDK de Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-app.js";
import { getDatabase } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-database.js";

// Tu configuración de Firebase
const firebaseConfig = {
  apiKey: "AIzaSyCrifdi1gDTMMQ6_hza-qpSBGHFZB4ntLw",
  authDomain: "amigosecreto-cdc68.firebaseapp.com",
  databaseURL: "https://amigosecreto-cdc68-default-rtdb.firebaseio.com",
  projectId: "amigosecreto-cdc68",
  storageBucket: "amigosecreto-cdc68.appspot.com",
  messagingSenderId: "999049919734",
  appId: "1:999049919734:web:2568031cb5085b237b80d7",
  measurementId: "G-6347KWWQDL"
};

// Inicializa Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

// Exporta la instancia de la base de datos para usarla en otros archivos
export { db };
