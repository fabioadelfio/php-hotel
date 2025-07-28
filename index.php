<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

$filtered_hotels = [];
$filter_parking = false;
$vote_min = 0;

$filter_parking = isset($_GET["parking"]);

$vote_min = isset($_GET['vote']) ? (int)$_GET['vote'] : 0;

foreach ($hotels as $hotel) {
    $parking_filter = !$filter_parking || $hotel['parking'] === true;
    $vote_filter = $hotel['vote'] >= $vote_min;
    if ($parking_filter && $vote_filter) {
        $filtered_hotels[] = $hotel;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>PHP Hotel</title>
</head>

<body class="bg-primary container">

    <h1 class="text-center p-5 fw-bold">LISTA HOTEL</h1>

    <form class="py-3 fs-4 justify-content-between" action="index.php" method="GET">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="parking" value="1" id="parking"
                <?php if ($filter_parking) echo 'checked'; ?>>
            <label class="form-check-label" for="parking">Solo con parcheggio</label>
        </div>
        <div class="form-group d-inline-block ms-3">
            <label for="vote">Voto minimo:</label>
            <input class="form-control d-inline-block w-auto" type="number" name="vote" id="vote" min="1" max="5"
                value="<?php echo isset($_GET['vote']) ? $_GET['vote'] : ''; ?>">
        </div>
        <button type="submit" class="btn btn-light btn-sm fw-bold fs-5">Filtra</button>
    </form>

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Hotel</th>
                <th scope="col">Description</th>
                <th scope="col">Parking</th>
                <th scope="col">Vote</th>
                <th scope="col">Distance to Center</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($filtered_hotels as $hotel) {
                echo "<tr>";
                echo "<th>" . $hotel['name'] . "</th>";
                echo "<td>" . $hotel['description'] . "</td>";
                echo "<td>" . ($hotel['parking'] ? 'Sì' : 'No') . "</td>";
                echo "<td>" . $hotel['vote'] . "</td>";
                echo "<td>" . $hotel['distance_to_center'] . " km</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>