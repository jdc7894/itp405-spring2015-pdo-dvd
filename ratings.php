<?php
if(!isset($_GET['rating'])) {
    header('Location: search.php');
}
$rating = $_GET['rating'];
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
    WHERE rating_name = ?
";
$statement = $pdo->prepare($sql);
$statement->bindParam(1, $rating);
$statement->execute();
$collection = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta charset="utf-8">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
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
</body>
</html>