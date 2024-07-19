<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM tamu WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $tamu = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tamu) {
        exit('Tamu tidak ditemukan dengan ID tersebut!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM tamu WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Anda telah menghapus tamu!';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('Tidak ada ID yang spesifik!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
    <h2>Delete Tamu #<?=$tamu['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Apakah Anda yakin ingin menghapus tamu #<?=$tamu['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$tamu['id']?>&confirm=yes">Ya</a>
        <a href="delete.php?id=<?=$tamu['id']?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
