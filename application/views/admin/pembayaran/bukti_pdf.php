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

        .header .icon {
            width: 55px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 5px 0 12px 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            letter-spacing: 0.8px;
        }

        .doc-title svg {
            width: 20px;
            height: 20px;
            fill: #004aad;
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

        .note {
            margin-top: 20px;
            font-size: 10px;
            color: #666;
            border-top: 1px dashed #aaa;
            padding-top: 5px;
            text-align: center;
        }
    </style>
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
      <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
</head>
<body>

<div class="header">
    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="#004aad" viewBox="0 0 24 24">
        <path d="M12 3l9 8h-3v10h-12v-10h-3l9-8zM10 13h4v6h-4v-6z"/>
    </svg>
    <div class="title">
        <h2>KOS KARANGSARI</h2>
        <p>Jl. Karangsari No. 21, Yogyakarta 55281</p>
        <p>Telp: 0812-3456-7890 | Email: info@karangsari.com</p>
    </div>
</div>

<div class="doc-title">
    <svg xmlns="http://www.w3.org/2000/svg" fill="#004aad" viewBox="0 0 24 24">
        <path d="M20 2H8c-1.1 0-2 .9-2 2v16l4-2 4 2 4-2 4 2V4c0-1.1-.9-2-2-2zm0 15.17-2-.67-4 2-4-2-2 .67V4h12v13.17zM10 9h8v2h-8zm0-3h8v2h-8z"/>
    </svg>
    KWITANSI PEMBAYARAN
</div>

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
