<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $namalengkap = isset($_POST['namalengkap']) ? $_POST['namalengkap'] : '';
    $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
    $jurusan = isset($_POST['jurusan']) ? $_POST['jurusan'] : '';
    $tgl_kunjungan = isset($_POST['tgl_kunjungan']) ? $_POST['tgl_kunjungan'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';

    $stmt = $pdo->prepare('INSERT INTO tamu (id, namalengkap, kelas, jurusan, tgl_kunjungan, email, kategori) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $namalengkap, $kelas, $jurusan, $tgl_kunjungan, $email, $kategori]);
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Create Tamu</h2>
    <form action="create.php" method="post" class="form-style">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" name="id" value="auto" id="id" readonly>
        </div>
        <div class="form-group">
            <label for="namalengkap">Nama Lengkap</label>
            <input type="text" name="namalengkap" id="namalengkap">
        </div>
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas">
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
                <option value="GURU">GURU</option>
            </select>
        </div>
        <div class="form-group">
    <label for="jurusan">Jurusan</label>
    <select name="jurusan" id="jurusan">
        <option value="PPLG 1">PPLG 1</option>
        <option value="PPLG 2">PPLG 2</option>
        <option value="TJKT 1">TJKT 1</option>
        <option value="TJKT 2">TJKT 2</option>
        <option value="AKL">AKL</option>
        <option value="DKV">DKV</option>
        <option value="SENI">SENI</option>
        <option value="GURU">GURU</option>
    </select>
</div>

        <div class="form-group">
            <label for="tgl_kunjungan">Tanggal Kunjungan</label>
            <input type="date" name="tgl_kunjungan" id="tgl_kunjungan">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori">
                <option value="Guru">Guru</option>
                <option value="Siswa">Siswa</option>
            </select>
        </div>
        
        <div class="submit-button">
        <input type="submit" value="Create" class="submit-button">
        </div>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
