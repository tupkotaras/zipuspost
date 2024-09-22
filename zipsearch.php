<?php
// Функція для пошуку інформації за zip_code
function findLocationByZipCode($zipCode, $jsonData) {
    foreach ($jsonData as $location) {
        if ($location['zip_code'] == $zipCode) {
            return [
                'city' => $location['city'],
                'state' => $location['state'],
                'county' => $location['county']
            ];
        }
    }
    return null; // Якщо не знайдено
}


$jsonFilePath = 'USCities';
$jsonData = json_decode(file_get_contents($jsonFilePath), true);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['zip_code'])) {
    $zipCode = (int)$_POST['zip_code'];

    // Пошук міста, штату і округу за zip_code
    $location = findLocationByZipCode($zipCode, $jsonData);

    if ($location) {
        // Вивести знайдену інформацію
        echo "City: " . $location['city'] . "<br>";
        echo "State: " . $location['state'] . "<br>";
        echo "County: " . $location['county'] . "<br>";
    } else {
        echo "Location not found for zip code: $zipCode";
    }
} else {
    echo "Please provide a zip_code in the POST request.";
}
?>
