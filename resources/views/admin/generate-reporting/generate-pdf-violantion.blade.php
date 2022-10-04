<!DOCTYPE html>
<html>
<head>
    <title>Pelanggaran Kebersihan PT.Garuda Cyber Indonesia</title>
    <style>
        th {
            float: left;
        }

        h1, p {text-align: center;}

        table {
        border-collapse: collapse;
        width: 100%;
        }
    </style>
</head>
<body>
        <h1>{{ $title }}</h1>
        <p>{{ $address }}</p>
        <hr>
        <table cellspacing="0" cellpadding="10">
            <tr>
                <th>Judul</th>
                <td><strong>:</strong></td>
                <td>{{ $report->title }}</td>
            </tr>
            <tr>
                <th>Jenis Pelanggar</th>
                <td><strong>:</strong></td>
                <td>{{ $report->typesViolations->name_violation }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td><strong>:</strong></td>
                <td>{{ $report->description }}</td>
            </tr>
            <tr>
                <th>Nama Pelanggar</th>
                <td><strong>:</strong></td>
                <td>{{ $report->user->fullname }}</td>
            </tr>
            <tr>
                <th>Tanggal Pelaporan</th>
                <td><strong>:</strong></td>
                <td>{{ date('d-m-y', strtotime($report->reporting_date)) }}</td>
            </tr>
            <tr>
                <th>Point</th>
                <td><strong>:</strong></td>
                <td>{{ $report->typesViolations->sum_points }}</td>
            </tr>
            <tr>
                <th>Pesan</th>
                <td><strong>:</strong></td>
                <td>{{ ($report->reply_comment ? $report->reply_comment : 'Belum ada pesan.') }}</td>
            </tr>
        </table>

        <!-- Peringatan -->
        <div class="peringatan">
            <div class="title"><strong>* Peringatan :</strong></div>
            <ol>
                <li>Wajib mengikuti peraturan di perusahaan.</li>
                <li>Bila point telah mencapai jumlah 10, akan diberitahu surat peringatan pertama.</li>
                <li>Bila point telah mencapai jumlah 20, akan diberitahu surat peringatan kedua.</li>
            </ol>
        </div>

        <table border="0" cellpadding="" cellspacing="">
        <tr>
        <td width="200px" align="center">Dibuat Oleh,<br><br><br>
        <br><br>Admin Kebersihan GCI
        </td>
        <td width="280px" align="center"></td>
        <td width="200px" align="center">Mengetahui,<br><br><br>
        <br><br>........
        </td>
        </tr>
        </table>
</body>
</html>