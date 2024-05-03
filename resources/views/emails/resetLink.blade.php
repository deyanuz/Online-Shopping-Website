<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>

<body>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h4 class="card-title text-center border-bottom mb-10">Reset Your Password</h4>
            <p class="card-text  text-center">A request to reset password from {{ $email }} has been made.</p>
            <p> We are providing the password reset link</p>
            <div class="text-center mt-5">
                <a href="{{ route('auth.resetPassword', ['token' => $token]) }}" class="btn btn-sm btn-primary">Reset
                    Password</a>
            </div>

        </div>
    </div>
</body>

</html>
