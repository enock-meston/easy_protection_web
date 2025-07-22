<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your New Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f2f5; margin: 0; padding: 20px;">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; padding: 30px;">
          <tr>
            <td align="center">
              <!-- Replace with your actual full URL to the logo -->
              <img src="https://yourdomain.com/images/logo.png" alt="Logo" style="width: 80px; margin-bottom: 20px;">
            </td>
          </tr>
          <tr>
            <td>
              <h2 style="color: #333333; text-align: center;">🔐 Your New Password</h2>
              <p style="color: #555555; font-size: 16px;">Hello <strong>{{ $user->name }}</strong>,</p>
              <p style="color: #555555; font-size: 16px;">
                We have generated a new password for your account. You can now use the password below to log in:
              </p>
              <p style="font-size: 20px; font-weight: bold; color: #007bff; text-align: center; margin: 20px 0;">
                {{ $newPassword }}
              </p>
              <p style="color: #555555; font-size: 16px;">
                For your security, we recommend changing this password immediately after logging in.
              </p>
              <p style="color: #555555; font-size: 16px;">If you did not request this password reset, please contact our support team.</p>
              <br>
              <p style="color: #555555; font-size: 16px;">
                Best regards,<br>
                <strong>{{ config('app.name') }} Team</strong>
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
