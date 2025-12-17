<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Resit Tempahan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 15px;
            background-color: #2d7a4f;
            color: white;
            border: 2px solid #000;
        }

        .header h2 {
            margin: 0 0 5px 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0;
        }

        .info-section {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #000;
        }

        .info-section p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
            background-color: #2d7a4f;
            color: white;
            font-weight: bold;
            width: 30%;
        }

        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .time-slot {
            display: block;
            padding: 3px 0;
        }

        .status {
            padding: 4px 8px;
            background-color: #e8f5e9;
            border: 1px solid #2d7a4f;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        .signature-section {
            margin-top: 50px;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 60px;
            padding-top: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>RESIT TEMPAHAN BILIK</h2>
        <p>Sistem Tempahan Bilik Mesyuarat - STBM MAIM</p>
        <p>Resit No: BTH-<?= date('YmdHis') ?></p>
    </div>

    <div class="info-section">
        <p><strong>Nama:</strong> <?= esc($booking['username']) ?></p>
        <p><strong>No Staf:</strong> <?= esc($booking['staffno']) ?></p>
        <p><strong>Tarikh:</strong> <?= date('d-m-Y', strtotime($booking['date'])) ?></p>
        <p><strong>Dijana:</strong> <?= date('d-m-Y H:i:s') ?></p>
    </div>

    <table>
        <tr>
            <th>Bilik</th>
            <td><?= esc($booking['roomName']) ?></td>
        </tr>

        <tr>
            <th>Masa</th>
            <td>
                <?php foreach ($mergedSlots as $slot): ?>
                    <span class="time-slot"><?= esc($slot) ?></span>
                <?php endforeach; ?>

            </td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                <?php
                $status = strtolower($booking['status']);
                $statusColor = match ($status) {
                    'approved' => '#d4edda', 
                    'rejected' => '#f8d7da', 
                    default    => '#e2e3e5',
                };
                $textColor = match ($status) {
                    'approved' => '#155724',
                    'rejected' => '#721c24',
                    default    => '#383d41', 
                };
                ?>
                <span style="background-color: <?= $statusColor ?>; color: <?= $textColor ?>; padding: 4px 8px; border-radius: 4px; font-weight: bold;">
                    <?= strtoupper(esc($booking['status'])) ?>
                </span>
            </td>
        </tr>


        <tr>
            <th>Sebab Tempahan</th>
            <td><?= esc($booking['reason']) ?></td>
        </tr>
    </table>

    <!--
    <div class="signature-section">
        <table style="border: none;">
            <tr>
                <td style="width: 50%; border: none; text-align: center;">
                    <div class="signature-line">Tandatangan Pemohon</div>
                </td>
                <td style="width: 50%; border: none; text-align: center;">
                    <div class="signature-line">Tandatangan Pentadbir</div>
                </td>
            </tr>
        </table>
    </div>
                -->

    <div class="footer">
        <p><strong>Majlis Agama Islam Melaka (MAIM)</strong></p>
        <p>Dokumen ini dijana secara automatik. Untuk pertanyaan, hubungi Bahagian IT.</p>
        <p>Dicetak: <?= date('d-m-Y H:i:s') ?></p>
    </div>

</body>

</html>