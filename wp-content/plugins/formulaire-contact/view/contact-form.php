
<div class="container mx-auto flex justify-center items-center h-screen">
    <form id="contactForm" method="POST" class="form-custom-width bg-white space-y-6">
        <h5 class="text-center text-4xl font-bold text-color-green">Formulaire de contact</h5>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nom -->
            <input
            type="text"
            name="lastNameContact"
            id="lastNameContact"
            placeholder="Nom"
            class=" h-14 p-4 color-green-clair text-white placeholder-white rounded-md"
            required
            />

            <!-- Prénom -->
            <input
            type="text"
            name="firstNameContact"
            id="firstNameContact"
            placeholder="Prénom"
            class=" h-14 p-4 color-green-clair text-white placeholder-white rounded-md focus:outline-none focus:ring-2 focus:ring-[#5B7D76] focus:ring-opacity-50"
            required
            />

            <!-- Téléphone -->
            <input
            type="tel"
            name="phone"
            id="phone"
            placeholder="Téléphone"
            class=" h-14 p-4 color-green-clair text-white placeholder-white rounded-md focus:outline-none focus:ring-2 focus:ring-[#5B7D76] focus:ring-opacity-50"
            required
            />

            <!-- Email -->
            <input
            type="email"
            name="email"
            id="email"
            placeholder="Adresse e-mail"
            class=" h-14 p-4 color-green-clair text-white placeholder-white rounded-md focus:outline-none focus:ring-2 focus:ring-[#5B7D76] focus:ring-opacity-50"
            required
            />
        </div>

        <!-- Message -->
        <textarea
            name="message"
            id="message"
            placeholder="Message"
            class="w-full h-64 p-4 color-green-clair text-white placeholder-white rounded-md focus:outline-none focus:ring-2 focus:ring-[#5B7D76] focus:ring-opacity-50"
        ></textarea>


        <button class="border-2 color-green text-color-white rounded-full mx-auto flex items-center justify-center transition duration-300 hover-white" style="font-size: 1.5rem !important;" type="submit" name="submit_contact">Envoyer</button>
    </form>
</div>


<?php
// Traitement du formulaire
if (isset($_POST['submit_contact'])) {
    // Récupérer les données soumises et les sécuriser
    $firstNameContact = sanitize_text_field($_POST['firstNameContact']);
    $lastNameContact = sanitize_text_field($_POST['lastNameContact']);
    $phone = sanitize_text_field($_POST['phone']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

    // Sauvegarder dans la base de données
    booking_activities_save_contact($firstNameContact, $lastNameContact, $phone, $email, $message);

    // Envoyer l'email
    send_contact_email($firstNameContact, $lastNameContact, $phone, $email, $message);
}


?>
