<?php
exit;
// Verbindung zur Datenbank herstellen
$pdo = new PDO('mysql:host=clevertipp.com;dbname=d0404e94', 'd0404e94', 'FYDsWuHhaPRQVB3HcYzS');

// Funktion zum Prüfen, ob ein Eintrag für ein bestimmtes Datum bereits vorhanden ist
function entryExists($pdo, $date) {
    $query = "SELECT COUNT(*) FROM lottery_numbers WHERE draw_date = :date";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':date', $date);
    $statement->execute();
    $count = $statement->fetchColumn();
    return $count > 0;
}

// CSV-Datei einlesen und Daten in die Datenbank einfügen
$csvFile = 'lottery_data.csv';
$handle = fopen($csvFile, 'r');
if ($handle) {
    // CSV-Datei zeilenweise durchgehen
    while (($line = fgetcsv($handle, 0, ';')) !== false) {
        // Datum aus CSV extrahieren und im richtigen Format für die Datenbank speichern
        $draw_date = date('Y-m-d', strtotime($line[0]));

        // Prüfen, ob ein Eintrag für dieses Datum bereits vorhanden ist
        if (!entryExists($pdo, $draw_date)) {
            // Daten in die Datenbank einfügen
            $query = "INSERT INTO lottery_numbers (draw_date, num1, num2, num3, num4, num5, num6, num7, spieleinsatz, winner1_count, winner1_amount, winner2_count, winner2_amount, winner3_count, winner3_amount, winner4_count, winner4_amount, winner5_count, winner5_amount, winner6_count, winner6_amount, winner7_count, winner7_amount, winner8_count, winner8_amount, winner9_count, winner9_amount, winner10_count, winner10_amount, winner11_count, winner11_amount, winner12_count, winner12_amount) VALUES (:draw_date, :num1, :num2, :num3, :num4, :num5, :num6, :num7, :spieleinsatz, :winner1_count, :winner1_amount, :winner2_count, :winner2_amount, :winner3_count, :winner3_amount, :winner4_count, :winner4_amount, :winner5_count, :winner5_amount, :winner6_count, :winner6_amount, :winner7_count, :winner7_amount, :winner8_count, :winner8_amount, :winner9_count, :winner9_amount, :winner10_count, :winner10_amount, :winner11_count, :winner11_amount, :winner12_count, :winner12_amount)";
            $statement = $pdo->prepare($query);
            $statement->execute([
                ':draw_date' => $draw_date,
                ':num1' => $line[1],
                ':num2' => $line[2],
                ':num3' => $line[3],
                ':num4' => $line[4],
                ':num5' => $line[5],
                ':num6' => $line[6],
                ':num7' => $line[7],
                ':spieleinsatz' => str_replace('.', '', $line[8]),
                ':winner1_count' => $line[9],
                ':winner1_amount' => str_replace('.', '', $line[10]),
                ':winner2_count' => $line[11],
                ':winner2_amount' => str_replace('.', '', $line[12]),
                ':winner3_count' => $line[13],
                ':winner3_amount' => str_replace('.', '', $line[14]),
                ':winner4_count' => $line[15],
                ':winner4_amount' => str_replace('.', '', $line[16]),
                ':winner5_count' => $line[17],
                ':winner5_amount' => str_replace('.', '', $line[18]),
                ':winner6_count' => $line[19],
                ':winner6_amount' => str_replace('.', '', $line[20]),
                ':winner7_count' => $line[21],
                ':winner7_amount' => str_replace('.', '', $line[22]),
                ':winner8_count' => $line[23],
                ':winner8_amount' => str_replace('.', '', $line[24]),
                ':winner9_count' => $line[25],
                ':winner9_amount' => str_replace('.', '', $line[26]),
                ':winner10_count' => $line[27],
                ':winner10_amount' => str_replace('.', '', $line[28]),
                ':winner11_count' => $line[29],
                ':winner11_amount' => str_replace('.', '', $line[30]),
                ':winner12_count' => $line[31],
                ':winner12_amount' => str_replace('.', '', $line[32]),
            ]);
        }
    }
    fclose($handle);
} else {
    echo "Fehler beim Öffnen der Datei.";
}
?>
