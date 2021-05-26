<?php
$dbconn = pg_connect("host=ec2-54-78-36-245.eu-west-1.compute.amazonaws.com port=5432 dbname=damcbovdvkucji user=nwuwhicdfqfxys password=d297f268ecbb669c7af029b742c96d2421097ec0efdb871761d443b44dbae886");
$dbconn = pg_connect(getenv("DATABASE_URL"));
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
    <div class="uk-section">
        <div class="uk-container">
        <table class="uk-table uk-table-responsive uk-table-divider uk-table-large uk-table-hover uk-table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Рейтинг</th>
                    <th>Управление</th>                    
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
                        <td class='rating'>$rating</td>
                        <td>
                            <button data-id='$id' data-type='1' class='uk-button uk-button-primary uk-button-small ratingbtn'>+</button>
                            <button data-id='$id' data-type='-1' class='uk-button uk-button-danger uk-button-small ratingbtn'>-</button>
                        </td>
                    </tr>
                    ";
                    $i++;
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
    <script>
        let ratingbtnarr = document.querySelectorAll(".ratingbtn");
        for (let ratingbtn of ratingbtnarr) {
            ratingbtn.addEventListener('click', function(e) {
                let curBtn = e.currentTarget;
                let xhr = new XMLHttpRequest();
                xhr.open('get', `/query.php?id=${curBtn.dataset.id}&type=${curBtn.dataset.type}`)
                xhr.send();
                let rating = curBtn.parentElement.parentElement.querySelector(".rating");
                rating.innerHTML = parseInt(rating.innerHTML)+parseInt(curBtn.dataset.type);
            });
        }

    </script>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</body>
</html>
<?php
pg_close($dbconn);
?>