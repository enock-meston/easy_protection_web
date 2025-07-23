<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
</head>
<body class="bg-gray-100 text-gray-800" style="font-family: Arial, sans-serif;">
    <table class="w-full" cellpadding="0" cellspacing="0">
        <tr>
            <td class="py-10 px-4 sm:px-0">
                <table class="max-w-xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="bg-blue-600 text-white text-center py-6">
                            <h1 class="text-2xl font-bold">Welcome to Our Platform</h1>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-8">
                            <p class="text-lg">Hi {{ $user->name }},</p>

                            <p class="mt-4">
                                🎉 We’re thrilled to have you on board. You've successfully joined our community and we can’t wait to see what you do with us!
                            </p>

                            <p class="mt-4">
                                If you have any questions or need help getting started, don’t hesitate to reach out to our support team.
                            </p>

                            <p class="mt-4">
                                Click below to visit your dashboard and explore your new account.
                            </p>

                            <div class="mt-6 text-center">
                                <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">Go to Dashboard</a>
                            </div>

                            <p class="mt-8 text-sm text-gray-500">
                                If you did not create this account, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray-100 text-center text-sm text-gray-500 py-4">
                            &copy; {{ date('Y') }} Your Company Name. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
