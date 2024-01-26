<?php

function trancheHoraireDisponible($conn, $date_heure, $id_rdv_a_exclure = null) {
    $sql = "SELECT COUNT(*) FROM rendez_vous WHERE date_heure = ? AND (? IS NULL OR id != ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$date_heure, $id_rdv_a_exclure, $id_rdv_a_exclure]);
    $count = $stmt->fetchColumn();

    return $count == 0;
}
?>