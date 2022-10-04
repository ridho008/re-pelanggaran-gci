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
                Memperhatikan surat perjanjian PT.Garuda Cyber Indonesia tertanggal 01 Februari 2021, dengan ini Kepala personalia PT.Garuda Cyber Indonesia menginformasikan.
                Berdasarkan hasil evaluasi pemantauan dari Ketua Tim Pelaporan Kebersihan PT.Garuda Cyber Indonesia. Saudara/i {{ ucfirst($rpdf->fullname) }} selama bekerja sebagai karyawan dinyatakan melakukan tindakan pelanggaran kebersihan.
                Saudara/i {{ ucfirst($rpdf->fullname) }} juga tidak mempunyai empati terhadap lingkungan sekitar.
                Oleh karenanya Saudara/i {{ ucfirst($rpdf->fullname) }} diberikan Teguran Tertulis
            </p>
            <p>
                Demikian surat ini dibuat agar dilaksanakan dan disadari sebagaimana mestinya. <br>
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