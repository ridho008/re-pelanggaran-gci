@php


@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garuda Report Team</title>
    <style>
        .container-fluid-email {
          width: 100%;
          display: flex;
          justify-content: center;
          flex-direction: column;
          box-sizing: border-box;
          margin: 30px auto;
        }

        .container-email {
          border: 2px solid #eee;
          border-radius: 10px;
          padding: 20px;
        }

        .container-email > div {
          text-align: center;
        }

        .button-email {
          background-color: #ec2127;
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 14px;
          border-radius: 3px;
        }

        hr {
          color: #eee;
        }

        .footer-email {
          color: #ddd;
          padding: 20px;
          color: rgba(55, 65, 81);
        }
    </style>
</head>
<body>
    <div class="container-fluid-email">
        <div class="container-email">
            <div class="title">
                <img src="https://i.ibb.co/LgrtnTQ/gcyber-logo.png" alt="Logo Garuda Cyber">
                <h1>Hai {{ $data['name'] }}, Pelanggaran Kebersihan PT.Garuda Cyber Indonesia</h1>
                <p>{{ $data['email'] }}</p>
            </div>
            <hr>
            <div class="messages">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Quia aperiam ab mollitia temporibus eveniet distinctio, id beatae quos, itaque quasi. Atque repellat hic, error vel nobis alias asperiores perspiciatis vitae?</p>
                <a href="{{ url('/login') }}" class="button-email">Login, untuk melihat pelanggaran</a>
            </div>
            <div class="footer-email">
                <p>Anda menerima email ini untuk memberi tahu anda tentang pelanggaran penting Garuda Report Team</p>
                <div class="footer-child">
                    <p>&copy; {{ date('Y') }} Garuda Cyber Report, Jl. HR. Soebrantas No.188, Sidomulyo Bar., Kec. Tampan, Kota Pekanbaru, Riau 28293, Telepon: (0761) 6704399</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>   