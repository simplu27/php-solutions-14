<?php
include './includes/title.php';
require_once './includes/utility_funcs.php';
require_once './includes/connection.php';
// create database connection
$conn = dbConnect('read', 'pdo');
$sql = 'SELECT * FROM blog ORDER BY created DESC';
$result = $conn->query($sql);
$errorInfo = $conn->errorInfo();
if (isset($errorInfo[2])) {
    $error = $errorInfo[2];
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Japan Journey<?php if(isset($title)) { echo "&#8212;{$title}"; } ?></title>
    <link href="styles/journey.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <h1>Japan Journey </h1>
</header>
<div id="wrapper">
    <?php require './includes/menu.php'; ?>
    <main>
        <?php if (isset($error)) {
            echo "<p>$error</p>";
        } else {
            while ($row = $result->fetch()) {
                echo "<h2>{$row['title']}</h2>";
                $extract = getFirst($row['article']);
                echo "<p>$extract[0]";
                if ($extract[1]) {
                    echo '<a href="details.php?article_id=' .
                        $row['article_id'] . '"> More</a>';
                }
                echo '</p>';
            }
        }
        ?>
    </main>
    <?php include './includes/footer.php'; ?>
</div>
</body>
</html>
