document.addEventListener("DOMContentLoaded", function () {
    // Buscar la pestaña de configuración por su ID o clase
    const settingsTab = document.querySelector('.nav-tabs li a[data-target="#settings"]');
    
    // Agregar un evento de clic para recargar la página
    if (settingsTab) {
        settingsTab.addEventListener("click", function () {
            location.reload();
        });
    }
});
