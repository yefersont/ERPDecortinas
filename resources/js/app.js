import './bootstrap';

const cloud = document.getElementById("cloud");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");
const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
const menu = document.querySelector(".menu");
const main = document.querySelector("main");

// Función para activar el modo oscuro
function activarModoOscuro() {
    let body = document.body;
    body.classList.add("dark-mode");
    circulo.classList.add("prendido");
}

// Función para desactivar el modo oscuro
function desactivarModoOscuro() {
    let body = document.body;
    body.classList.remove("dark-mode");
    circulo.classList.remove("prendido");
}

// Verificar estado de modo oscuro al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    const modoOscuroActivado = localStorage.getItem("modoOscuro");
    if (modoOscuroActivado === "true") {
        activarModoOscuro();
    }
});

// Cambiar estado de modo oscuro al hacer clic en la palanca
palanca.addEventListener("click", () => {
    let body = document.body;
    if (body.classList.contains("dark-mode")) {
        desactivarModoOscuro();
        localStorage.setItem("modoOscuro", "false");
    } else {
        activarModoOscuro();
        localStorage.setItem("modoOscuro", "true");
    }
});

// Resto del código existente
menu.addEventListener("click", () => {
    barraLateral.classList.toggle("max-barra-lateral");
    if (barraLateral.classList.contains("max-barra-lateral")) {
        menu.children[0].style.display = "none";
        menu.children[1].style.display = "block";
    } else {
        menu.children[0].style.display = "block";
        menu.children[1].style.display = "none";
    }
    if (window.innerWidth <= 320) {
        barraLateral.classList.add("mini-barra-lateral");
        main.classList.add("min-main");
        spans.forEach((span) => {
            span.classList.add("oculto");
        });
    }
});

cloud.addEventListener("click", () => {
    barraLateral.classList.toggle("mini-barra-lateral");
    main.classList.toggle("min-main");
    spans.forEach((span) => {
        span.classList.toggle("oculto");
    });
});




//new DataTable('#propietario');        
$('#tablas').DataTable({
    "language": {
        "decimal": "",
        "emptyTable": "No hay datos disponibles en la tabla",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": " ",
        "zeroRecords": "No se encontraron registros coincidentes",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": activar para ordenar la columna de manera ascendente",
            "sortDescending": ": activar para ordenar la columna de manera descendente"
        },

    }
});


///////////////////////// validacion de formularios ///////////////////
(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()


  //////////////////

