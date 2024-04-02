<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['registrationType']) && !empty($_POST['registrationType'])) {
        $registrationType = $_POST['registrationType'];
        
        if ($registrationType === 'homeCook') {
            header('Location: /frontend/Pages/homecookRegistration.html');
            exit(); 
        } elseif ($registrationType === 'professionalChef') {
            header('Location: /frontend/Pages/professionalchefRegistration.html');
            exit(); 
        }
    } else {
        
        header('Location: registrationForm.html'); 
        exit();
    }
}
?>
