Click Here to Reset your Password: <br>
Click <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a> to reset your password.