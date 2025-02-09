<div class="container-page">
<div class="container-bouton flex gap-2 mb-4 justify-center">
    <button id="midi-button" class="border-2 text-color-green rounded-full text-lg flex items-center justify-center transition duration-300 hover-green text-3xl font-circe border-green active" style="width: 20rem; height: 88px;">
        Midi
    </button>
    <button id="soir-button" class="border-2 text-color-green rounded-full px-10 text-lg flex items-center justify-center transition duration-300 hover-green text-3xl font-circe border-green" style="width: 20rem; height: 88px;">
        Soir
    </button>
</div>


    <div class="formulaire-container">
        <h4 class="text-3xl font-bold text-color-green text-center pt-2 font-poppins">RÉSERVATION</h4>
        <form class="p-6"   id="reservationForm" method="POST" action="">
            <!-- Section Nombre de Couverts -->
            <div class="form-section flex items-center justify-between cursor-pointer">
                <div class="flex items-center gap-2" id="couverts-toggle">
                    <span>
                        <svg width="36" height="34" viewBox="0 0 36 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5117 18.9011L3.00464 11.4119C1.66329 10.0653 0.910156 8.24213 0.910156 6.34148C0.910156 4.44084 1.66329 2.61763 3.00464 1.27107L15.5821 13.8127L10.5117 18.9011ZM20.0255 18.2919L32.3521 30.6186L29.8259 33.1448L17.4992 20.8181L5.17256 33.1448L2.64631 30.6186L19.9359 13.3111L19.5776 12.9169C19.2455 12.5872 18.9819 12.195 18.8021 11.763C18.6222 11.3309 18.5297 10.8676 18.5297 10.3996C18.5297 9.93164 18.6222 9.46829 18.8021 9.03626C18.9819 8.60423 19.2455 8.21205 19.5776 7.88232L27.3534 0.0527344L29.0196 1.70107L23.2146 7.5419L24.9346 9.22607L30.7396 3.40315L32.388 5.05148L26.5651 10.8565L28.2492 12.5765L34.0901 6.75357L35.7384 8.43773L27.9088 16.2136C26.5113 17.6111 24.2538 17.6111 22.8742 16.2136L22.4801 15.8552L20.0255 18.2919Z" fill="#5B7D76" />
                        </svg>
                    </span>
                    <h4 class="section-title text-color-green font-medium text-2xl font-poppins ml-4" data-toggle="covers-section">Nombre de couverts</h4>
                </div>
                    <span class="fleche">
                        <svg width="16" height="27" viewBox="0 0 20 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 1.99959L17.6578 15.3484L2 28.6973" stroke="#5B7D76" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
            </div>  
                <div class="section-content" id="covers-section" style="display: none;">
                    <div class="covers-buttons-container flex flex-wrap justify-center gap-2">
                        <!-- Boutons de 1 à 9 pour sélectionner le nombre de couverts -->
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="1">1</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="2">2</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="3">3</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="4">4</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="5">5</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="6">6</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="7">7</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="8">8</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="9">9</button>
                        <button type="button" class="cover-button border-2 hover-green border-green w-16 h-16 rounded-md text-2xl" data-cover="+">+</button>
                    </div>
                    <!-- Champ caché pour stocker la sélection -->
                    <input type="hidden" name="covers" id="covers" required>
                </div>

            
            <span class="block w-full h-0.5 color-green mx-auto my-8"></span>
           

            <!-- Section Date -->
            <div class="form-section flex items-center justify-between cursor-pointer">
                <div class="flex items-center gap-2">
                    <span>
                        <svg width="33" height="37" viewBox="0 0 33 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M29.0417 33.042H3.95833V13.3337H29.0417M23.6667 0.791992V4.37533H9.33333V0.791992H5.75V4.37533H3.95833C1.96958 4.37533 0.375 5.96991 0.375 7.95866V33.042C0.375 33.9924 0.752529 34.9038 1.42453 35.5758C2.09654 36.2478 3.00797 36.6253 3.95833 36.6253H29.0417C29.992 36.6253 30.9035 36.2478 31.5755 35.5758C32.2475 34.9038 32.625 33.9924 32.625 33.042V7.95866C32.625 7.0083 32.2475 6.09687 31.5755 5.42486C30.9035 4.75285 29.992 4.37533 29.0417 4.37533H27.25V0.791992M25.4583 20.5003H16.5V29.4587H25.4583V20.5003Z" fill="#5B7D76" />
                        </svg>
                    </span>
                    <h4 class="section-title text-color-green font-medium text-2xl font-poppins ml-4" data-toggle="date-section">Date</h4>
                </div>
                
                <span class="fleche">
                    <svg width="16" height="27" viewBox="0 0 20 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 1.99959L17.6578 15.3484L2 28.6973" stroke="#5B7D76" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>

            <div class="section-content flex justify-center items-center" id="date-section" style="display: none; height: 60px;">
                <input type="date" name="date" id="date" required class="border border-gray-300 rounded-lg p-2">
            </div>

            <span class="block w-full h-0.5 color-green mx-auto my-8"></span>


            <!-- Section Heure -->
   
            <div class="form-section relative flex items-center justify-between cursor-pointer">

                <div class="flex items-center justify-between gap-2">
                    <span>
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 17C2 18.9698 2.38799 20.9204 3.14181 22.7403C3.89563 24.5601 5.00052 26.2137 6.3934 27.6066C7.78628 28.9995 9.43986 30.1044 11.2597 30.8582C13.0796 31.612 15.0302 32 17 32C18.9698 32 20.9204 31.612 22.7403 30.8582C24.5601 30.1044 26.2137 28.9995 27.6066 27.6066C28.9995 26.2137 30.1044 24.5601 30.8582 22.7403C31.612 20.9204 32 18.9698 32 17C32 13.0218 30.4196 9.20644 27.6066 6.3934C24.7936 3.58035 20.9782 2 17 2C13.0218 2 9.20644 3.58035 6.3934 6.3934C3.58035 9.20644 2 13.0218 2 17Z" stroke="#5B7D76" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17 8.66699V17.0003L22 22.0003" stroke="#5B7D76" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <h4 class="section-title text-color-green font-medium text-2xl font-poppins ml-4" data-toggle="time-section">Heure</h4>
                </div>
                <span class="fleche">
                    <svg width="16" height="27" viewBox="0 0 20 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 1.99959L17.6578 15.3484L2 28.6973" stroke="#5B7D76" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>


            <div class="section-content p-4 font-poppins" id="time-section" style="display: none;">
                <div class="booking-hours-container space-y-8 ">
                <?php

                // Récupérer les horaires enregistrés
                $opening_hours = get_option('booking_activities_opening_hours', []);

                // Vérifier si les horaires sont disponibles
                if (!empty($opening_hours)) {
                    // Affichage des horaires du midi
                    echo '<div id="midi-hours" class="hour-category flex flex-col items-center">';
                    echo '<div class="grid grid-cols-2 gap-4 justify-items-center">';
                    foreach ($opening_hours['midi'] as $hour) {
                        echo '<button type="button" class="hour-button border-2 border-green rounded-lg text-center" style=" height: 2.5rem;" data-hour="' . esc_attr($hour) . '">' . esc_html($hour) . '</button>';
                    }
                    echo '</div>';
                    echo '</div>';

                    // Affichage des horaires du soir
                    echo '<div id="soir-hours" class="hour-category flex flex-col items-center">';
                    echo '<div class="grid grid-cols-2 gap-4 justify-items-center">';
                    foreach ($opening_hours['soir'] as $hour) {
                        echo '<button type="button" class="hour-button border-2 border-green rounded-lg text-center" style="height: 2.5rem;" data-hour="' . esc_attr($hour) . '">' . esc_html($hour) . '</button>';
                    }
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<p class="text-center">Aucun horaire disponible pour la réservation.</p>';
                }
                ?>


                    <!-- Champ caché pour l'heure sélectionnée -->
                    <input type="hidden" name="time" id="selected_time" value="">
                </div>
            </div>


            <span class="block w-full h-0.5 color-green mx-auto my-8"></span>
            

            <!-- Autres champs -->
            <div class="form-section flex items-center justify-between cursor-pointer">
                <div class="flex items-center gap-2">
                    <svg width="36" height="40" viewBox="0 0 36 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.9766 23.4961C25.7474 24.1081 27.3424 24.9609 28.7617 26.0547C30.181 27.1484 31.3919 28.4245 32.3945 29.8828C33.3971 31.3411 34.1654 32.9232 34.6992 34.6289C35.2331 36.3346 35.5 38.125 35.5 40H33C33 37.8646 32.6224 35.8854 31.8672 34.0625C31.112 32.2396 30.0573 30.651 28.7031 29.2969C27.349 27.9427 25.7669 26.8945 23.957 26.1523C22.1471 25.4102 20.1615 25.026 18 25C16.6068 25 15.2656 25.1758 13.9766 25.5273C12.6875 25.8789 11.4896 26.3737 10.3828 27.0117C9.27604 27.6497 8.26693 28.4245 7.35547 29.3359C6.44401 30.2474 5.66927 31.2565 5.03125 32.3633C4.39323 33.4701 3.89193 34.6745 3.52734 35.9766C3.16276 37.2786 2.98698 38.6198 3 40H0.5C0.5 38.125 0.773438 36.3346 1.32031 34.6289C1.86719 32.9232 2.64193 31.3477 3.64453 29.9023C4.64714 28.457 5.85807 27.194 7.27734 26.1133C8.69661 25.0326 10.2917 24.1667 12.0625 23.5156C11.0469 22.9688 10.1354 22.3047 9.32812 21.5234C8.52083 20.7422 7.83724 19.8763 7.27734 18.9258C6.71745 17.9753 6.28125 16.9531 5.96875 15.8594C5.65625 14.7656 5.5 13.6458 5.5 12.5C5.5 10.7682 5.82552 9.14714 6.47656 7.63672C7.1276 6.1263 8.01953 4.79818 9.15234 3.65234C10.2852 2.50651 11.6068 1.61458 13.1172 0.976562C14.6276 0.338542 16.2552 0.0130208 18 0C19.7318 0 21.3529 0.325521 22.8633 0.976562C24.3737 1.6276 25.7018 2.51953 26.8477 3.65234C27.9935 4.78516 28.8854 6.10677 29.5234 7.61719C30.1615 9.1276 30.487 10.7552 30.5 12.5C30.5 13.6458 30.3503 14.7591 30.0508 15.8398C29.7513 16.9206 29.3151 17.9362 28.7422 18.8867C28.1693 19.8372 27.4857 20.7031 26.6914 21.4844C25.8971 22.2656 24.9922 22.9362 23.9766 23.4961ZM8 12.5C8 13.8802 8.26042 15.1758 8.78125 16.3867C9.30208 17.5977 10.0182 18.6523 10.9297 19.5508C11.8411 20.4492 12.9023 21.1654 14.1133 21.6992C15.3242 22.2331 16.6198 22.5 18 22.5C19.3802 22.5 20.6758 22.2396 21.8867 21.7188C23.0977 21.1979 24.1523 20.4818 25.0508 19.5703C25.9492 18.6589 26.6654 17.5977 27.1992 16.3867C27.7331 15.1758 28 13.8802 28 12.5C28 11.1198 27.7396 9.82422 27.2188 8.61328C26.6979 7.40234 25.9818 6.34766 25.0703 5.44922C24.1589 4.55078 23.0977 3.83464 21.8867 3.30078C20.6758 2.76693 19.3802 2.5 18 2.5C16.6198 2.5 15.3242 2.76042 14.1133 3.28125C12.9023 3.80208 11.8477 4.51823 10.9492 5.42969C10.0508 6.34115 9.33464 7.40234 8.80078 8.61328C8.26693 9.82422 8 11.1198 8 12.5Z" fill="#5B7D76"/>
                    </svg>
                    <h4 class="section-title text-color-green font-medium text-2xl font-poppins ml-4" data-toggle="info-section">Coordonnées</h4>
                </div>
                    <span class="fleche">
                        <svg width="16" height="27" viewBox="0 0 20 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 1.99959L17.6578 15.3484L2 28.6973" stroke="#5B7D76" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                
            </div>

            <div class="formulaire-info section-content p-6 rounded-lg" id="info-section" style="display: none;">
                <div class="nom-prenom-booking grid gap-4">
                    <div class="info-form-booking-prenom">
                        <label for="firstNameBooking" class="sr-only">Prénom</label> <!-- Label caché pour accessibilité -->
                        <input type="text" name="firstNameBooking" id="firstNameBooking" required
                            placeholder="Prénom" 
                            class=" block w-full p-2 border border-gray-300 rounded-lg shadow-sm text-white placeholder-white color-green-light focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="info-form-booking-nom">
                        <label for="lastNameBooking" class="sr-only">Nom</label> <!-- Label caché pour accessibilité -->
                        <input type="text" name="lastNameBooking" id="lastNameBooking" required
                            placeholder="Nom"
                            class=" block w-full p-2 border border-gray-300 rounded-lg shadow-sm text-white placeholder-white color-green-light focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>

                <div class="info-form-booking">
                    <label for="phone" class="sr-only">Numéro de téléphone</label> <!-- Label caché -->
                    <input type="tel" name="phone" id="phone" required
                        placeholder="Numéro de téléphone"
                        class=" block w-full p-2 border border-gray-300 rounded-lg shadow-sm text-white placeholder-white color-green-light focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="info-form-booking">
                    <label for="email" class="sr-only">Adresse e-mail</label> <!-- Label caché -->
                    <input type="email" name="email" id="email" required
                        placeholder="Adresse e-mail"
                        class=" block w-full p-2 border border-gray-300 rounded-lg shadow-sm text-white placeholder-white color-green-light focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="info-form-booking">
                    <label for="postalCode" class="sr-only">Code postal</label> <!-- Label caché -->
                    <input type="text" name="postalCode" id="postalCode" required
                        placeholder="Code postal"
                        class=" block w-full p-2 border border-gray-300 rounded-lg shadow-sm text-white placeholder-white color-green-light focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="info-form-booking">
                    <label for="comments" class="sr-only">Commentaires</label> <!-- Label caché -->
                    <textarea name="comments" id="comments" rows="3"
                        placeholder="Commentaires, préférences alimentaires"
                        class=" block w-full p-2 border border-gray-300 rounded-lg shadow-sm text-white placeholder-white color-green-light focus:ring-green-500 focus:border-green-500"></textarea>
                </div>
            </div>

            


              

            <button type="submit" name="submit_reservation" id="buttonReservation" class="border-2 text-color-green rounded-full text-lg w-72 h-20 mx-auto flex items-center justify-center transition duration-300 hover-green mt-10 text-3xl font-circe border-green">Réserver</button>
        </form>
    </div>
</div>

<div id="reservationConfirmation" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="popUp rounded-lg shadow-lg max-w-md w-full p-6 relative">
        <!-- Bouton de fermeture -->
        <button id="closePopup" class="text-gray-500 hover:text-gray-700">
            &times;
        </button>

        <!-- Contenu du popup -->
        <h4 class="text-center text-lg font-bold text-[#5B7D76] mb-4">RÉSERVATION</h4>
        <p class="text-center text-[#5B7D76] text-base font-semibold mb-4">Votre réservation a été confirmée !</p>
        <p id="popup-content" class="text-center text-gray-600 text-sm mb-4"></p>
        <p class="text-center text-gray-600 text-sm mb-6">
            Besoin de modifier votre réservation ou de préciser une préférence ?<br />
            Contactez-nous au <span class="font-semibold text-[#5B7D76]">01 30 46 12 14</span>
        </p>
    </div>
</div>

<!-- Overlay -->
<div id="popupOverlay" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>

<?php



// Traitement du formulaire
if (isset($_POST['submit_reservation'])) {
    // Récupérer les données soumises
    $covers = sanitize_text_field($_POST['covers']);
    $date = sanitize_text_field($_POST['date']);
    $time = isset($_POST['time']) ? sanitize_text_field($_POST['time']) : ''; // Récupérer l'heure sélectionnée
    $firstNameBooking = sanitize_text_field($_POST['firstNameBooking']);
    $lastNameBooking = sanitize_text_field($_POST['lastNameBooking']);
    $phone = sanitize_text_field($_POST['phone']);
    $email = sanitize_email($_POST['email']);
    $postalCode = sanitize_text_field($_POST['postalCode']);
    $comments = sanitize_textarea_field($_POST['comments']);

    // Si une heure est sélectionnée, l'enregistrer dans la base de données
    if (!empty($time)) {
        booking_activities_save_reservation($covers, $date, $time, $firstNameBooking, $lastNameBooking, $phone, $email, $postalCode, $comments);
    } else {
        echo '<p style="color: red;">Veuillez sélectionner une heure pour la réservation.</p>';
    }
}


add_action('wp_mail_failed', function($error) {
    error_log(print_r($error, true)); // Enregistre les erreurs dans le fichier debug.log
});


?>
