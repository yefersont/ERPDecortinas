class Notificaciones {
    private container: HTMLElement;
    private icono: HTMLElement;

    constructor(containerId: string = "notificaciones-container", iconoId: string = "notificaciones-icon") {
        this.container = document.getElementById(containerId) as HTMLElement;
        this.icono = document.getElementById(iconoId) as HTMLElement;

        // Añadir un evento para el icono de notificación
        this.icono.addEventListener("click", () => {
            this.mostrarNotificaciones();
        });
    }

    // Función para mostrar el contenedor de notificaciones
    private mostrarNotificaciones(): void {
        if (this.container.style.display === "none" || this.container.style.display === "") {
            this.container.style.display = "block"; // Mostrar las notificaciones
        } else {
            this.container.style.display = "none"; // Ocultar las notificaciones
        }
    }

    // Función para crear una notificación
    public mostrarNotificacion(mensaje: string, tipo: 'success' | 'error' | 'info' = 'info', duracion: number = 3000): void {
        const notificacion = document.createElement('div');
        notificacion.classList.add('notificacion');
        notificacion.classList.add(tipo); // Establece el tipo de la notificación (success, error, info)
        notificacion.textContent = mensaje;

        // Estilos básicos para las notificaciones
        notificacion.style.marginBottom = '10px';
        notificacion.style.padding = '10px';
        notificacion.style.borderRadius = '5px';
        notificacion.style.color = 'white';
        notificacion.style.fontSize = '16px';
        notificacion.style.transition = 'transform 0.3s ease-in-out';

        // Asignar color según el tipo
        switch (tipo) {
            case 'success':
                notificacion.style.backgroundColor = 'green';
                break;
            case 'error':
                notificacion.style.backgroundColor = 'red';
                break;
            case 'info':
                notificacion.style.backgroundColor = 'blue';
                break;
        }

        // Añadir la notificación al contenedor
        this.container.appendChild(notificacion);

        // Eliminar la notificación después de cierto tiempo
        setTimeout(() => {
            notificacion.style.transform = 'translateY(-100%)'; // Desaparece la notificación
            setTimeout(() => {
                this.container.removeChild(notificacion);
            }, 300); // Espera a que la animación termine antes de eliminar el elemento
        }, duracion);
    }
}

// Aseguramos que el DOM se haya cargado completamente antes de ejecutar el código
document.addEventListener('DOMContentLoaded', () => {
    // Instanciamos el objeto Notificaciones solo después de que el DOM esté cargado
    const notificaciones = new Notificaciones();

    // Mostrar algunas notificaciones como ejemplo
    notificaciones.mostrarNotificacion("¡Operación exitosa!", "success", 3000);
    notificaciones.mostrarNotificacion("¡Algo salió mal!", "error", 3000);
    notificaciones.mostrarNotificacion("Este es un mensaje informativo.", "info", 5000);
});
