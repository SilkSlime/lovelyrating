<?php
// $dbconn = pg_connect(getenv("DATABASE_URL"));
$dbconn = pg_connect("host=ec2-54-78-36-245.eu-west-1.compute.amazonaws.com port=5432 dbname=damcbovdvkucji user=nwuwhicdfqfxys password=d297f268ecbb669c7af029b742c96d2421097ec0efdb871761d443b44dbae886");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lovely Rating</title>
    <link rel="stylesheet" href="css/uikit.min.css" />
</head>
<body>
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-center">
            <a class="uk-navbar-item uk-logo" href="#">Lovely Rating</a>
        </div>
    </nav>
    <div class="uk-height-medium uk-background-cover uk-light uk-flex" uk-parallax="bgy: -200" style="background-image: url('img/bg.jpg');">
        <h1 class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">Рейтинг хороших людей!</h1>
    </div>
    <div class="uk-section">
        <div class="uk-container">
        <table class="uk-table uk-table-responsive uk-table-divider uk-table-large uk-table-hover uk-table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Рейтинг</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM students ORDER BY rating DESC, surname ASC;";
                $result = pg_query($query);
                $i = 1;
                while ($student = pg_fetch_assoc($result)) {
                    $name = $student["name"];
                    $surname = $student["surname"];
                    $rating = $student["rating"];
                    $id = $student["id"];
                    echo "
                    <tr data-id='$id'>
                        <td>$i</td>
                        <td>$surname $name</td>
                        <td>$rating</td>
                    </tr>
                    ";
                    $i++;
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>
<?php
pg_close($dbconn);
?>