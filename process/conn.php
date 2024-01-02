<?php

    session_start();

    $user = "root";
    $pass = "Samlat03";
    $db = "pizzaria";
    $host = "127.0.0.1:3307";

    try{

        $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    catch(Exception $e){
        echo 'Erro: ' . $e->getMessage();
        error_log('Erro SQL: ' . $e->getMessage() . ' - Consulta: ' . $suaConsulta);
        die();
    }
?>