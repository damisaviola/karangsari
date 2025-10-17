<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwitansi Pembayaran</title>
    <style>
        @page {
            margin: 25px 40px;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 12px;
            color: #222;
            background-color: #fff;
            position: relative;
        }

        /* Watermark */
        body::before {
            content: "KOS KARANGSARI";
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 58px;
            color: rgba(0, 74, 173, 0.07);
            font-weight: bold;
            letter-spacing: 5px;
            white-space: nowrap;
            z-index: -1;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #004aad;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        .header img {
            height: 55px;
            margin-right: 12px;
        }
        .header .title {
            flex: 1;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
            color: #004aad;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 1px 0;
            font-size: 10.5px;
            color: #555;
        }

        .doc-title {
            text-align: center;
            margin: 5px 0 12px 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            letter-spacing: 0.8px;
        }
        .info {
            text-align: center;
            font-size: 10.5px;
            margin-bottom: 18px;
            color: #555;
        }

        .content {
            display: flex;
            justify-content: space-between;
        }
        .section {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 4px 3px;
            vertical-align: top;
        }
        .title {
            font-weight: 600;
            width: 42%;
            color: #333;
        }

         .amount-box {
            background-color: #f1f6ff;
            border: 1px solid #cbd6ee;
            padding: 5px 8px;
            border-radius: 5px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            color: #004aad;
            display: inline-block;
            min-width: 120px;
        }

        .highlight {
            background: #eaf4ff;
            border-left: 4px solid #004aad;
            padding: 7px 12px;
            margin: 18px 0 10px;
            border-radius: 4px;
            font-size: 11.5px;
            color: #333;
        }

        .footer {
            margin-top: 35px;
            display: flex;
            justify-content: flex-end;
            font-size: 11px;
        }

        .sign-box {
            width: 30%;
            text-align: center;
        }

        .sign-box p {
            margin: 4px 0;
        }

        .sign-line {
            margin-top: 50px;
            border-top: 1px solid #333;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .note {
            margin-top: 20px;
            font-size: 10px;
            color: #666;
            border-top: 1px dashed #aaa;
            padding-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
    <div class="title">
        <h2>KOS KARANGSARI</h2>
        <p>Jl. Karangsari No. 21, Yogyakarta 55281</p>
        <p>Telp: 0812-3456-7890 | Email: info@karangsari.com</p>
    </div>
</div>

<div class="doc-title">KWITANSI PEMBAYARAN</div>
<div class="info">No. Kwitansi: <?= $pembayaran->id_pembayaran ?></div>

<div class="content">
    <div class="section">
        <table>
            <tr><td class="title">Nama Penghuni</td><td>: <?= $pembayaran->nama_penghuni ?></td></tr>
            <tr><td class="title">Alamat</td><td>: <?= $pembayaran->alamat ?></td></tr>
            <tr><td class="title">Tanggal Pembayaran</td><td>: <?= date('d F Y', strtotime($pembayaran->tanggal_bayar)) ?></td></tr>
            <tr><td class="title">Metode Pembayaran</td><td>: <?= ucfirst($pembayaran->metode_pembayaran) ?></td></tr>
        </table>
    </div>

    <div class="section">
        <table>
            <tr><td class="title">ID Booking</td><td>: <?= $pembayaran->id_booking ?></td></tr>
            <tr><td class="title">Status Pembayaran</td><td>: <?= ucfirst($pembayaran->status) ?></td></tr>
            <tr>
                <td class="title">Jumlah Dibayar</td>
                <td>
                    <div class="amount-box">
                        Rp <?= number_format($pembayaran->jumlah_bayar, 0, ',', '.') ?>
                    </div>
                </td>
            </tr>
            <?php if (!empty($pembayaran->keterangan)): ?>
            <tr><td class="title">Keterangan</td><td>: <?= $pembayaran->keterangan ?></td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<div class="highlight">
    Pembayaran ini telah diterima oleh pihak pengelola Kos Karangsari melalui 
    <?= strtolower($pembayaran->metode_pembayaran) ?> pada tanggal 
    <?= date('d F Y', strtotime($pembayaran->tanggal_bayar)) ?>.
</div>

<div class="note">
    * Simpan kwitansi ini sebagai bukti pembayaran resmi.<br>
    Dicetak otomatis oleh sistem pada <?= date('d/m/Y H:i') ?>.
</div>

</body>
</html>
