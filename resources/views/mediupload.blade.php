<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-sm6">
                <div class="card">
                    <div class="card-header">Media Upload to Cloudniary</div>
                    <div class="card-body">
                        <form method="post" action="{{route('mediupload')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="exampleFormControlFile1">Selct File</label>
                              <input type="file" name="avatar" class="form-control" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn" style="background-color: teal;color:white;padding:5px;">Submit</button>
                            
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>