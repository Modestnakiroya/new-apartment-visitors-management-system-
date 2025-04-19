<!DOCTYPE html>
<html>
<head>
    <title>Apartment Management Summary Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .summary-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: 20%;
            text-align: center;
            margin-bottom: 15px;
        }
        .blue { background-color: #e6f2ff; }
        .green { background-color: #e6ffe6; }
        .cyan { background-color: #e6ffff; }
        .yellow { background-color: #ffffcc; }
        .summary-card h2 {
            font-size: 28px;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section {
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        /* Print specific styles */
        @media print {
            body {
                padding: 0;
                font-size: 12px;
            }
            .print-controls {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-controls" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print();" style="padding: 8px 16px; background: #4CAF50; color: white; border: none; cursor: pointer;">
            Print Report
        </button>
    </div>

    <div class="header">
        <h1>Apartment Management Summary Report</h1>
        <p>Generated on: {{ $generatedDate }}</p>
    </div>

    <div class="summary-row">
        <div class="summary-card blue">
            <h3>TOTAL VISITORS</h3>
            <h2>{{ $totalVisitors }}</h2>
        </div>
        <div class="summary-card green">
            <h3>ACTIVE VISITORS</h3>
            <h2>{{ $activeVisitors }}</h2>
        </div>
        <div class="summary-card cyan">
            <h3>TOTAL RESIDENTS</h3>
            <h2>{{ $totalResidents }}</h2>
        </div>
        <div class="summary-card yellow">
            <h3>TOTAL APARTMENTS</h3>
            <h2>{{ $totalApartments }}</h2>
        </div>
    </div>

    <div class="section">
        <h2>Visitor Traffic (Last 7 Days)</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Number of Visitors</th>
                </tr>
            </thead>
            <tbody>
                @forelse($visitorTraffic as $traffic)
                <tr>
                    <td>{{ $traffic->date }}</td>
                    <td>{{ $traffic->count }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align: center;">No visitor data available for the last 7 days</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Most Visited Floors</h2>
        <table>
            <thead>
                <tr>
                    <th>Floor</th>
                    <th>Number of Visits</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mostVisitedFloors as $floor)
                <tr>
                    <td>{{ $floor->floor }}</td>
                    <td>{{ $floor->visits }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align: center;">No floor visit data available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>This is an automatically generated report from the Apartment Management System.</p>
    </div>
</body>
</html>
