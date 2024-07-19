<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM tamu ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$tamus = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_tamus = $pdo->query('SELECT COUNT(*) FROM tamu')->fetchColumn();
?>

<?=template_header('Read')?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

<div class="content read">
    <h2>Read Tamu</h2>
    <a href="create.php" class="btn btn-success mb-2">Create Tamu</a>
    <a href="export_pdf.php" class="btn btn-primary mb-2">Export to PDF</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>#</td>
                <td>Nama Lengkap</td>
                <td>Kelas</td>
                <td>Jurusan</td>
                <td>Tanggal Kunjungan</td>
                <td>Email</td>
                <td>Kategori</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tamus as $tamu): ?>
            <tr>
                <td><?=$tamu['id']?></td>
                <td><?=$tamu['namalengkap']?></td>
                <td><?=$tamu['kelas']?></td>
                <td><?=$tamu['jurusan']?></td>
                <td><?=$tamu['tgl_kunjungan']?></td>
                <td><?=$tamu['email']?></td>
                <td><?=$tamu['kategori']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$tamu['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$tamu['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="read.php?page=<?=$page-1?>" class="btn btn-secondary"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page*$records_per_page < $num_tamus): ?>
        <a href="read.php?page=<?=$page+1?>" class="btn btn-secondary"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
