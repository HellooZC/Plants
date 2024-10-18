<?php include 'session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plant Contributions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
    <section class="intro-menu">
        <div class="intro-content">
            <h1>Contribution Page</h1>
            <p>This portal allows users to explore plant classifications, learn how to preserve plant specimens, and contribute to biodiversity data. Use the options below to navigate through the platform and engage in the world of plants.</p>
        </div>
        <div class="intro-image">
            <img src="images/images2.jpeg" alt="Plants Image">
        </div>
    </section>
    <main class="page-content">
        <?php
            $file = fopen('data/herbarium.txt', 'r');

            while (($line = fgets($file)) !== false) {
                $plantData = explode('|', $line);
                $plantId = $plantData[0];
                $scientificName = $plantData[1];
                $commonName = $plantData[2];
                $plantPhoto = $plantData[3];

                echo '
                <div class="card" style="background-image: url(' . $plantPhoto . ');">
                    <div class="card-content">
                        <h2 class="title">' . $scientificName . '</h2>
                        <p class="copy">Common Name: ' . $commonName . '</p>
                        <a href="plant_detail.php?id=' . $plantId . '" class="btn">View Details</a>
                    </div>
                </div>';
            }

            fclose($file);
        ?>
    </main>
</body>
</html>