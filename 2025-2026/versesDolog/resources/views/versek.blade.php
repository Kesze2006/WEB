<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title> Az oldal neve </title>
</head>
<body>
     <div class="container py-5">
        <h1 class="mb-4 text-center">Költők és verseik</h1>

        @foreach($koltok as $kolto)
            <div class="card mb-3 shadow-sm">
                <div class="card-header">
                    <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapse{{ $kolto->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $kolto->id }}">
                        {{ $kolto->nev }}
                    </a>
                </div>
                <div class="collapse" id="collapse{{ $kolto->id }}">
                    <div class="card-body">
                        @foreach($kolto->versek as $vers)
                            <div class="mb-3">
                                <h5>{{ $vers->cim }}</h5>
                                <ul>
                                    @foreach($vers->versszakok as $verszak)
                                        {{ $verszak->tartalom }}
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>