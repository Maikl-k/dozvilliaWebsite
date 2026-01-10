<?php
 $baseUrl = '/'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=" <?php echo $baseUrl; ?>css/home.css">
    <link rel="stylesheet" href=" <?php echo $baseUrl; ?>css/global.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dozvillia | Home page</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="nav_section">
        <div class="search-bar">
            <form action="" method="GET" id="search-form">
                <div class="form-items">

                    <input type="search" name="seacher-content" id="search-bar" placeholder="type here for search">
                    
                    <input type="image" id="search-image" src=" <?php echo $baseUrl; ?>images/goodSearchBtn.png" alt="search button">
                </div>
            </form>
        </div>
    </div>
</body>
</html>