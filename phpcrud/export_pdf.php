<?php

// persiapan untuk excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Export Excel Data Pengunjung.xls");
header("Pragma: no-cache");
header("Expires:0");
?>

<table border="1">
    <thead>
        <tr>
            <th colspan="6">Rekapitulasi Data Pengunjung</th>
        </tr>
        <tr>
        <th>no</th>    
        <th>namalengkap</th>
            <th>kelas</th>
            <th>jurusan</th>
            <th>tgl kunjungan</th>
            <th>email</th>
            <th>kategori</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'bukutamu';

        $koneksi = mysqli_connect($DATABASE_HOST,  $DATABASE_USER, $DATABASE_PASS,$DATABASE_NAME);

        $tampil = mysqli_query($koneksi, "SELECT * FROM tamu");
        $no = 1;
        while ($data = mysqli_fetch_assoc($tampil)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['namalengkap'] ?></td>
                <td><?= $data['kelas'] ?></td>
                <td><?= $data['jurusan'] ?></td>
                <td><?= $data['tgl_kunjungan'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['kategori'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>