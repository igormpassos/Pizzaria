<?php

include_once("conn.php");


$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {

    $bordasQuery = $conn->query("SELECT * FROM bordas;");

    $bordas = $bordasQuery->fetchAll();

    $massasQuery = $conn->query("SELECT * FROM massas;");

    $massas = $massasQuery->fetchAll();

    $saboresQuery = $conn->query("SELECT * FROM sabores;");

    $sabores = $saboresQuery->fetchAll();


} else if ($method === "POST") {

    $data = $_POST;

    $bordas = isset($data["borda"]) && !empty($data["borda"]) ? $data["borda"] : null;
    $massas = isset($data["massa"]) && !empty($data["massa"]) ? $data["massa"] : null;
    $sabores = isset($data["sabores"]) && !empty($data["sabores"]) ? $data["sabores"] : null;
    
    if ($bordas === null) {
        // Handle the error, e.g. show an error message to the user
        die('borda_id cannot be null');
    }

    if (count($sabores) > 3) {
        
        $_SESSION["msg"] = "Você não pode escolher mais de 3 sabores";
        $_SESSION["status"] = "warning";
    } else {
        $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)");
        
        $stmt->bindParam(":borda", $bordas, PDO::PARAM_INT);
        $stmt->bindParam(":massa", $massas, PDO::PARAM_INT);

        $stmt->execute();
        
    }
    header("Location: ..");
}
?>