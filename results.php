<?php
if(!isset($_GET['dvd_name'])) {
    $home = 'search.php';
    header('Location: ' .  $home);
}
$title = $_GET['dvd_name'];

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pass = 'ttrojan';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$sql = "
    SELECT title, format_name, genre_name, rating_name
    FROM dvds
    INNER JOIN formats 
    ON dvds.format_id = formats.id 
    INNER JOIN genres 
    ON dvds.genre_id = genres.id
    INNER JOIN ratings 
    ON dvds.rating_id = ratings.id
    WHERE title LIKE ?
";
$statement = $pdo->prepare($sql);
$like = '%' . $title . '%';
$statement->bindParam(1, $like);
$statement->execute();
$collection = $statement->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="col-md-12">
        <h4> You searched for: <em><?php echo $title ?></em></h4>
    </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Format</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($collection as $movie) : ?>
                    <tr>
                        <td><?php echo $movie->title ?></td>
                        <td><?php echo $movie->genre_name ?></td>
                        <td><?php echo $movie->format_name ?></td>
                        <td>
                            <a href ="ratings.php?rating=<?php echo $movie->rating_name ?>">
                                <?php echo $movie->rating_name ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php if (count($collection) == 0) : ?>
            <h3><?php echo $title ?> does not eixst. <a href="search.php">Go back to the search!</a></h3>
    <?php endif ?>
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>