document.getElementById('reservationForm').addEventListener('submit', function(event) {
    let covers = document.getElementById('covers').value;
    let date = document.getElementById('date').value;
    let time = document.getElementById('time').value;
    
    if (!covers || !date || !time) {
        event.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires.');
    }
});


// document.addEventListener('DOMContentLoaded', function() {
//     const hourButtons = document.querySelectorAll('.hour-button');

//     hourButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             const selectedHour = button.getAttribute('data-hour');

//             // Envoi de l'heure via AJAX
//             fetch(ajaxurl, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify({
//                     action: 'booking_reservation',
//                     hour: selectedHour,
//                     nonce: booking_reservation_nonce // Ajoutez ici le nonce généré pour plus de sécurité
//                 })
//             })
//             .then(response => response.json())
//             .then(data => {
//                 alert(data.message); // Message de succès ou d'erreur
//             })
//             .catch(error => {
//                 console.error('Erreur:', error);
//             });
//         });
//     });
// });

//horaire

document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll('.hour-button'); // Sélectionner tous les boutons d'horaires
    const hiddenField = document.getElementById('selected_time'); // Champ caché pour l'heure sélectionnée

    // Ajouter un événement au clic sur chaque bouton
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer l'heure depuis le bouton cliqué
            const selectedHour = this.getAttribute('data-hour');
            // Mettre l'heure sélectionnée dans le champ caché
            hiddenField.value = selectedHour;
        });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const midiButton = document.getElementById("midi-button");
    const soirButton = document.getElementById("soir-button");

    const midiHours = document.getElementById("midi-hours");
    const soirHours = document.getElementById("soir-hours");

    // Afficher les horaires du midi au clic sur le bouton Midi
    midiButton.addEventListener("click", function() {
        midiHours.style.display = "block";
        soirHours.style.display = "none";
    });

    // Afficher les horaires du soir au clic sur le bouton Soir
    soirButton.addEventListener("click", function() {
        soirHours.style.display = "block";
        midiHours.style.display = "none";
    });

    // Par défaut, afficher les horaires du midi
    midiButton.click();
});

//couverts

document.addEventListener("DOMContentLoaded", function() {
    const coverButtons = document.querySelectorAll('.cover-button');
    const hiddenInput = document.getElementById('covers');

    // Ajouter un écouteur d'événements à chaque bouton
    coverButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Lorsque le bouton est cliqué, on met à jour la valeur du champ caché
            hiddenInput.value = this.getAttribute('data-cover');
            
            // Optionnel : Appliquer une classe active pour marquer le bouton sélectionné
            coverButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript chargé.");

    // Fonction pour afficher la popup avec les informations choisies
    function showPopup(details) {
        const popup = document.getElementById("reservationConfirmation");
        const overlay = document.getElementById("popupOverlay");

        if (popup && overlay) {
            // Formater la date au format français
            const date = new Intl.DateTimeFormat('fr-FR', { dateStyle: 'long' }).format(new Date(details.date));

            // Mettre à jour le contenu de la popup
            const popupContent = document.querySelector("#popup-content");
            popupContent.textContent = `Nous vous confirmons votre réservation pour ${details.covers} personne(s) le ${date} à ${details.time}.`;

            // Afficher la popup et l'overlay
            popup.style.display = "block";
            overlay.style.display = "block";

            // Enregistrer l'état dans localStorage
            localStorage.setItem("reservationPopup", JSON.stringify(details));
            console.log("Popup affichée et état sauvegardé.");
        } else {
            console.error("Popup ou overlay introuvable.");
        }
    }

    // Vérifiez si l'état de la popup est sauvegardé
    const savedDetails = localStorage.getItem("reservationPopup");
    if (savedDetails) {
        const details = JSON.parse(savedDetails);
        showPopup(details);
    }

    // Bouton "Réserver" pour afficher la popup
    const buttonReservation = document.getElementById("buttonReservation");
    if (buttonReservation) {
        buttonReservation.addEventListener("click", function (event) {
            // Vérification des champs requis
            const covers = document.getElementById("covers").value;
            const date = document.getElementById("date").value;
            const time = document.getElementById("selected_time").value;

            if (!covers || !date || !time) {
                event.preventDefault(); // Bloque l'envoi si les champs ne sont pas remplis
                alert("Veuillez remplir tous les champs obligatoires.");
                return; // Sort de la fonction
            }

            // Affiche la popup après validation
            showPopup({ covers, date, time });
        });
    } else {
        console.error("Bouton Réserver introuvable.");
    }

    // Fermer la popup via le bouton "Fermer"
    document.addEventListener("click", function (event) {
        if (event.target.id === "closePopup") {
            const popup = document.getElementById("reservationConfirmation");
            const overlay = document.getElementById("popupOverlay");

            if (popup && overlay) {
                popup.style.display = "none";
                overlay.style.display = "none";

                // Supprimer l'état de la popup dans localStorage
                localStorage.removeItem("reservationPopup");
                console.log("Popup fermée par le client et état supprimé.");
            }
        }
    });
});


//fermer et ouvrir 

document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner tous les titres de section
    const sectionTitles = document.querySelectorAll(".section-title");

    // Ajouter un événement de clic à chaque titre
    sectionTitles.forEach(function (title) {
        title.addEventListener("click", function () {
            const sectionId = title.getAttribute("data-toggle");
            const sectionContent = document.getElementById(sectionId);

            if (sectionContent) {
                // Basculer l'affichage de la section
                const isVisible = sectionContent.style.display === "block";
                sectionContent.style.display = isVisible ? "none" : "block";
            }
        });
    });
});


// Sélectionner les boutons
const buttons = document.querySelectorAll('#midi-button, #soir-button');

// Ajouter un écouteur d'événements à chaque bouton
buttons.forEach((button) => {
    button.addEventListener('click', () => {
        // Supprimer la classe "active" de tous les boutons
        buttons.forEach((btn) => btn.classList.remove('active'));

        // Ajouter la classe "active" au bouton cliqué
        button.classList.add('active');
    });
});


// Sélectionner tous les boutons horaires
const hourButtons = document.querySelectorAll('.hour-button');

// Ajouter un événement de clic à chaque bouton
hourButtons.forEach((button) => {
    button.addEventListener('click', () => {
        // Supprimer la classe "active" de tous les boutons
        hourButtons.forEach((btn) => btn.classList.remove('active'));

        // Ajouter la classe "active" au bouton cliqué
        button.classList.add('active');
    });
});




