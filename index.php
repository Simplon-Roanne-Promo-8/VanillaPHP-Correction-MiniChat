<?php
// require_once './config/debug.php';
require_once './config/connexion.php';

$preparedRequest =  $connexion->prepare(
    "SELECT * FROM message 
    JOIN user
        ON user.id = message.user_id
    ORDER BY message.created_at ASC
    "
);
$preparedRequest->execute();
$messages = $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($messages);
// echo '</pre>';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini chat P8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <header>
        <nav class="navbar bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Mini Chat P8</a>
            </div>
        </nav>
    </header>
    <?php include './partials/message.php' ?>
    <section class="container">
        <h1 class="text-center">Bienvenu sur mon chat</h1>
    </section>

    <section class="container border border-dark" id="messages">
        <?php foreach ($messages as $key => $message) {?>
            <?php 
                if (!empty($_COOKIE['pseudo']) ) {
                    if ($_COOKIE['pseudo'] === $message['pseudo']) {
                        $class = 'text-end text-success';
                    }else{
                        $class = 'text-start text-danger';
                    }
                }else{
                    $class = 'text-start text-danger';
                }
                ?>

            <p class="<?=$class?>">
                <span class="fst-italic"><?=$message['created_at']?></span>                
                <b><?= $message['pseudo']?> : </b>
                <?= $message['content']?>
            </p>
        <?php } ?>
    </section>
    
    <section class="container border border-dark" >
        <form action="./process/process_add_user_message.php" method="post" class="d-flex align-items-center">
            <div class="m-3 w-25">
                <input type="text" class="form-control" placeholder="pseudo" id="pseudo" name="pseudo" value="<?=$_COOKIE['pseudo'] ?? ""?>">
            </div>
            <div class="m-3 w-50">
                <input type="text" class="form-control" placeholder="message" id="message" name="message">
            </div>
            <input type="hidden" name="adress_ip" id="adress_ip" value="<?= $_SERVER['REMOTE_ADDR']?>">
            <button type="submit" class="m-3 btn btn-danger">Envoyer</button>
        </form>
    </section>
    


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./assets/js/ajax.js"></script>        
    </body>
</html>