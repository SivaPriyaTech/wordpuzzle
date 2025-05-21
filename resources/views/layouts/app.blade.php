<!DOCTYPE html>
<html>
<head>
  <title>My Laravel App</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @if (session('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
  @endif

  @yield('content')
</body>
</html>