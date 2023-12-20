

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Information Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
<div
    class="container"
>
   


<h1>Database Information Generator</h1>
<?php
session_start();
// if session has message display it
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<form action="process.php" method="post">
    <div class="mb-3">
        <label for="host" class="form-label">Host</label>
        <input type="text" class="form-control" id="host" name="host" value="localhost">
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="root">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" id="password" name="password" value="">
    </div>
    <div class="mb-3">
        <label for="database" class="form-label">Database</label>
        <input type="text" class="form-control" id="database" name="database" value="test">
    </div>
    <button type="submit" class="btn btn-primary">Generate</button>
</form>

<!-- js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</div>
</body>
</html>
