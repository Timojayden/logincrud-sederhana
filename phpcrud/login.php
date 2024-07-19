<?php
// Informasi koneksi database
$host = "localhost"; // Ganti dengan nama host Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "bukutamu"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
session_start();
// Jika ada pengiriman data dari form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah pengguna ada di database
    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // Periksa apakah query menghasilkan hasil
    if ($result->num_rows > 0) {
        // Pengguna berhasil masuk, arahkan ke halaman index.php
        // Simpan informasi login pengguna dalam session
        $_SESSION['email'] = $email;
        header("Location: index.php");
        exit(); // Pastikan untuk keluar setelah menggunakan header
    } else {
        // Kombinasi email dan password tidak cocok
        echo "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN ADMIN</title>
   
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            background: url('img/library.jpg') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(5px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            width: 100%;
            height: 50px;
            margin: 30px 0;
            position: relative;
            /* tambahkan agar ikon bisa diposisikan secara absolut */
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: black;
            /* Mengubah warna teks menjadi hitam */
            font-weight: 600;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }

        .additional-info {
            text-align: center;
            margin-top: 20px;
            color: #ffffffe1
        }

        .additional-info p {
            font-size: 17px;
            font-weight: bold;
        }

        .additional-info p a {
            color: #ffffff95;
            /* Warna putih */
            text-decoration: none;
            font-family: Arial;
        }

        .additional-info p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>LOGIN ADMIN</h1>
            <div class="input-box">
                <input type="email" placeholder="Email" name="email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox">Remember me
                </label>

                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Dont have account? <a href="#">Register</a></p>
            </div>

            <div class="additional-info">
                <p><strong>Login ini khusus untuk admin untuk mengelola data Pengunjung dari Perpustakaan Buku Tamu.</strong>
                </p>
            </div>
        </form>
        <div class="additional-info">
            <p><a href="index.html">Kembali ke Beranda</a></p>
        </div>
    </div>
</body>

</html>
