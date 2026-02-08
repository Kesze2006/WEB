<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Költők listája</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container py-5">
    <h1 class="mb-4 text-center">Költők listája</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($koltok as $kolto)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/' . $kolto->kep) }}" class="card-img-top" alt="">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $kolto->nev }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
