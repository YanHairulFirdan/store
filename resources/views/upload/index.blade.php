<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload image using job</title>
</head>

<body>
    @if (Session::has('message'))
        {{ Session::get('message') }}
    @endif
    <form action="route('image')" method="post" enctype="multipart/form-data">
        <input type="file" name="demo_image" id="">
        <br>
        <button type="submit">submit</button>
    </form>
</body>

</html>
