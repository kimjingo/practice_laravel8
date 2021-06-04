<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
{{ session('success')}}
<div class="max-w-md mx-auto py-8">
    <form action="{{ url('aimg') }}" class="flex items-center justify-between border border-gray-300 p-4 rounded" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" name="image" id="exampleInputFile">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 p-4 rounded">Submit</button>
    </form>
</div>
</body>
</html>