<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Formulir Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f2f2f2;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="">
        <a class="pb-1" href="/brands">Back</a>
        <form action="{{ route('brands.store') }}" method="post" class="">
            <center><h3>Create</h3></center><hr>
            @csrf
            <!-- Input untuk kolom 'brand' -->
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>

            <!-- Input untuk kolom 'description' -->
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" maxlength="255" required>

            <!-- Input untuk kolom 'author' -->
            <label for="author">Author ID:</label>
            <input type="number" id="author" name="author" required>

            <!-- Input untuk kolom 'Province' -->
            <label for="province">Province:</label>
            <select name="province" id="province">
                <option value="Pilih Province">Pilih Province</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                @endforeach
            </select>

            <!-- Input untuk kolom 'City' -->
            <label for="city">City:</label>
            <select name="city" id="city">
                <option value="Pilih City">Pilih City</option>
                @foreach ($cities as $city)
                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                @endforeach
            </select>

            <!-- Tombol untuk mengirimkan formulir -->
            <input type="submit" value="Submit">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
