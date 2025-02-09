


document.addEventListener('DOMContentLoaded', function() {
    const hourButtons = document.querySelectorAll('.hour-button');

    hourButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedHour = button.getAttribute('data-hour');

            // Envoi de l'heure via AJAX
            fetch(ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'booking_contact',
                    hour: selectedHour,
                    nonce: booking_contact_nonce // Ajoutez ici le nonce généré pour plus de sécurité
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Message de succès ou d'erreur
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    });
});




// Effet fermer et ouvrir

document.addEventListener("DOMContentLoaded", function() {

    // Informations
    const infoTitle = document.getElementById('info-title');
    const infoSection = document.getElementById('info-section');
    
    infoTitle.addEventListener('click', function() {
        // Bascule entre l'affichage et la dissimulation de la section
        infoSection.style.display = (infoSection.style.display === 'none' || infoSection.style.display === '') ? 'block' : 'none';
    });
});
