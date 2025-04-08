<?php
require_once 'session_manager.php';

$session = new SessionManager();
$session->start();


$name = isset($_POST['name']) ? $_POST['name'] : 'Invité';

$storedName = $session->get('name');

if ($storedName !== $name) {
   
    $session->set('name', $name);
    $session->set('visits', 1);
    $message = "Bienvenue à notre plateforme, {$name}!";
} else {
   
    $visits = $session->get('visits');
    $visits++;
    $session->set('visits', $visits);
    $message = "Merci pour votre fidélité, {$name}. C'est votre {$visits}ème visite.";
}


if (isset($_POST['reset'])) {
    $session->destroy();
    header("Location: login.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title text-center"><?php echo $message; ?></h1>
                <form method="post" class="d-flex justify-content-center mt-3">
                    <button type="submit" name="reset" class="btn btn-danger">Réinitialiser la session</button>
                </form>
            </div>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
