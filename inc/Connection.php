<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* ============================================================================
   CONFIGURATION BASE DE DONNÉES
   ----------------------------------------------------------------------------
   ⚠️ À RENSEIGNER avec les infos de TA base MySQL IONOS.
   Où les trouver : espace IONOS → « Bases de données MySQL » → ta base.
   IONOS te donne : un HÔTE (ex. db5xxxxxxxx.hosting-data.io — PAS "localhost"),
   un UTILISATEUR (ex. dboxxxxxxxx), un MOT DE PASSE (celui que tu as défini),
   et le NOM de la base (ex. dbs15826648).
   ============================================================================ */
$DB_HOST = "localhost";        // ← HÔTE MySQL IONOS (souvent dbXXXX.hosting-data.io)
$DB_USER = "root";             // ← UTILISATEUR MySQL IONOS
$DB_PASS = "";                 // ← MOT DE PASSE MySQL IONOS
$DB_NAME = "dbs15826648";      // ← NOM de la base IONOS

if (isset($_SESSION["sel_lan"])) {
    $currentLang = $_SESSION["sel_lan"];
    include_once "languages/{$currentLang}.php";
}

// On gère les erreurs nous-mêmes (message clair au lieu d'un 500 muet)
mysqli_report(MYSQLI_REPORT_OFF);
$dating = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($dating->connect_errno) {
    http_response_code(500);
    die(
        '<div style="font-family:system-ui,sans-serif;max-width:640px;margin:60px auto;'
        . 'padding:28px;border:1px solid #ECE7DF;border-radius:16px;color:#1F1A16;background:#fff">'
        . '<h2 style="margin:0 0 10px">Connexion à la base de données impossible</h2>'
        . '<p style="color:#6B645C;margin:0 0 14px">Vérifiez les identifiants dans '
        . '<code>inc/Connection.php</code> (hôte, utilisateur, mot de passe, nom de base) '
        . 'depuis votre espace IONOS, et que la base a bien été importée.</p>'
        . '<p style="color:#9A938A;font-size:.85rem;margin:0">Détail technique : '
        . htmlspecialchars($dating->connect_error) . '</p></div>'
    );
}
$dating->set_charset("utf8mb4");

// Si la base est connectée mais vide (tables absentes), message clair au lieu d'un 500
$res_set = @$dating->query("SELECT * FROM `tbl_setting`");
if ($res_set === false) {
    http_response_code(500);
    die(
        '<div style="font-family:system-ui,sans-serif;max-width:640px;margin:60px auto;'
        . 'padding:28px;border:1px solid #ECE7DF;border-radius:16px;color:#1F1A16;background:#fff">'
        . '<h2 style="margin:0 0 10px">Base de données vide</h2>'
        . '<p style="color:#6B645C;margin:0">La connexion fonctionne, mais les tables sont absentes. '
        . 'Importez votre fichier SQL (Gomeet) dans la base <code>' . htmlspecialchars($DB_NAME)
        . '</code> via phpMyAdmin (IONOS).</p></div>'
    );
}
$set    = $res_set->fetch_assoc();
$prints = ($r_meet = @$dating->query("select * from tbl_meet")) ? $r_meet->fetch_assoc() : null;
$apiKey = $set['map_key'] ?? '';

if (isset($_SESSION["stype"]) && $_SESSION["stype"] == 'Staff') {
    $sdata = $dating->query("SELECT * FROM `tbl_manager` where email='" . $_SESSION['datingname'] . "'")->fetch_assoc();
    $interest_per     = explode(',', $sdata['interest']);
    $page_per         = explode(',', $sdata['page']);
    $faq_per          = explode(',', $sdata['faq']);
    $plist_per        = explode(',', $sdata['plist']);
    $language_per     = explode(',', $sdata['language']);
    $payout_per       = explode(',', $sdata['payout']);
    $religion_per     = explode(',', $sdata['religion']);
    $gift_per         = explode(',', $sdata['gift']);
    $rgoal_per        = explode(',', $sdata['rgoal']);
    $plan_per         = explode(',', $sdata['plan']);
    $package_per      = explode(',', $sdata['package']);
    $ulist_per        = explode(',', $sdata['ulist']);
    $fakeuser_per     = explode(',', $sdata['fakeuser']);
    $report_per       = explode(',', $sdata['report']);
    $notification_per = explode(',', $sdata['notification']);
    $wallet_per       = explode(',', $sdata['wallet']);
    $coin_per         = explode(',', $sdata['coin']);
}
?>
