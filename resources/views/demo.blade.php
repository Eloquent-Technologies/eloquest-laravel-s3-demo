@php
function human_filesize($bytes, $decimals = 2) {
    $size = ['B','kB','MB','GB','TB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Eloquent Laravel S3 Demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="my-5 text-center text-secondary">Eloquent S3 Demo</h1>
                </div>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col my-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Upload a new file</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('file-upload') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <input type="file" name="file" id="file">
                                </div>

                                <button class="btn btn-primary" type="submit" id="submit">Upload File</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col my-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Uploaded files</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Last Modified</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Storage::allFiles() as $index => $file)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $file }}</td>
                                        <td>
                                            @php
                                                $bytes = Storage::size($file);
                                                $size = ['B','kB','MB','GB','TB'];
                                                $factor = (int) floor((strlen($bytes) - 1) / 3);
                                                echo sprintf('%.2f', $bytes / (1024 ** $factor)) . $size[$factor];
                                            @endphp
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->format('d/m/Y H:i:s') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('download-file', ['file' => $file]) }}">Download</a> |
                                            <a href="{{ route('delete-file', ['file' => $file]) }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
