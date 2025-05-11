@extends('layouts.app')

@section('content')
    <div class="container">
        <style>
            .profile-card {
                width: 100%;
                max-width: 600px;
                margin: 40px auto;
                border-radius: 12px;
                background: #fff;
                box-shadow: 0 6px 12px rgba(0,0,0,0.1);
                padding: 30px;
            }

            .profile-card h3 {
                margin-bottom: 25px;
                text-align: center;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                font-weight: 500;
                margin-bottom: 8px;
                display: block;
            }

            .form-control {
                width: 100%;
                padding: 10px;
                border-radius: 6px;
                border: 1px solid #ccc;
            }

            .btn {
                padding: 10px 20px;
                font-size: 1rem;
                border: none;
                border-radius: 6px;
                cursor: pointer;
            }

            .btn-primary {
                background-color: #007bff;
                color: white;
                margin-bottom: 15px;
            }

            .btn-success {
                background-color: #28a745;
                color: white;
                margin-bottom: 15px;

            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
                margin-bottom: 15px;

            }

            .d-grid {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }
        </style>

        <div class="profile-card">
            <h3>Jūsų paskyra</h3>

            <!-- Display profile information -->
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Atnaujinti paskyra</button>
                </div>
            </form>

            <hr>
            <br>

            <!-- Change Password Form -->
           
            <form method="POST" action="{{ route('profile.changePassword') }}">
    @csrf

    <div class="form-group">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" name="current_password" id="current_password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">New Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-success">Change Password</button>
    </div>
</form>



            <hr>
            <br>


            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="form-group">
                    <label for="password" class="form-label">Confirm your password to delete your account</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
@endsection
