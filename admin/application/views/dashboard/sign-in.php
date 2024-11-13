<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="The login page allows a user to gain access to an application by entering their username and password or by authenticating using a social media login.">
    <title>EDUSTAT</title>

    <!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~--- -->

    <!-- Fonts [ OPTIONAL ] -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <!-- Nifty CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="./assets/css/nifty.min.css">

    <!-- Nifty Demo Icons [ OPTIONAL ] -->
    <link rel="stylesheet" href="./assets/css/demo-purpose/demo-icons.min.css">

    <!-- Demo purpose CSS [ DEMO ] -->
    <link rel="stylesheet" href="./assets/css/demo-purpose/demo-settings.min.css">

</head>
<body class="">
    <!-- PAGE CONTAINER -->
    <div id="root" class="root front-container">
        <!-- CONTENTS -->
        <section id="content" class="content">
            <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="content__wrap">
                    <!-- Login card -->
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="h3">Connexion</h1>
                                <p>Connectez-vous a votre compte</p>
                            </div>
                            <form class="mt-4" method= "POST" action="<?php echo base_url(); ?>authentication">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Username"  name="matricule" autofocus>
                                </div>
                            
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password"  name="passe">
                                </div>
                                <div class="form-check">
                                    <input id="_dm-loginCheck" class="form-check-input" type="checkbox">
                                    <label for="_dm-loginCheck" class="form-check-label">
                                        Se souvenir
                                    </label>
                                </div>
                                <div class="d-grid mt-5">
                                    <button class="btn btn-primary btn-lg" type="submit">Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END : Login card -->

                </div>
            </div>
        </section>

        <!-- END - CONTENTS -->
    </div>
    <script>
            var resizefunc = [];
        </script>

    <!-- END - PAGE CONTAINER -->

    <!-- JAVASCRIPTS -->

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="./assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="./assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="./assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="./assets/js/demo-purpose-only.js" defer></script>

</body>

