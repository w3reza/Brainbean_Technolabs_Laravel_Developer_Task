<!-- resources/views/users/create.blade.php -->

<form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
    @error('first_name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="{{ old('last_name') }}">
    @error('last_name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="username">Username:</label>
    <input type="text" name="username" value="{{ old('username') }}" required>
    @error('username')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="password">Password:</label>
    <input type="password" name="password" required>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="role">Role:</label>
    <input type="text" name="role" value="{{ old('role') }}" required>
    @error('role')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="photo">Photo:</label>
    <input type="file" name="photo">
    @error('photo')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit">Submit</button>
</form>
