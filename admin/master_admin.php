<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Antara yoga Center</title>

    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<!-- Custom Css  -->
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="container my-5 col-6">

    <form action="admin_register.php" method="POST">
        <div class="form-group mb-3">
            <label for="memail" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="memail" name="memail">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="form-group mb-3">
            <label for="mpassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="mpassword" name="mpassword">
        </div>
        
        <div class="form-group mb-3">
        <button type="submit" name="msubmit" class="btn btn-success">Sign In</button>
    </div>
</form>
</div>
<?php include 'partials/_footer.php'; ?>
</body>

</html>