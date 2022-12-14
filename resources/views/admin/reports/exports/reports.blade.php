
        <h1>Laporan Pelangaran PT.Garuda Cyber Indonesia</h1>
        <p>Dari Tanggal : {{ $fromDate }}</p>
        <p>Hingga Tanggal : {{ $toDate }}</p>
        <table>
           <thead>
              <tr>
                 <th>No</th>
                 <th>Pelaku</th>
                 <th>Pelapor</th>
                 <th>Judul</th>
                 <th>Jenis Pelanggaran</th>
                 <th>Deskripsi</th>
                 <th>Balasan</th>
                 <th>Tanggal Laporan</th>
              </tr>
           </thead>
           <tbody>
               @php $no = 1; @endphp
              @foreach($reports as $report)
               <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $report->user->fullname }}</td>
                  <td>{{ $report->report->fullname }}</td>
                  <td>{{ $report->title }}</td>
                  <td>{{ $report->typesViolations->name_violation }}</td>
                  <td>{{ strip_tags($report->description) }}</td>
                  <td>{{ $report->reply_comment ?? "kosong"; }}</td>
                  <td>{{ date('d-m-Y', strtotime($report->reporting_date)) }}</td>
               </tr>
              @endforeach
           </tbody>
        </table>