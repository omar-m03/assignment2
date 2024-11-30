<?php
//Data Retrieval
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

$response = file_get_contents($URL); // we gather the data from the URL
$result = json_decode($response, true); // cheacking the JSON response

// Checking if data retrieval was successful
if ($result && isset($result['results'])) {
    $data = $result['results'];
} else {
    $data = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/pico.css">
    <title>Student Statistics</title>
    <style>
        /* Custom styles for overflow handling */
        table {
            width: 100%;
            border-collapse: collapse;
            overflow: auto;
        }
        th, td {
            padding: 0.5em;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Statistics of Students Enrolled in Bachelor Programs</h1>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['year']); ?></td>
                            <td><?php echo htmlspecialchars($row['semester']); ?></td>
                            <td><?php echo htmlspecialchars($row['the_programs']); ?></td>
                            <td><?php echo htmlspecialchars($row['nationality']); ?></td>
                            <td><?php echo htmlspecialchars($row['colleges']); ?></td>
                            <td><?php echo htmlspecialchars($row['number_of_students']); ?></td>
                            
                            
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>