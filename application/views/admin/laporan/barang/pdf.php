<!-- CSS -->
<style media="screen">
    .judul {
        padding: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    h3 {
        font-family: times;
    }

    p {
        margin: 0;
    }
</style>
<!-- CSS -->

<table align="center">
    <tr>
        <td align="center">
            <h3>LAPORAN BARANG</h3>
            <h3>CV. RISKY ABADI</h3>
        </td>
    </tr>
</table>
<hr>

<table align="center" border="1" cellpadding="4" cellspacing="0" style="width: 100%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Barang</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th>Jenis</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($barang->result() as $key => $value) {
            $stok = ($value->stok_in - $value->stok_out);
        ?>
            <tr>
                <td align="center"><?= $no++ ?></td>
                <td align="center"><?= $value->kd_barang ?></td>
                <td align="center"><?= $value->nama ?></td>
                <td align="center"><?= $value->harga ?></td>
                <td align="center"><?= $value->satuan ?></td>
                <td align="center"><?= $value->jenis ?></td>
                <td align="center"><?= $stok ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<br /><br />
<table>
    <tr>
        <td align="center">
            <p>MAKASSAR, <?= tgl_indo(date('Y-m-d')) ?></p>
            <br />
            <br />
            <br />
            <br />
            <p>Penanggung Jawab</p>
        </td>
    </tr>