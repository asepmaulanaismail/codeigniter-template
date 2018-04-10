<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/auth/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="/auth/authentication">
        <img class="mb-4" src="/images/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <?php
            $error_message = $this->session->flashdata("error_message");
            if ($error_message != null) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?=$error_message?>
                </div>
                <?php
            }
        ?>
        <label for="inputUsername" class="sr-only">Email address</label>
        <input type="text" max=15 id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
    </form>
  </body>
</html>