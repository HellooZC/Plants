<?php include 'session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Detail - Plant Biodiversity</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php' ?>

    <main>
        <section class="plant-detail">
            <?php
            $id = $_GET['id'];
            $file = fopen("data/herbarium.txt", "r");

            $selectedPlant = null;

            // Loop through each line to find the plant by ID
            while (($line = fgets($file)) !== false) {
                $plant = explode("|", trim($line));
                if ($plant[0] == $id) {
                    $selectedPlant = $plant;
                    break;
                }
            }

            // Close the file
            fclose($file);

            // If the plant is found, display its details
            if ($selectedPlant !== null) {
                echo '
                <div class="grid product">
                <div class="column-xs-12 column-md-7">
                    <div class="product-gallery">
                    <div class="product-image">
                        <img class="active" src="' . $selectedPlant[3] . '">
                    </div>
                    <ul class="image-list">
                        <li class="image-item"><img src="' . $selectedPlant[4] . '"></li>
                        <li class="image-item"><img src="' . $selectedPlant[5] . '"></li>
                        <li class="image-item"><img src="' . $selectedPlant[3] . '"></li>
                    </ul>
                    </div>
                </div>
                <div class="column-xs-12 column-md-5">
                    <h1>' . $selectedPlant[1] . '</h1>
                    <h2>' . $selectedPlant[2] . '</h2>
                    <div class="description">
                    <p><strong>Family:</strong> ' . $selectedPlant[6] . '</p>
                    <p>By contrast with other plant cultivation practices, bonsai is not intended for production of food or for medicine. Instead, bonsai practice focuses on long-term cultivation and shaping of one or more small trees growing in a container.</p>
                    </div>
                    <!-- Link to generate the PDF -->
                    <a class="add-to-cart" href="generate_pdf.php?id=' . $id . '" target="_blank">Download Description (PDF)</a>
                </div>
                </div>';
            } else {
                echo '<p>Plant not found.</p>';
            }
            ?>
        </section>
    </main>
</body>
</html>

<script>
const activeImage = document.querySelector(".product-image .active");
const productImages = document.querySelectorAll(".image-list img");
const navItem = document.querySelector('a.toggle-nav');

function changeImage(e) {
  activeImage.src = e.target.src;
}

function toggleNavigation(){
  this.nextElementSibling.classList.toggle('active');
}

productImages.forEach(image => image.addEventListener("click", changeImage));
navItem.addEventListener('click', toggleNavigation);
</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Pontano+Sans");
.container {
  margin: auto;
  padding: 0 1rem;
  max-width: 71.25rem;
  width: 100%;
}

.grid {
  display: flex;
  flex-direction: column;
  flex-flow: row wrap;
}
.grid > [class*=column-] {
  display: block;
}

.first {
  order: -1;
}

.last {
  order: 12;
}

.align-top {
  align-items: start;
}

.align-center {
  align-items: center;
}

.align-bottom {
  align-items: end;
}

.column-xs-1 {
  flex-basis: 8.3333333333%;
  max-width: 8.3333333333%;
}

.column-xs-2 {
  flex-basis: 16.6666666667%;
  max-width: 16.6666666667%;
}

.column-xs-3 {
  flex-basis: 25%;
  max-width: 25%;
}

.column-xs-4 {
  flex-basis: 33.3333333333%;
  max-width: 33.3333333333%;
}

.column-xs-5 {
  flex-basis: 41.6666666667%;
  max-width: 41.6666666667%;
}

.column-xs-6 {
  flex-basis: 50%;
  max-width: 50%;
}

.column-xs-7 {
  flex-basis: 58.3333333333%;
  max-width: 58.3333333333%;
}

.column-xs-8 {
  flex-basis: 66.6666666667%;
  max-width: 66.6666666667%;
}

.column-xs-9 {
  flex-basis: 75%;
  max-width: 75%;
}

.column-xs-10 {
  flex-basis: 83.3333333333%;
  max-width: 83.3333333333%;
}

.column-xs-11 {
  flex-basis: 91.6666666667%;
  max-width: 91.6666666667%;
}

.column-xs-12 {
  flex-basis: 100%;
  max-width: 100%;
}

@media (min-width: 48rem) {
  .column-sm-1 {
    flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .column-sm-2 {
    flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .column-sm-3 {
    flex-basis: 25%;
    max-width: 25%;
  }

  .column-sm-4 {
    flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .column-sm-5 {
    flex-basis: 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .column-sm-6 {
    flex-basis: 50%;
    max-width: 50%;
  }

  .column-sm-7 {
    flex-basis: 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .column-sm-8 {
    flex-basis: 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .column-sm-9 {
    flex-basis: 75%;
    max-width: 75%;
  }

  .column-sm-10 {
    flex-basis: 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .column-sm-11 {
    flex-basis: 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .column-sm-12 {
    flex-basis: 100%;
    max-width: 100%;
  }
}
@media (min-width: 62rem) {
  .column-md-1 {
    flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .column-md-2 {
    flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .column-md-3 {
    flex-basis: 25%;
    max-width: 25%;
  }

  .column-md-4 {
    flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .column-md-5 {
    flex-basis: 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .column-md-6 {
    flex-basis: 50%;
    max-width: 50%;
  }

  .column-md-7 {
    flex-basis: 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .column-md-8 {
    flex-basis: 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .column-md-9 {
    flex-basis: 75%;
    max-width: 75%;
  }

  .column-md-10 {
    flex-basis: 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .column-md-11 {
    flex-basis: 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .column-md-12 {
    flex-basis: 100%;
    max-width: 100%;
  }
}
@media (min-width: 75rem) {
  .column-lg-1 {
    flex-basis: 8.3333333333%;
    max-width: 8.3333333333%;
  }

  .column-lg-2 {
    flex-basis: 16.6666666667%;
    max-width: 16.6666666667%;
  }

  .column-lg-3 {
    flex-basis: 25%;
    max-width: 25%;
  }

  .column-lg-4 {
    flex-basis: 33.3333333333%;
    max-width: 33.3333333333%;
  }

  .column-lg-5 {
    flex-basis: 41.6666666667%;
    max-width: 41.6666666667%;
  }

  .column-lg-6 {
    flex-basis: 50%;
    max-width: 50%;
  }

  .column-lg-7 {
    flex-basis: 58.3333333333%;
    max-width: 58.3333333333%;
  }

  .column-lg-8 {
    flex-basis: 66.6666666667%;
    max-width: 66.6666666667%;
  }

  .column-lg-9 {
    flex-basis: 75%;
    max-width: 75%;
  }

  .column-lg-10 {
    flex-basis: 83.3333333333%;
    max-width: 83.3333333333%;
  }

  .column-lg-11 {
    flex-basis: 91.6666666667%;
    max-width: 91.6666666667%;
  }

  .column-lg-12 {
    flex-basis: 100%;
    max-width: 100%;
  }
}
@supports (display: grid) {
  .grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    grid-template-rows: auto;
  }
  .grid > [class*=column-] {
    margin: 0;
    max-width: 100%;
  }

  .column-xs-1 {
    grid-column-start: span 1;
    grid-column-end: span 1;
  }

  .column-xs-2 {
    grid-column-start: span 2;
    grid-column-end: span 2;
  }

  .column-xs-3 {
    grid-column-start: span 3;
    grid-column-end: span 3;
  }

  .column-xs-4 {
    grid-column-start: span 4;
    grid-column-end: span 4;
  }

  .column-xs-5 {
    grid-column-start: span 5;
    grid-column-end: span 5;
  }

  .column-xs-6 {
    grid-column-start: span 6;
    grid-column-end: span 6;
  }

  .column-xs-7 {
    grid-column-start: span 7;
    grid-column-end: span 7;
  }

  .column-xs-8 {
    grid-column-start: span 8;
    grid-column-end: span 8;
  }

  .column-xs-9 {
    grid-column-start: span 9;
    grid-column-end: span 9;
  }

  .column-xs-10 {
    grid-column-start: span 10;
    grid-column-end: span 10;
  }

  .column-xs-11 {
    grid-column-start: span 11;
    grid-column-end: span 11;
  }

  .column-xs-12 {
    grid-column-start: span 12;
    grid-column-end: span 12;
  }

  @media (min-width: 48rem) {
    .column-sm-1 {
      grid-column-start: span 1;
      grid-column-end: span 1;
    }

    .column-sm-2 {
      grid-column-start: span 2;
      grid-column-end: span 2;
    }

    .column-sm-3 {
      grid-column-start: span 3;
      grid-column-end: span 3;
    }

    .column-sm-4 {
      grid-column-start: span 4;
      grid-column-end: span 4;
    }

    .column-sm-5 {
      grid-column-start: span 5;
      grid-column-end: span 5;
    }

    .column-sm-6 {
      grid-column-start: span 6;
      grid-column-end: span 6;
    }

    .column-sm-7 {
      grid-column-start: span 7;
      grid-column-end: span 7;
    }

    .column-sm-8 {
      grid-column-start: span 8;
      grid-column-end: span 8;
    }

    .column-sm-9 {
      grid-column-start: span 9;
      grid-column-end: span 9;
    }

    .column-sm-10 {
      grid-column-start: span 10;
      grid-column-end: span 10;
    }

    .column-sm-11 {
      grid-column-start: span 11;
      grid-column-end: span 11;
    }

    .column-sm-12 {
      grid-column-start: span 12;
      grid-column-end: span 12;
    }
  }
  @media (min-width: 62rem) {
    .column-md-1 {
      grid-column-start: span 1;
      grid-column-end: span 1;
    }

    .column-md-2 {
      grid-column-start: span 2;
      grid-column-end: span 2;
    }

    .column-md-3 {
      grid-column-start: span 3;
      grid-column-end: span 3;
    }

    .column-md-4 {
      grid-column-start: span 4;
      grid-column-end: span 4;
    }

    .column-md-5 {
      grid-column-start: span 5;
      grid-column-end: span 5;
    }

    .column-md-6 {
      grid-column-start: span 6;
      grid-column-end: span 6;
    }

    .column-md-7 {
      grid-column-start: span 7;
      grid-column-end: span 7;
    }

    .column-md-8 {
      grid-column-start: span 8;
      grid-column-end: span 8;
    }

    .column-md-9 {
      grid-column-start: span 9;
      grid-column-end: span 9;
    }

    .column-md-10 {
      grid-column-start: span 10;
      grid-column-end: span 10;
    }

    .column-md-11 {
      grid-column-start: span 11;
      grid-column-end: span 11;
    }

    .column-md-12 {
      grid-column-start: span 12;
      grid-column-end: span 12;
    }
  }
  @media (min-width: 75rem) {
    .column-lg-1 {
      grid-column-start: span 1;
      grid-column-end: span 1;
    }

    .column-lg-2 {
      grid-column-start: span 2;
      grid-column-end: span 2;
    }

    .column-lg-3 {
      grid-column-start: span 3;
      grid-column-end: span 3;
    }

    .column-lg-4 {
      grid-column-start: span 4;
      grid-column-end: span 4;
    }

    .column-lg-5 {
      grid-column-start: span 5;
      grid-column-end: span 5;
    }

    .column-lg-6 {
      grid-column-start: span 6;
      grid-column-end: span 6;
    }

    .column-lg-7 {
      grid-column-start: span 7;
      grid-column-end: span 7;
    }

    .column-lg-8 {
      grid-column-start: span 8;
      grid-column-end: span 8;
    }

    .column-lg-9 {
      grid-column-start: span 9;
      grid-column-end: span 9;
    }

    .column-lg-10 {
      grid-column-start: span 10;
      grid-column-end: span 10;
    }

    .column-lg-11 {
      grid-column-start: span 11;
      grid-column-end: span 11;
    }

    .column-lg-12 {
      grid-column-start: span 12;
      grid-column-end: span 12;
    }
  }
}
* {
  box-sizing: border-box;
}
*::before, *::after {
  box-sizing: border-box;
}

a {
  color: #888;
  text-decoration: none;
  transition: all 0.2s ease;
}
a:hover {
  color: #333;
}
a.active {
  color: #333;
}

h1, h2, h3, h4 {
  color: #333;
  font-weight: normal;
  margin: 1.75rem 0 1rem 0;
}

h1 {
  font-size: 2.5rem;
}

h2 {
  font-size: 2.125rem;
  margin: 0;
}

h3 {
  font-size: 2rem;
}

h4 {
  font-size: 1.5rem;
  margin: 1rem 0 0.5rem 0;
}

section {
  display: block;
}

img {
  max-width: 100%;
  height: auto;
  -o-object-fit: cover;
     object-fit: cover;
}

#highlight {
  color: #333;
  font-size: 1.125rem;
  text-transform: uppercase;
}

.price {
  margin: 0;
}


.description {
  border-top: 0.0625rem solid #e3dddd;
  margin: 2rem 0;
  padding: 1rem 0 0 0;
}

.add-to-cart {
  position: relative;
  display: inline-block;
  background: #3e3e3f;
  color: #fff;
  border: none;
  border-radius: 0;
  padding: 1.25rem 2.5rem;
  font-size: 1rem;
  text-transform: uppercase;
  cursor: pointer;
  transform: translateZ(0);
  transition: color 0.3s ease;
  letter-spacing: 0.0625rem;
}
.add-to-cart:hover::before {
  transform: scaleX(1);
}
.add-to-cart::before {
  position: absolute;
  content: "";
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #565657;
  transform: scaleX(0);
  transform-origin: 0 50%;
  transition: transform 0.3s ease-out;
}

.container {
  margin: auto;
  padding: 0 1rem;
  max-width: 75rem;
  width: 100%;
}

.grid > [class*=column-] {
  padding: 1rem;
}
.grid.menu, .grid.product {
  border-bottom: 0.0625rem solid #e3dddd;
}
.grid.menu > [class*=column-] {
  padding: 0.5rem 1rem 0.5rem 1rem;
}
.grid.product {
  padding: 0 0 1.5rem 0;
}
.grid.second-nav > [class*=column-] {
  padding: 0.5rem 1rem;
}

footer {
  padding: 1rem 0;
  text-align: center;
}

.product-image {
  display: none;
}

.image-list li {
  margin: 0;
}

@media (min-width: 62rem) {
  .product-image img, .image-list img {
    width: 100%;
  }

  .product-image {
    display: block;
  }
  .product-image img {
    height: 52vh;
    border-radius: 25px;
  }
  .product-image img.active {
    display: block;
    margin: 0 0 0.75rem 0;
  }

  .product-image img:hover{
    transform: scale(1.05); /* Increase the scale to make the image bigger */
    transition: transform 0.3s ease; /* Smooth transition when scaling */
  }

  .image-list {
    display: flex;
    overflow: hidden;
  }
  .image-list li {
    margin: 0 0.75rem 0 0;
    flex-basis: 100%;
  }
  .image-list li:nth-child(3) {
    margin: 0;
  }
  .image-list img {
    height: 10rem;
    width: 100%;
    transition: opacity 0.3s ease;
    cursor: pointer;
    border-radius: 25px; 
  }
  .image-list img:hover {
    opacity: 0.7;
    transform: scale(1.05); /* Increase the scale to make the image bigger */
    transition: transform 0.3s ease; /* Smooth transition when scaling */
}


  nav ul {
    justify-content: flex-end;
  }

  .toggle-nav {
    display: none;
  }

  .flex-nav {
    display: block;
  }
  .flex-nav ul {
    display: flex;
    flex-direction: row;
    position: relative;
    justify-content: flex-end;
  }
  .flex-nav ul li {
    font-size: 1.125rem;
    margin: 0 1.5rem 0 0;
  }
  .flex-nav ul li:nth-child(4) {
    margin: 0;
  }
}
@-webkit-keyframes fadeImg {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
@keyframes fadeImg {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
