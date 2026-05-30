<?php
include "db.php";

$id = (int)$_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];

    $stmt = $conn->prepare(
        "UPDATE books
         SET title = ?, author = ?, genre = ?, year = ?
         WHERE id = ?"
    );

    $stmt->bind_param(
        "sssii",
        $title,
        $author,
        $genre,
        $year,
        $id
    );

    $stmt->execute();

    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare(
    "SELECT * FROM books WHERE id = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-body">

            <h2 class="mb-4">Edit Book</h2>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?= htmlspecialchars($book['title']) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input
                        type="text"
                        name="author"
                        class="form-control"
                        value="<?= htmlspecialchars($book['author']) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input
                        type="text"
                        name="genre"
                        class="form-control"
                        value="<?= htmlspecialchars($book['genre']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <input
                        type="number"
                        name="year"
                        class="form-control"
                        value="<?= htmlspecialchars($book['year']) ?>">
                </div>

                <button class="btn btn-primary">
                    Save Changes
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
