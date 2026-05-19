<!DOCTYPE html>
<html lang='es'>
<head>
 <meta charset='UTF-8'>
 <meta name='viewport' content='width=device-width, initial-scale=1'>
 <title>To-Do List</title>
 <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'
 rel='stylesheet'>
</head>
<body class='bg-light'>
 <nav class='navbar navbar-dark bg-dark mb-4'>
 <div class='container'>
 <a class='navbar-brand' href='/tareas'>To-Do List</a>
 <a class='nav-link text-white' href='/tareas/create'>+ Nueva tarea</a>
 </div>
 </nav>
 <div class='container'>
 @yield('content')
 </div>
 <script
src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'>
 </script>
</body>
</html>