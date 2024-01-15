<?php
session_start();
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
    <?php include './partials/header.php' ?>
    <section class="container">
        <h1 class="text-center">Bienvenu sur mon chat</h1>
    </section>

    <section class="container border border-dark" id="messages">
        <?php foreach ($messages as $key => $message) {?>
            <?php 
                if (!empty($_SESSION['pseudo']) ) {
                    if ($_SESSION['pseudo'] === $message['pseudo']) {
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
                <input type="text" class="form-control" placeholder="pseudo" id="pseudo" name="pseudo" value="<?=$_SESSION['pseudo'] ?? ""?>">
            </div>
            <div class="m-3 w-50">
                <input type="text" class="form-control" placeholder="message" id="message" name="message">
            </div>
            <input type="hidden" name="adress_ip" id="adress_ip" value="<?= $_SERVER['REMOTE_ADDR']?>">
            <button type="submit" class="m-3 btn btn-danger">Envoyer</button>
        </form>
    </section>
    

    <script src="./assets/js/ajax.js"></script>        

    <?php include "./partials/footer.php" ?>