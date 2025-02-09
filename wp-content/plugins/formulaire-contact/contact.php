<?php
/**
 * Plugin Name: Formulaire de Contact
 * Description: Plugin de contact simplifié.
 * Version: 1.0
 * Author: Votre Nom
 */

// Empêche l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// Fonction pour ajouter une page d'administration pour afficher les contacts
function contact_activities_add_admin_page() {
    add_menu_page(
        'Contacts',
        'Contacts',
        'manage_options',
        'contact_activities_contacts',
        'contact_activities_display_contacts',
        'dashicons-email',
        30
    );
}
add_action('admin_menu', 'contact_activities_add_admin_page');

// Fonction pour vérifier et créer la table des contacts si elle n'existe pas
function contact_activities_create_contact_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'contact';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        phone VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'contact_activities_create_contact_table');

// Fonction pour afficher la liste des contacts
function contact_activities_display_contacts() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact';
    $contacts = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap">';
    echo '<h1>Liste des Contacts</h1>';

    if ($contacts) {
        echo '<table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($contacts as $contact) {
            echo '<tr>';
            echo '<td>' . esc_html($contact->id) . '</td>';
            echo '<td>' . esc_html($contact->first_name . ' ' . $contact->last_name) . '</td>';
            echo '<td>' . esc_html($contact->phone) . '</td>';
            echo '<td>' . esc_html($contact->email) . '</td>';
            echo '<td>' . esc_html($contact->message) . '</td>';
            echo '<td><a href="' . admin_url('admin-post.php?action=delete_contact&id=' . esc_attr($contact->id)) . '" onclick="return confirm(\'Supprimer ce contact ?\');">Supprimer</a></td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>Aucun contact enregistré.</p>';
    }
    echo '</div>';
}

// Gérer la suppression d'un contact
function contact_activities_delete_contact() {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        global $wpdb;
        $contact_id = intval($_GET['id']);
        $table_name = $wpdb->prefix . 'contact';
        $wpdb->delete($table_name, ['id' => $contact_id]);

        wp_redirect(admin_url('admin.php?page=contact_activities_contacts'));
        exit;
    }
}
add_action('admin_post_delete_contact', 'contact_activities_delete_contact');

// Fonction pour afficher le formulaire de contact via un shortcode
function contact_activities_contact_form_shortcode() {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'view/contact-form.php');
    return ob_get_clean();
}
add_shortcode('contact_form', 'contact_activities_contact_form_shortcode');

// Fonction AJAX pour gérer l'envoi du formulaire de contact
function contact_activities_handle_contact() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'contact_form_nonce')) {
        wp_send_json_error(['message' => 'Nonce verification failed.']);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'contact';

    $data = [
        'first_name' => sanitize_text_field($_POST['first_name']),
        'last_name'  => sanitize_text_field($_POST['last_name']),
        'phone'      => sanitize_text_field($_POST['phone']),
        'email'      => sanitize_email($_POST['email']),
        'message'    => sanitize_textarea_field($_POST['message']),
    ];

    $result = $wpdb->insert($table_name, $data);

    if ($result) {
        wp_send_json_success(['message' => 'Message envoyé avec succès !']);
    } else {
        wp_send_json_error(['message' => 'Erreur lors de l\'enregistrement du message.']);
    }
}

add_action('wp_ajax_contact_form', 'contact_activities_handle_contact');
add_action('wp_ajax_nopriv_contact_form', 'contact_activities_handle_contact');



// Fonction pour sauvegarder les données dans la base de données
function booking_activities_save_contact($firstNameContact, $lastNameContact, $phone, $email, $message) {
    global $wpdb;

    // Définir le nom de la table
    $table_name = $wpdb->prefix . 'contact';

    // Insérer les données dans la table
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'first_name' => $firstNameContact,
            'last_name' => $lastNameContact,
            'phone' => $phone,
            'email' => $email,
            'message' => $message
        )
    );

    // Vérifier si l'insertion a réussi
    if ($inserted === false) {
        echo '<p style="color: red;">Erreur lors de l\'enregistrement du message.</p>';
        var_dump($wpdb->last_error);  // Affiche l'erreur SQL
    } else {
        echo '<p></p>';
    }
}

// Fonction pour envoyer un e-mail
function send_contact_email($firstNameContact, $lastNameContact, $phone, $email, $message) {
    $admin_email = get_option('admin_email'); // Adresse e-mail de l'administrateur
    $subject = "Nouveau message de contact de $firstNameContact $lastNameContact";
    $body = "
      <p>Bonjour,</p>

      <p>Un nouveau message a été envoyé via le formulaire de contact de <strong>L’Harmony</strong> :</p>

      <p><strong>Nom :</strong> $firstNameContact</p>
      <p><strong>Prénom :</strong> $lastNameContact</p>
      <p><strong>Email :</strong> $email</p>
      <p><strong>Téléphone :</strong> $phone</p>
      <p><strong>Message :</strong></p>
      <p>$message</p>

      <p>Veuillez répondre à cette demande dès que possible pour offrir un suivi rapide et personnalisé.</p>
    ";
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    // Envoyer l'email
    $mail_sent = wp_mail($admin_email, $subject, $body, $headers);


}


// Fonction pour charger les scripts et styles
function contact_activities_enqueue_assets() {
    wp_enqueue_style('contact-activities-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('contact-activities-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), null, true);

    // Vérifier si Tailwind n'est pas déjà chargé
    if (!wp_style_is('tailwind-cdn', 'enqueued')) {
        wp_enqueue_style('tailwind-cdn', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css');
    }

    wp_localize_script('contact-activities-script', 'contact_form_nonce', [
        'nonce' => wp_create_nonce('contact_form_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'contact_activities_enqueue_assets');

?>
