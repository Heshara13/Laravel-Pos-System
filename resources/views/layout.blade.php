<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('libraries.styles')
   
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><h3>Pos System</h3></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{url('/category')}}">Category</a>
                    <a class="nav-link active" aria-current="page" href="{{url('/brand')}}">Brand</a>
                    <a class="nav-link active" aria-current="page" href="#">Product</a>
                    <a class="nav-link active" aria-current="page" href="#">Sales</a>
                    
                </div>
                </div>
            </div>
        </nav>
        </div>
        <div>
                @yield('content')
        </div>


        </div>
</div>
    @include('libraries.scripts')
    
</body>
</html>