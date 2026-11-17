
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Practice Form</title>
</head>
<body>

    <h1>Student Information Form</h1>

    <form action="{{ route('practice.form.submit') }}" method="POST">
        @csrf

        <!-- Name -->
        <label for="name">Name:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
        >

        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <!-- Email -->
        <label for="email">Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
        >

        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <!-- City -->
        <label for="city">City:</label>
        <input
            type="text"
            id="city"
            name="city"
            value="{{ old('city') }}"
        >

        @error('city')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Submit</button>

    </form>

</body>
</html>
