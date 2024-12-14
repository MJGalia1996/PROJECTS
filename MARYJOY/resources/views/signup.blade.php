<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Add Laravel's CSS link -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="background: linear-gradient(to right, #74ebd5, #acb6e5); font-family: 'Poppins', sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 400px; margin: 50px auto; padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: center; margin-bottom: 20px;">
            <i class="fas fa-user-plus" style="font-size: 3rem; color: #007bff;"></i>
        </div>
        <h1 style="text-align: center; font-size: 2rem; color: #333333;">Create an Account</h1>
        <p style="text-align: center; color: #666666;">Join us and start your journey today!</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf <!-- CSRF Token -->
            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: 500;"><i class="fas fa-user" style="margin-right: 5px;"></i> Full Name</label>
                <input type="text" name="name" id="name" style="width: 100%; padding: 10px; border: 1px solid #cccccc; border-radius: 5px;" placeholder="Enter your full name" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: 500;"><i class="fas fa-envelope" style="margin-right: 5px;"></i> Email Address</label>
                <input type="email" name="email" id="email" style="width: 100%; padding: 10px; border: 1px solid #cccccc; border-radius: 5px;" placeholder="Enter your email" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: 500;"><i class="fas fa-lock" style="margin-right: 5px;"></i> Password</label>
                <input type="password" name="password" id="password" style="width: 100%; padding: 10px; border: 1px solid #cccccc; border-radius: 5px;" placeholder="Enter your password" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: 500;"><i class="fas fa-lock" style="margin-right: 5px;"></i> Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" style="width: 100%; padding: 10px; border: 1px solid #cccccc; border-radius: 5px;" placeholder="Confirm your password" required>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <button type="submit" style="padding: 10px 20px; font-size: 1rem; border: none; border-radius: 5px; background-color: #007bff; color: #ffffff; cursor: pointer; transition: background-color 0.3s;">
                    Sign Up <i class="fas fa-user-plus"></i>
                </button>
            </div>
        </form>

        <p style="text-align: center; margin-top: 15px; color: #666666;">
            Already have an account? <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">Login here</a>.
        </p>
    </div>
</body>
</html>
