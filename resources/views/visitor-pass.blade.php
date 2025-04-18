<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 20px;
        }
        .pass-details {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .pass-details p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Visitor Pass</h2>
        </div>
        <div class="content">
            <p>Dear {{ $visitor['name'] }},</p>
            <p>Your visitor pass has been generated. Please present this pass to security upon arrival.</p>
            
            <div class="pass-details">
                <h3>Pass Details</h3>
                <p><strong>Pass ID:</strong> {{ $visitor['pass_id'] }}</p>
                <p><strong>Name:</strong> {{ $visitor['name'] }}</p>
                <p><strong>Phone:</strong> {{ $visitor['phone'] }}</p>
                @if($visitor['id_number'])
                    <p><strong>ID Number:</strong> {{ $visitor['id_number'] }}</p>
                @endif
                <p><strong>Visiting:</strong> {{ $visitor['resident_name'] }}</p>
                <p><strong>Apartment:</strong> {{ $visitor['apartment_number'] }}</p>
                <p><strong>Date & Time:</strong> {{ date('M d, Y H:i', strtotime($visitor['visit_date'] . ' ' . $visitor['visit_time'])) }}</p>
                <p><strong>Purpose:</strong> {{ $visitor['purpose'] . ($visitor['other_purpose'] ? ': ' . $visitor['other_purpose'] : '') }}</p>
            </div>
            
            <p>Thank you for registering your visit. Contact our security desk at (555) 123-4567 if needed.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Apartment Management. All rights reserved.</p>
        </div>
    </div>
</body>
</html>