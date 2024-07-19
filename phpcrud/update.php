<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $namalengkap = isset($_POST['namalengkap']) ? $_POST['namalengkap'] : '';
        $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
        $jurusan = isset($_POST['jurusan']) ? $_POST['jurusan'] : '';
        $tgl_kunjungan = isset($_POST['tgl_kunjungan']) ? $_POST['tgl_kunjungan'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
        
        $stmt = $pdo->prepare('UPDATE tamu SET id = ?, namalengkap = ?, kelas = ?, jurusan = ?, tgl_kunjungan = ?, email = ?, kategori = ? WHERE id = ?');
        $stmt->execute([$id, $namalengkap, $kelas, $jurusan, $tgl_kunjungan, $email, $kategori, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM tamu WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $tamu = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tamu) {
        exit('Tamu tidak ditemukan dengan ID tersebut!');
    }
} else {
    exit('Tidak ada ID yang spesifik!');
}
?>

<?=template_header('Update')?>

<div class="content update">
    <h2>Update Tamu #<?=$tamu['id']?></h2>
    <form action="update.php?id=<?=$tamu['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$tamu['id']?>" id="id" readonly>
        <label for="namalengkap">Nama Lengkap</label>
        <input type="text" name="namalengkap" value="<?=$tamu['namalengkap']?>" id="namalengkap">
        <label for="kelas">Kelas</label>
        <select name="kelas" id="kelas">
            <option value="X" <?=$tamu['kelas'] == 'X' ? 'selected' : ''?>>X</option>
            <option value="XI" <?=$tamu['kelas'] == 'XI' ? 'selected' : ''?>>XI</option>
            <option value="XII" <?=$tamu['kelas'] == 'XII' ? 'selected' : ''?>>XII</option>
            <option value="Guru" <?=$tamu['kelas'] == 'Guru' ? 'selected' : ''?>>Guru</option>
        </select>
        <label for="jurusan">Jurusan</label>
        <select name="jurusan" id="jurusan">
            <option value="PPLG 1" <?=$tamu['jurusan'] == 'PPLG 1' ? 'selected' : ''?>>PPLG 1</option>
            <option value="PPLG 2" <?=$tamu['jurusan'] == 'PPLG 2' ? 'selected' : ''?>>PPLG 2</option>
            <option value="TJKT 1" <?=$tamu['jurusan'] == 'TJKT 1' ? 'selected' : ''?>>TJKT 1</option>
            <option value="TJKT 2" <?=$tamu['jurusan'] == 'TJKT 2' ? 'selected' : ''?>>TJKT 2</option>
            <option value="AKL" <?=$tamu['jurusan'] == 'AKL' ? 'selected' : ''?>>AKL</option>
            <option value="DKV" <?=$tamu['jurusan'] == 'DKV' ? 'selected' : ''?>>DKV</option>
            <option value="SENI" <?=$tamu['jurusan'] == 'SENI' ? 'selected' : ''?>>SENI</option>
            <option value="Guru" <?=$tamu['jurusan'] == 'Guru' ? 'selected' : ''?>>Guru</option>
        </select>
        <label for="tgl_kunjungan">Tanggal Kunjungan</label>
        <input type="date" name="tgl_kunjungan" value="<?=$tamu['tgl_kunjungan']?>" id="tgl_kunjungan">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$tamu['email']?>" id="email">
        <label for="kategori">Kategori</label>
        <select name="kategori" id="kategori">
            <option value="Siswa" <?=$tamu['kategori'] == 'Siswa' ? 'selected' : ''?>>Siswa</option>
            <option value="Guru" <?=$tamu['kategori'] == 'Guru' ? 'selected' : ''?>>Guru</option>
        </select>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
