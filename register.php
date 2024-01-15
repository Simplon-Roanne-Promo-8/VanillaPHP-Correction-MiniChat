<?php include './partials/header.php' ?>


    <section class="container">
        <h1>Créer un compte</h1>


        <form action="./process/authentication/process_register.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="toto@gmail.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password">
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="toto" >
            </div>
            <button type="submit" class="btn btn-danger">Créer un compte</button>
        </form>

    </section>

<?php include "./partials/footer.php" ?>
