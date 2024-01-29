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

    $filtered_hotels = $hotels;
    


    // <!-- 2 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio. -->
    if(isset($_GET['parking']) && $_GET['parking'] != ''){
        $filtered_hotel_parking = [];
        $parking = filter_var($_GET['parking'], FILTER_VALIDATE_BOOLEAN);

        foreach($filtered_hotels as $hotel){
            if($hotel['parking'] == $parking){
                $filtered_hotel_parking[] = $hotel;
            }
        }

        $filtered_hotels = $filtered_hotel_parking;

        
    }

    // <!-- 3 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore) -->
    if(isset($_GET['star']) && $_GET['star'] != ''){
        $filtered_hotel_star = [];
        $star = $_GET['star'];

        foreach($filtered_hotels as $hotel){
            if($hotel['vote'] >= $star){
                $filtered_hotel_star[] = $hotel;
            }
        }

        $filtered_hotels = $filtered_hotel_star;

        
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <!-- 1 - Realizzare header ed un footer in due file separati ed includerli nella pagina -->
    <?php include './partials/header.php';?>
    <main>
        <div class="container">
            <div class="row py-5">
                <div class="col-12">
                    <form action="./index.php" method="GET">
                        <div class="row">
                            
                            <!-- 2 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio. -->
                            <div class="col-4">
                                <select class="form-select" aria-label="Default select example" name="parking" id="parking">
                                    <option selected>Select parking option</option>
                                    <option value="true" <?php echo (isset($_GET['parking']) && $_GET['parking'] === 'true') ? 'selected' : ''; ?>>Yes</option>
                                    <option value="false" <?php echo (isset($_GET['parking']) && $_GET['parking'] === 'false') ? 'selected' : ''; ?>>No</option>

                                    
                                </select>
                            </div>
                            <!-- 3 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore) -->
                            <div class="col-4">
                                <select class="form-select" aria-label="Default select example" name="star" id="star">
                                    <option selected>Select Hotel's stars</option>
                                    <option value='1'>1 STAR</option>
                                    <option value="2">2 STARS</option>
                                    <option value="3">3 STARS</option>
                                    <option value="4">4 STARS</option>
                                    <option value="5">5 STARS</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Filtra</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <?php foreach (array_keys($hotels[0]) as $key) { ?>
                            <th><?php echo $key;?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Stampare tutti i nostri hotel con tutti i dati disponibili. -->
                    <?php foreach ($filtered_hotels as $hotel) { ?>
                        <tr>
                            <td><?php echo $hotel['name']; ?></td>
                            <td><?php echo $hotel['description'];?></td>
                            <td><?php echo $hotel['parking'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $hotel['vote'];?></td>
                            <td><?php echo $hotel['distance_to_center'];?></td>
                        </tr>
                    <?php } ?>
                    
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </main>
    <!-- 1 - Realizzare header ed un footer in due file separati ed includerli nella pagina -->
    <?php include './partials/footer.php';?>
</body>
</html>