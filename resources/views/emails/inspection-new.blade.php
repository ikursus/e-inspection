<!DOCTYPE html>
<html>
<head>
    <title>New Inspection Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2d3748;">New Inspection Notification</h2>
        
        <p>Dear {{ $inspection->user->name }},</p>

        <p>A new inspection has been created with the following details:</p>

        <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Inspection ID:</strong> {{ $inspection->id }}</p>
            <p><strong>User:</strong> {{ $inspection->user->name }}</p>
            <p><strong>Date:</strong> {{ $inspection->tarikh }}</p>
            <p><strong>Time:</strong> {{ $inspection->masa }}</p>
            <p><strong>Tempat:</strong> {{ $inspection->tempat }}</p>
            <p><strong>Tempat Sub:</strong> {{ $inspection->tempat_sub }}</p>
            <p><strong>Status:</strong> {{ $inspection->status }}</p>
        </div>

        <p>Please review the inspection details by clicking the button below:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('user.inspections.show', $inspection->id) }}" 
               style="background: #4299e1; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px;">
                View Inspection Details
            </a>
        </div>

        <p>If you have any questions or concerns, please don't hesitate to contact us.</p>

        <p>Best regards,<br>
        E-Inspection Team</p>
    </div>
</body>
</html>
