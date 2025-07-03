<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$pageTitle = "Senarai Pelajar";

$students = [
    [
        'nama' => 'Ali Bin Ahmad',
        'umur' => 20,
        'email' => 'ali.ahmad@example.com'
    ],
    [
        'nama' => 'Siti Nurhaliza',
        'umur' => 22,
        'email' => 'siti.nurhaliza@example.com'
    ],
    [
        'nama' => 'Ahmad Faizal',
        'umur' => 21,
        'email' => 'ahmad.faizal@example.com'
    ],
    [
        'nama' => 'Nur Aisyah',
        'umur' => 23,
        'email' => 'nur.aisyah@example.com'
    ],
    [
        'nama' => 'Mohd Hafiz',
        'umur' => 19,
        'email' => 'mohd.hafiz@example.com'
    ]
];
?>

<h1>
    <?php echo $pageTitle; ?>
</h1>

<h1>
    {{ $pageTitle }}
</h1>


<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Umur</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo $student['nama']; ?></td>
                <td><?php echo $student['umur']; ?></td>
                <td><?php echo $student['email']; ?></td>
            </tr>
        <?php endforeach; ?>
        
        @foreach ($students as $student)
            <tr>
                <td>{{ $student['nama'] }}</td>
                <td>{{ $student['umur'] }}</td>
                <td>{{ $student['email'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>