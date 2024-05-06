<?php

// Passwort für den Zugriff
$valid_password = '3453grvbf23tgbr';

// Überprüfen, ob das Passwort mit dem übergebenen Passwort übereinstimmt
if (!isset($_GET['pw']) || $_GET['pw'] !== $valid_password) {
    die();
}

// Überprüfen, ob der Wochentag Dienstag oder Freitag ist
if (date('N') != 2 && date('N') != 5) { // 2 steht für Dienstag, 5 steht für Freitag
    die();
}

// Überprüfen, ob die aktuelle Uhrzeit zwischen 20 und 23 Uhr liegt
$current_hour = date('G');
if ($current_hour < 20 || $current_hour >= 23) {
    die();
}

// URL zur API
$url = 'https://www.eurojackpot.de/wlinfo/WL_InfoService?client=jsn&gruppe=ZahlenUndQuoten&ewGewsum=ja&historie=ja&spielart=EJ&adg=ja&lang=de';

// JSON von der URL abrufen
$json = file_get_contents($url);

// JSON in ein assoziatives Array umwandeln
$data = json_decode($json, true);


// Verbindung zur Datenbank herstellen (Angaben anpassen)
$db_host = 'clevertipp.com';
$db_name = 'd0404e94';
$db_user = 'd0404e94';
$db_pass = 'FYDsWuHhaPRQVB3HcYzS';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $e->getMessage());
}

// Datum der Ziehung extrahieren
$draw_date = $data['head']['datum'];

// Überprüfen, ob bereits ein Eintrag für das Datum vorhanden ist
$stmt = $pdo->prepare("SELECT COUNT(*) FROM lottery_numbers WHERE draw_date = :draw_date");
$stmt->bindParam(':draw_date', $draw_date);
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count > 0) {
    die();
}

// SQL-Abfrage zum Einfügen der Daten in die Tabelle
$sql = "INSERT INTO lottery_numbers (draw_date, num1, num2, num3, num4, num5, num6, num7, spieleinsatz, winner1_count, winner1_amount, winner2_count, winner2_amount, winner3_count, winner3_amount, winner4_count, winner4_amount, winner5_count, winner5_amount, winner6_count, winner6_amount, winner7_count, winner7_amount, winner8_count, winner8_amount, winner9_count, winner9_amount, winner10_count, winner10_amount, winner11_count, winner11_amount, winner12_count, winner12_amount) VALUES (:draw_date, :num1, :num2, :num3, :num4, :num5, :num6, :num7, :spieleinsatz, :winner1_count, :winner1_amount, :winner2_count, :winner2_amount, :winner3_count, :winner3_amount, :winner4_count, :winner4_amount, :winner5_count, :winner5_amount, :winner6_count, :winner6_amount, :winner7_count, :winner7_amount, :winner8_count, :winner8_amount, :winner9_count, :winner9_amount, :winner10_count, :winner10_amount, :winner11_count, :winner11_amount, :winner12_count, :winner12_amount)";

// Daten für die SQL-Abfrage vorbereiten
$draw_date = $data['head']['datum'];
$num1 = $data['zahlen']['hauptlotterie']['ziehungen'][0]['zahlen'][0];
$num2 = $data['zahlen']['hauptlotterie']['ziehungen'][0]['zahlen'][1];
$num3 = $data['zahlen']['hauptlotterie']['ziehungen'][0]['zahlen'][2];
$num4 = $data['zahlen']['hauptlotterie']['ziehungen'][0]['zahlen'][3];
$num5 = $data['zahlen']['hauptlotterie']['ziehungen'][0]['zahlen'][4];
$num6 = $data['zahlen']['hauptlotterie']['ziehungen'][1]['zahlen'][0];
$num7 = $data['zahlen']['hauptlotterie']['ziehungen'][1]['zahlen'][1];
$spieleinsatz = $data['auswertung']['spieleinsatz']['hauptlotterie'];
$winner1_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][0]['anzahl'];
$winner1_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][0]['quote'];
$winner2_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][1]['anzahl'];
$winner2_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][1]['quote'];
$winner3_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][2]['anzahl'];
$winner3_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][2]['quote'];
$winner4_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][3]['anzahl'];
$winner4_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][3]['quote'];
$winner5_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][4]['anzahl'];
$winner5_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][4]['quote'];
$winner6_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][5]['anzahl'];
$winner6_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][5]['quote'];
$winner7_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][6]['anzahl'];
$winner7_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][6]['quote'];
$winner8_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][7]['anzahl'];
$winner8_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][7]['quote'];
$winner9_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][8]['anzahl'];
$winner9_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][8]['quote'];
$winner10_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][9]['anzahl'];
$winner10_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][9]['quote'];
$winner11_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][10]['anzahl'];
$winner11_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][10]['quote'];
$winner12_count = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][11]['anzahl'];
$winner12_amount = $data['auswertung']['quoten']['hauptlotterie']['ziehungen'][0]['gewinnklassen'][11]['quote'];

// SQL-Abfrage ausführen
try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':draw_date', $draw_date);
    $stmt->bindParam(':num1', $num1);
    $stmt->bindParam(':num2', $num2);
    $stmt->bindParam(':num3', $num3);
    $stmt->bindParam(':num4', $num4);
    $stmt->bindParam(':num5', $num5);
    $stmt->bindParam(':num6', $num6);
    $stmt->bindParam(':num7', $num7);
    $stmt->bindParam(':spieleinsatz', $spieleinsatz);
    $stmt->bindParam(':winner1_count', $winner1_count);
    $stmt->bindParam(':winner1_amount', $winner1_amount);
    $stmt->bindParam(':winner2_count', $winner2_count);
    $stmt->bindParam(':winner2_amount', $winner2_amount);
    $stmt->bindParam(':winner3_count', $winner3_count);
    $stmt->bindParam(':winner3_amount', $winner3_amount);
    $stmt->bindParam(':winner4_count', $winner4_count);
    $stmt->bindParam(':winner4_amount', $winner4_amount);
    $stmt->bindParam(':winner5_count', $winner5_count);
    $stmt->bindParam(':winner5_amount', $winner5_amount);
    $stmt->bindParam(':winner6_count', $winner6_count);
    $stmt->bindParam(':winner6_amount', $winner6_amount);
    $stmt->bindParam(':winner7_count', $winner7_count);
    $stmt->bindParam(':winner7_amount', $winner7_amount);
    $stmt->bindParam(':winner8_count', $winner8_count);
    $stmt->bindParam(':winner8_amount', $winner8_amount);
    $stmt->bindParam(':winner9_count', $winner9_count);
    $stmt->bindParam(':winner9_amount', $winner9_amount);
    $stmt->bindParam(':winner10_count', $winner10_count);
    $stmt->bindParam(':winner10_amount', $winner10_amount);
    $stmt->bindParam(':winner11_count', $winner11_count);
    $stmt->bindParam(':winner11_amount', $winner11_amount);
    $stmt->bindParam(':winner12_count', $winner12_count);
    $stmt->bindParam(':winner12_amount', $winner12_amount);
    $stmt->execute();
    echo "Daten wurden erfolgreich in die Datenbank eingefügt.";
} catch (PDOException $e) {
    die("Fehler beim Einfügen der Daten in die Datenbank: " . $e->getMessage());
}
