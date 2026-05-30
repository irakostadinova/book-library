<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];

    $stmt = $conn->prepare(
        "INSERT INTO books (title, author, genre, year)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssi",
        $title,
        $author,
        $genre,
        $year
    );

    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-body">

            <h2 class="mb-4">Add Book</h2>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" name="author" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" name="genre" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <input type="number" name="year" class="form-control">
                </div>

                <button class="btn btn-primary">
                    Save Book
                </button>

                <a href="index.php" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
