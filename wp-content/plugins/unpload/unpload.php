<?php
/*
Plugin Name: WP PDF Download
Description: Plugin pour télécharger des PDF .
Version: 1.0
Author:Noussaïba, Melinda, Evan

*/

// Ajouter les styles CSS au frontend
function wppdf_enqueue_styles() {
    wp_enqueue_style('wppdf-styles', plugin_dir_url(__FILE__) . 'css/style.css');
}
add_action('wp_enqueue_scripts', 'wppdf_enqueue_styles');

// Ajouter une page d'administration pour télécharger des fichiers PDF
function wppdf_add_admin_menu() {
    add_menu_page(
        'Téléchargement Carte',
        'Téléchargement Carte',
        'manage_options',
        'wppdf_download',
        'wppdf_admin_page',
        'dashicons-media-document',
        20
    );
}
add_action('admin_menu', 'wppdf_add_admin_menu');

// Interface backend pour gérer le fichier PDF
function wppdf_admin_page() {
    if (isset($_POST['wppdf_submit'])) {
        if (!empty($_FILES['wppdf_file']['name'])) {
            $uploaded_file = wp_upload_bits(
                $_FILES['wppdf_file']['name'],
                null,
                file_get_contents($_FILES['wppdf_file']['tmp_name'])
            );

            if (!$uploaded_file['error']) {
                update_option('wppdf_download_file_url', $uploaded_file['url']);
                echo '<div class="notice notice-success is-dismissible"><p>Fichier PDF mis à jour avec succès !</p></div>';
            } else {
                echo '<div class="notice notice-error"><p>Erreur lors de l\'upload du fichier PDF.</p></div>';
            }
        }
    }

    $current_file = get_option('wppdf_download_file_url', '');
    ?>
    <div class="wrap">
        <h1>Télécharger un PDF</h1>
        <form method="post" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="wppdf_file">Fichier PDF actuel :</label></th>
                    <td>
                        <?php if ($current_file): ?>
                            <p><a href="<?php echo esc_url($current_file); ?>" target="_blank">Voir le PDF actuel</a></p>
                        <?php else: ?>
                            <p>Aucun fichier PDF sélectionné.</p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wppdf_file">Nouveau fichier PDF :</label></th>
                    <td>
                        <input type="file" name="wppdf_file" id="wppdf_file" accept="application/pdf" required>
                    </td>
                </tr>
            </table>
            <?php submit_button('Mettre à jour le PDF', 'primary', 'wppdf_submit'); ?>
        </form>
    </div>
    <?php
}

// Shortcode pour afficher le bouton de téléchargement avec le design
function wppdf_download_button_shortcode() {
    $file_url = get_option('wppdf_download_file_url', '');

    if (!$file_url) {
        return '<p>Aucun fichier PDF disponible pour le téléchargement.</p>';
    }

    ob_start();
    ?>
    <div class="wppdf-container">
    <h6 class="wppdf-title">Envie de partager<br>notre carte ?</h6>

    <a href="<?php echo esc_url($file_url); ?>" download class="wppdf-download-link">
        <div class="wppdf-download-button">
            <span class="wppdf-download-text">Télécharger</span>
            <svg class="wppdf-download-icon" width="40" height="40" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.375 25.5088V44.625H44.625V25.5" stroke="#5B7D76" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M35.0625 24.4375L25.5 34L15.9375 24.4375" stroke="#5B7D76" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25.4922 6.375V34" stroke="#5B7D76" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </a>
</div>
    <?php
    return ob_get_clean();
}
add_shortcode('wppdf_download_button', 'wppdf_download_button_shortcode');


function wppdf_ajouter_polices() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Circe:wght@400;500&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'wppdf_ajouter_polices' );


function wppdf_enqueue_admin_styles($hook) {
    // Vérifie que le CSS est chargé uniquement sur la page de votre plugin
    if ($hook !== 'toplevel_page_wppdf_download') {
        return;
    }

    // Charger le fichier CSS spécifique à l'administration
    wp_enqueue_style('wppdf-admin-styles', plugin_dir_url(__FILE__) . 'css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'wppdf_enqueue_admin_styles');
