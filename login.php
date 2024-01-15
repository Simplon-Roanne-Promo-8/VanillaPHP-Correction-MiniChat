<?php include './partials/header.php' ?>


    <section class="container">
        <h1>Connexion</h1>


        <form action="./process/authentication/process_login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="toto@gmail.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-danger">Connexion</button>
        </form>

    </section>

<?php include "./partials/footer.php" ?>
