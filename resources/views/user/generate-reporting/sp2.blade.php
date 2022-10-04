<!DOCTYPE html>
<html>
<head>
    <title>Pelanggaran Kebersihan PT.Garuda Cyber Indonesia</title>
    <style>
        th {
            float: left;
        }

        h1 {text-align: center;}

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
        @foreach($reportPDF as $rpdf)
        <div class="perihal">
            <p>
                Kepada Yth. <br>
                {{ ucfirst($rpdf->fullname) }} <br>
                Karyawan PT.Garuda Cyber Indonesia <br>
                di Tempat
            </p>
        </div>
        
        <div class="pesan">
            <p>
                Bersama dengan surat ini, perusahaan harus menyampaikan surat peringatan kedua (SP-2) sebagai tindak lanjut dari surat peringatan pertama (SP-1) yang sebelumnya disampaikan kepada Saudara/i {{ ucfirst($rpdf->fullname) }}. Namun, Saudara/i {{ ucfirst($rpdf->fullname) }} tidak memberikan perbaikan atas surat peringatan tersebut.
            </p>
            <p>
                Agar Saudari Linda dapat memperbaiki sikap dan bekerja dengan profesional kembali.
                Apabila dengan adanya Surat Peringatan 2 ini, Saudara/i {{ ucfirst($rpdf->fullname) }} masih belum menunjukan respon  yang baik, maka perusahaan akan mengeluarkan SP-3 yang berarti pemutusan kerja sama.
            </p>
            <p>
                Demikian Surat Peringatan 2 ini diterbitkan supaya dapat ditaati sebagaimana harusnya. Untuk Saudara/i {{ ucfirst($rpdf->fullname) }} diharapkan agar menunjukan peningkatan sikap yang baik dan profesional. <br>
                Pekanbaru, {{ date("d-m-Y") }}
            </p>
        </div>


        <table border="0" cellpadding="" cellspacing="">
            <tr>
                <td width="200px">Dibuat Oleh,<br><br><br>
                <br><br>Admin Kebersihan GCI
                </td>
            </tr>
        </table>
        @endforeach
</body>
</html>