<!DOCTYPE html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Formulir Data Produk </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- axios --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    {{-- CSS --}}
    <style>
        body {
            margin: 0px;
            padding: 0px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f2f2f2; /* Warna latar belakang abu-abu */
        }

        table {
            background-color: #ffffff; /* Warna latar belakang formulir */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .bgfff {
            background-color: #fff;
            padding: 20px
        }
    </style>
  </head>

  <body>
    @if(session()->has('success'))
      <div class="alert alert-success" role="alert">
          {{ session('success') }}
      </div>
    @endif

  <div class="container">
    <a href="/brands-login">
     <button type="button" class="btn btn-success mb-3">Login</button>
    </a>

<div class="div">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link">Logout</button>
    </form>
</div>
    
  <div class="bgfff">
    <a href="/brands-create">
     <button type="button" class="btn btn-success mb-3">Create</button>
    </a>

    <table id="datatablesSimple" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Description</th>
                <th>author</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand) <!-- Menggunakan $brands sesuai dengan key yang diberikan di kontroler -->
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $brand->brand }}</td>
                    <td>{{ $brand->description }}</td>
                    <td>{{ $brand->writer->username }}</td>
                    <td>
                        <a href="/brands/{{ $brand->id }}/edit" class="badge bg-warning">Edit</i></a>
                        <form action="/brands/{{ $brand->id }}/destroy" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
  </div>
 </div>


     
     
    {{-- JavaScript --}}
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable();
        });
    </script>

  </body>
</html>