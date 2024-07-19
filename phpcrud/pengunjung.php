<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'bukutamu';

// Create connection
$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$msg = "";

if (isset($_POST['submit'])) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $namalengkap = isset($_POST['namalengkap']) ? $_POST['namalengkap'] : '';
    $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
    $jurusan = isset($_POST['jurusan']) ? $_POST['jurusan'] : '';
    $tgl_kunjungan = isset($_POST['tgl_kunjungan']) ? $_POST['tgl_kunjungan'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';

    // Prepare an SQL statement
    $stmt = $db->prepare("INSERT INTO tamu (id, namalengkap, kelas, jurusan, tgl_kunjungan, email, kategori) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $db->error);
    }

    // Bind parameters
    $stmt->bind_param("issssss", $id, $namalengkap, $kelas, $jurusan, $tgl_kunjungan, $email, $kategori);

    // Execute the statement
    if ($stmt->execute()) {
        $msg = "Data sudah diterima.";
    } else {
        $msg = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tamu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", "sans-serif";
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('img/library2.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .wrapper {
            width: 420px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .wrapper .input-box {
            width: 100%;
            height: 50px;
            margin: 20px 0;
            position: relative;
        }

        .input-box input,
        .input-box select {
            width: 100%;
            height: 100%;
            background: #f4f4f4;
            border: none;
            outline: none;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            padding: 0 20px;
        }

        .input-box input::placeholder,
        .input-box select {
            color: #999;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #999;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: #333;
            border: none;
            outline: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
        }

        .wrapper .additional-info {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .wrapper .additional-info p {
            font-size: 14px;
            font-weight: bold;
        }

        .wrapper .additional-info p a {
            color: #333;
            text-decoration: none;
        }

        .wrapper .additional-info p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Silakan isi data pada form di bawah ini sebelum masuk ke halaman utama</h1>
        <form action="" method="post">
            <div class="input-box">
                <input type="text" name="id" value="auto" id="id" readonly>
                <i class='fas fa-id-card'></i>
            </div>
            <div class="input-box">
                <input type="text" name="namalengkap" id="namalengkap" placeholder="Nama Lengkap" required>
                <i class='fas fa-user'></i>
            </div>
            <div class="input-box">
                <select name="kelas" id="kelas" required>
                    <option value="" disabled selected>Kelas</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                    <option value="GURU">GURU</option>
                </select>
                <i class='fas fa-book'></i>
            </div>
            <div class="input-box">
                <select name="jurusan" id="jurusan" required>
                    <option value="" disabled selected>Jurusan</option>
                    <option value="PPLG 1">PPLG 1</option>
                    <option value="PPLG 2">PPLG 2</option>
                    <option value="TJKT 1">TJKT 1</option>
                    <option value="TJKT 2">TJKT 2</option>
                    <option value="AKL">AKL</option>
                    <option value="DKV">DKV</option>
                    <option value="SENI">SENI</option>
                    <option value="GURU">GURU</option>
                </select>
                <i class='fas fa-graduation-cap'></i>
            </div>
            <div class="input-box">
                <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" min="2022-01-01" max="2030-12-31" required>
               
                <i class='fas fa-calendar'></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <i class='fas fa-envelope'></i>
            </div>
            <div class="input-box">
                <select name="kategori" id="kategori" required>
                    <option value="" disabled selected>Kategori</option>
                    <option value="GURU">GURU</option>
                    <option value="SISWA">SISWA</option>
                </select>
                <i class='fas fa-tags'></i>
            </div>
            <button type="submit" name="submit" class="btn">Create</button>
        </form>
        <?php if ($msg): ?>
            <p class="additional-info"><?=$msg?></p>
        <?php endif; ?>
        <?php if ($msg === "Data sudah diterima."): ?>
            <p class="additional-info">Data sudah diterima. Silakan lanjutkan.</p>
            <a href="pengunjung.html" class="btn">Berikutnya</a>
        <?php endif; ?>
        <div class="additional-info">
            <p><a href="index.html">Kembali ke Beranda</a></p>
        </div>
    </div>
</body>
</html>
