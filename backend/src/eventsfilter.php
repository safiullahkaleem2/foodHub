<?php

require_once __DIR__ . '/../scripts/databaseconnection.php';
require_once __DIR__ . '/queries/queryfunctions.php';

session_start();

// Division
// Find the users who have partipated in all events

    $checkStmt = $connection->prepare("SELECT *
                                       FROM userdetails u,
                                      (SELECT *
                                       FROM appuser a
                                       WHERE NOT EXISTS
                                       ((SELECT e.eventid
                                         FROM eventdetails e)
                                         EXCEPT 
                                         (SELECT p.eventid
                                          FROM participates p
                                          WHERE p.userid = a.userid))) t
                                          WHERE t.username = u.username
                                          AND t.password = u.password");
    
    $checkStmt->execute();
    $_SESSION['EventsQueryResults'] = $checkStmt->fetchAll(PDO::FETCH_ASSOC);

    // echo json_encode($checkStmt);
    header("Location: /frontend/Pages/filterevents.php");

    







