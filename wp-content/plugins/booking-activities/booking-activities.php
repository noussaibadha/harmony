<?php
/**
 * Plugin Name: Plugin Reservation test test
 * Description: Plugin de réservation.
 * Version: 1.0
 * Author: Noussaïba, Melindav Evan
 */

// Empêche l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// Fonction pour ajouter une page d'administration pour afficher les réservations
function booking_activities_add_admin_page() {
    add_menu_page(
        'Réservations', 
        'Réservations', 
        'manage_options', 
        'booking_activities_reservations', 
        'booking_activities_display_reservations', 
        'dashicons-list-view', 
        30
    );
}
add_action('admin_menu', 'booking_activities_add_admin_page');

// Ajouter un sous-menu "Paramètres"
function booking_activities_add_settings_submenu() {
    add_submenu_page(
        'booking_activities_reservations', // Parent menu
        'Paramètres', // Titre de la page
        'Paramètres', // Titre du menu
        'manage_options', // Capacité requise pour voir cette page
        'booking_activities_settings', // Identifiant unique pour cette page
        'booking_activities_settings_page' // Fonction de rappel pour afficher la page
    );
}
add_action('admin_menu', 'booking_activities_add_settings_submenu');

// Fonction pour vérifier et créer la table des réservations si elle n'existe pas
function booking_activities_create_reservation_table() {
    global $wpdb;

    // Nom de la table des réservations
    $table_name = $wpdb->prefix . 'reservations';

    // Vérifier si la table existe déjà
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id INT(11) NOT NULL AUTO_INCREMENT,
            covers INT(11) NOT NULL,
            date DATE NOT NULL,
            time TIME NOT NULL,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            postal_code VARCHAR(255) NOT NULL,
            comments TEXT,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
register_activation_hook(__FILE__, 'booking_activities_create_reservation_table');

// Fonction pour afficher la liste des réservations
function booking_activities_display_reservations() {
    global $wpdb;

    // Nom de la table des réservations
    $table_name = $wpdb->prefix . 'reservations';

    // Vérifier si une suppression a été demandée via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id'])) {
        $reservation_id = intval($_POST['id']);
        $deleted = $wpdb->delete($table_name, ['id' => $reservation_id]);

        if ($deleted !== false) {
            echo '<div class="notice notice-success is-dismissible"><p>Réservation supprimée avec succès.</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Erreur lors de la suppression de la réservation.</p></div>';
        }
    }

    // Récupérer toutes les réservations
    $reservations = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap">';
    echo '<h1>Liste des réservations</h1>';

    if ($reservations) {
        echo '<table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de couverts</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Code Postal</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>';

        // Afficher les réservations dans le tableau
        foreach ($reservations as $reservation) {
            echo '<tr>';
            echo '<td>' . $reservation->id . '</td>';
            echo '<td>' . $reservation->covers . '</td>';
            echo '<td>' . $reservation->date . '</td>';
            echo '<td>' . $reservation->time . '</td>';
            echo '<td>' . $reservation->first_name . ' ' . $reservation->last_name . '</td>';
            echo '<td>' . $reservation->phone . '</td>';
            echo '<td>' . $reservation->email . '</td>';
            echo '<td>' . $reservation->postal_code . '</td>';
            echo '<td>' . $reservation->comments . '</td>';
            echo '<td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="' . intval($reservation->id) . '">
                    <button type="submit" class="button button-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette réservation ?\')">
                        Supprimer
                    </button>
                </form>
            </td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>Aucune réservation effectuée.</p>';
    }
    echo '</div>';
}



// Fonction pour afficher le formulaire de réservation via un shortcode
function booking_activities_reservation_form_shortcode() {
    ob_start();
    include('view/reservation-form.php'); 
    return ob_get_clean(); 
}
add_shortcode('booking_form', 'booking_activities_reservation_form_shortcode');


//Horaire


// Fonction AJAX pour gérer la réservation
function booking_activities_handle_reservation() {
    // Sécuriser l'input avec un nonce si nécessaire
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'booking_reservation_nonce' ) ) {
        wp_send_json_error( ['message' => 'Nonce verification failed.'] );
    }

    // Récupérer l'heure depuis la requête AJAX
    $hour = isset($_POST['hour']) ? sanitize_text_field($_POST['hour']) : '';

    if ( ! $hour ) {
        wp_send_json_error(['message' => 'Aucune heure sélectionnée.']);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'reservations';

    // Enregistrer la réservation dans la table wp_reservations
    $result = $wpdb->insert($table_name, [
        'hour' => $hour,
        'user_id' => get_current_user_id(), // Si l'utilisateur est connecté
    ]);

    if ($result) {
        wp_send_json_success(['message' => 'Réservation enregistrée']);
    } else {
        wp_send_json_error(['message' => 'Erreur lors de l\'enregistrement de la réservation.']);
    }
}

add_action('wp_ajax_booking_reservation', 'booking_activities_handle_reservation'); // Utilisateurs connectés
add_action('wp_ajax_nopriv_booking_reservation', 'booking_activities_handle_reservation'); // Utilisateurs non connectés




if (isset($_POST['save_settings'])) {
    // Récupérer les horaires du formulaire
    $opening_hours = isset($_POST['opening_hours']) ? $_POST['opening_hours'] : [];

    // Sauvegarder les horaires dans la base de données
    update_option('booking_activities_opening_hours', $opening_hours);
}

function booking_activities_settings_page() {
    // Récupérer les horaires sauvegardés (séparés en midi et soir)
    $opening_hours = get_option('booking_activities_opening_hours', [
        'midi' => [],  // Horaires du midi
        'soir' => []   // Horaires du soir
    ]);

    // Traitement du formulaire lors de la soumission pour ajouter des horaires
    if (isset($_POST['save_midi_hours'])) {
        // Récupérer les horaires du midi
        $new_midi_hours = isset($_POST['midi_hours']) ? explode(',', sanitize_text_field($_POST['midi_hours'])) : [];

        // Fusionner les nouveaux horaires avec les horaires existants (ajout sans écraser)
        $opening_hours['midi'] = array_merge($opening_hours['midi'], array_map('trim', $new_midi_hours)); 

        // Sauvegarder dans la base de données
        update_option('booking_activities_opening_hours', $opening_hours);

        echo '<div class="updated"><p>Horaires du midi ajoutés et sauvegardés.</p></div>';
    }

    if (isset($_POST['save_soir_hours'])) {
        // Récupérer les horaires du soir
        $new_soir_hours = isset($_POST['soir_hours']) ? explode(',', sanitize_text_field($_POST['soir_hours'])) : [];

        // Fusionner les nouveaux horaires avec les horaires existants (ajout sans écraser)
        $opening_hours['soir'] = array_merge($opening_hours['soir'], array_map('trim', $new_soir_hours));

        // Sauvegarder dans la base de données
        update_option('booking_activities_opening_hours', $opening_hours);

        echo '<div class="updated"><p>Horaires du soir ajoutés et sauvegardés.</p></div>';
    }

    // Traitement de la suppression d'un horaire
    if (isset($_POST['delete_hour'])) {
        $hour_to_delete = isset($_POST['hour_to_delete']) ? sanitize_text_field($_POST['hour_to_delete']) : '';
        $time_of_day = isset($_POST['time_of_day']) ? sanitize_text_field($_POST['time_of_day']) : ''; // 'midi' ou 'soir'

        if ($hour_to_delete && in_array($hour_to_delete, $opening_hours[$time_of_day])) {
            // Supprimer l'horaire du tableau
            $opening_hours[$time_of_day] = array_diff($opening_hours[$time_of_day], [$hour_to_delete]);

            // Sauvegarder la mise à jour dans la base de données
            update_option('booking_activities_opening_hours', $opening_hours);

            echo '<div class="updated"><p>Horaire supprimé avec succès.</p></div>';
        } else {
            echo '<div class="error"><p>Horaire non trouvé ou non valide.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Paramètres des horaires de réservation</h1>

        <!-- Formulaire pour ajouter les horaires du midi -->
        <form method="POST" action="">
            <h2>Ajouter des horaires du Midi</h2>
            <p>Entrez les horaires de midi (séparés par des virgules) :</p>
            <input type="text" name="midi_hours" value="<?php echo implode(', ', $opening_hours['midi']); ?>" placeholder="Ex : 12:00, 12:30, 13:00" required>
            
            <p><button type="submit" name="save_midi_hours" class="button button-primary">Enregistrer les horaires du midi</button></p>
        </form>

        <!-- Formulaire pour ajouter les horaires du soir -->
        <form method="POST" action="">
            <h2>Ajouter des horaires du Soir</h2>
            <p>Entrez les horaires du soir (séparés par des virgules) :</p>
            <input type="text" name="soir_hours" value="<?php echo implode(', ', $opening_hours['soir']); ?>" placeholder="Ex : 18:00, 18:30, 19:00" required>

            <p><button type="submit" name="save_soir_hours" class="button button-primary">Enregistrer les horaires du soir</button></p>
        </form>

        <h2>Horaires enregistrés :</h2>

        <h3>Midi</h3>
        <ul>
            <?php
            if (!empty($opening_hours['midi'])) {
                foreach ($opening_hours['midi'] as $hour) {
                    // Pour chaque horaire, on affiche un bouton "Supprimer"
                    ?>
                    <li>
                        <?php echo esc_html($hour); ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="hour_to_delete" value="<?php echo esc_attr($hour); ?>">
                            <input type="hidden" name="time_of_day" value="midi">
                            <button type="submit" name="delete_hour" class="button button-secondary">Supprimer</button>
                        </form>
                    </li>
                    <?php
                }
            } else {
                echo '<li>Aucun horaire enregistré pour le midi.</li>';
            }
            ?>
        </ul>

        <h3>Soir</h3>
        <ul>
            <?php
            if (!empty($opening_hours['soir'])) {
                foreach ($opening_hours['soir'] as $hour) {
                    // Pour chaque horaire, on affiche un bouton "Supprimer"
                    ?>
                    <li>
                        <?php echo esc_html($hour); ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="hour_to_delete" value="<?php echo esc_attr($hour); ?>">
                            <input type="hidden" name="time_of_day" value="soir">
                            <button type="submit" name="delete_hour" class="button button-secondary">Supprimer</button>
                        </form>
                    </li>
                    <?php
                }
            } else {
                echo '<li>Aucun horaire enregistré pour le soir.</li>';
            }
            ?>
        </ul>
    </div>
    <?php
}




function booking_activities_display_booking_hours() {
    // Récupérer les horaires sauvegardés
    $opening_hours = get_option('booking_activities_opening_hours', []);

    if (empty($opening_hours)) {
        return '<p>Aucun horaire disponible pour la réservation.</p>';
    }

    // Commencer à afficher les horaires sous forme de boutons
    $output = '<div class="booking-hours-container">';
    foreach ($opening_hours as $hour) {
        $output .= '<button type="button" class="hour-button" name="time" value="' . esc_attr($hour) . '">' . esc_html($hour) . '</button>';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode('booking_hours', 'booking_activities_display_booking_hours');




// Fonction pour charger les scripts et styles
function booking_activities_enqueue_assets() {
    wp_enqueue_style('booking-activities-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('booking-activities-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), null, true);
    wp_enqueue_style('tailwind-cdn', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css');
    

    // Générer un nonce pour AJAX
    wp_localize_script('booking-activities-script', 'booking_reservation_nonce', [
        'nonce' => wp_create_nonce('booking_reservation_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'booking_activities_enqueue_assets');



function booking_activities_save_reservation($covers, $date, $time, $firstNameBooking, $lastNameBooking, $phone, $email, $postalCode, $comments) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations';

    // Insérer les données dans la table
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'covers' => $covers,
            'date' => $date,
            'time' => $time,  // Enregistrer l'heure sélectionnée
            'first_name' => $firstNameBooking,
            'last_name' => $lastNameBooking,
            'phone' => $phone,
            'email' => $email,
            'postal_code' => $postalCode,
            'comments' => $comments
        )
    );

    // Vérifier si l'insertion a réussi
    if ($inserted === false) {
        
        var_dump($wpdb->last_error); // Affiche l'erreur SQL
    } else {
        

        // Appeler la fonction pour envoyer les emails
        send_reservation_email($email, $covers, $date, $time, $firstNameBooking, $lastNameBooking, $comments);
    }
}




function send_reservation_email($email, $covers, $date, $time, $firstNameBooking, $lastNameBooking, $comments) {
    $admin_email = get_option('admin_email'); // Adresse email de l'administrateur
    $subject_client = "Confirmation de votre réservation au restaurant L’Harmony";
    $subject_admin = "Nouvelle réservation pour le restaurant L’Harmony";

    // Message pour le client
   $message_client = '
    <div style=" padding: 15px; border-radius: 5px; font-family: Arial, sans-serif; font-size: 14px; line-height: 1.2;">
        <p style="margin: 0; text-align: center;"><strong>Bonjour ' . $firstNameBooking . ' ' . $lastNameBooking . ',</strong></p>

        <p style="margin: 10px 0;">Nous sommes ravis de confirmer votre réservation au restaurant <strong>L’Harmony</strong> :</p>

        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="margin-bottom: 3px;">• <strong>Date :</strong> ' . $date . '</li>
            <li style="margin-bottom: 3px;">• <strong>Heure :</strong> ' . $time . '</li>
            <li style="margin-bottom: 3px;">• <strong>Nom de la réservation :</strong> ' . $firstNameBooking . ' ' . $lastNameBooking . '</li>
            <li style="margin-bottom: 3px;">• <strong>Nombre de convives :</strong> ' . $covers . ' personnes</li>
            <li style="margin-bottom: 3px;">• <strong>Contact :</strong> ' . $email . '</li>
            <li style="margin-bottom: 3px;">• <strong>Commentaires, préférences alimentaires :</strong> ' . $comments . '</li>
        </ul>

        <p style="margin: 10px 0;">Nous vous remercions pour votre confiance et sommes impatients de vous accueillir.</p>

        <p style="margin: 0;"><strong>Adresse :</strong> 89 Rue Charles de Gaulle, 78730 Saint-Arnoult-en-Yvelines</p>
        <p style="margin: 0;"><strong>Parking :</strong> Des places sont disponibles à proximité.</p>
        <p style="margin: 0;"><strong>Contact en cas de modification ou annulation :</strong> 01 30 46 12 14</p>


        <p style="margin: 10px 0 0; text-align: center;">À très bientôt,<br><strong>L’équipe de L’Harmony</strong></p>
    </div>
';


    // Message pour l'administrateur
    $message_admin = "
        Bonjour,

        Une nouvelle réservation a été effectuée pour le restaurant :

        Date : $date
        Heure : $time
        Nom de la réservation : $firstNameBooking $lastNameBooking
        Nombre de convives : $covers personnes
        Contact : $email
        Commentaires, préférences alimentaires : $comments

    ";

    $headers = ['Content-Type: text/html; charset=UTF-8'];

    // Envoi au client
    $client_sent = wp_mail($email, $subject_client, nl2br($message_client), $headers);

    // Envoi à l'administrateur
    $admin_sent = wp_mail($admin_email, $subject_admin, nl2br($message_admin), $headers);

    if (!$client_sent || !$admin_sent) {
        error_log("Erreur d'envoi d'email : wp_mail a échoué.");
    }
}
?>
