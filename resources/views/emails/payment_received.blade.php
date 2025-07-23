<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Payment Received</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; margin: 40px auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden;">
        <tr>
            <td style="background-color: #4F46E5; color: white; padding: 20px 30px; text-align: center;">
                <h1 style="margin: 0; font-size: 24px;">💳 Payment Notification</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <h2 style="margin-bottom: 10px; color: #333;">New Payment Received</h2>
                <p style="color: #666; font-size: 15px;">Here are the details of the received payment:</p>

                <table width="100%" cellpadding="10" cellspacing="0" style="margin-top: 20px;">
                    <tr>
                        <td style="font-weight: bold; color: #555;">User ID:</td>
                        <td style="color: #333;">{{ $payment->user_id }}</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td style="font-weight: bold; color: #555;">Amount:</td>
                        <td style="color: #333;">{{ $payment->amount }} RWF</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #555;">Status:</td>
                        <td style="color: #333;">{{ ucfirst($payment->status) }}</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td style="font-weight: bold; color: #555;">Date:</td>
                        <td style="color: #333;">{{ $payment->created_at->format('d M Y - H:i') }}</td>
                    </tr>
                </table>

                <p style="margin-top: 30px; color: #888; font-size: 14px;">This is an automated notification from <strong>{{ config('app.name') }}</strong>.</p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; text-align: center; padding: 15px; font-size: 12px; color: #999;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
