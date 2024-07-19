<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'bukutamu'; // Ubah nama database sesuai dengan kebutuhan
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>Website Title</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
            <a href="read.php"><i class="fa-solid fa-plus"></i>Kelola Data Tamu </a>
            <a href="logout.php"><i class='bx bx-door-open' ></i>Logout </a>
        </div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>
