<?php
include "db.php";

$result = $conn->query("SELECT * FROM books");
?>
<?php
include "db.php";

$search = $_GET['search'] ?? '';

if ($search !== '') {

    $stmt = $conn->prepare(
        "SELECT * FROM books
         WHERE title LIKE ?
         OR author LIKE ?"
    );

    $term = "%$search%";

    $stmt->bind_param("ss", $term, $term);
    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $result = $conn->query(
        "SELECT * FROM books ORDER BY id DESC"
    );
}

$countResult = $conn->query(
    "SELECT COUNT(*) AS total FROM books"
);

$totalBooks = $countResult->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Library</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark shadow">
    <div class="container">
        <span class="navbar-brand mb-0 h1">
             Book Library
        </span>
    </div>
</nav>

<div class="container py-5">

    <div class="p-5 mb-4 bg-white rounded-4 shadow-sm">

        <h1 class="display-5 fw-bold">
            Welcome to Book Library
        </h1>

        <p class="lead">
            A simple book management system.
        </p>

        <a href="add.php" class="btn btn-success btn-lg">
            Add New Book
        </a>

    </div>

    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        Total Books
                    </h5>

                    <h2>
                        <?= $totalBooks ?>
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by title or author..."
                        value="<?= htmlspecialchars($search) ?>">

                    <button class="btn btn-primary">
                        Search
                    </button>

                </div>

            </form>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php while($row = $result->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($row['title']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['author']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['genre']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['year']) ?>
                            </td>

                            <td>

                                <a
                                    href="edit.php?id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <a
                                    href="delete.php?id=<?= $row['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this book?')">

                                    Delete

                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<footer class="bg-dark text-white text-center py-3 mt-5">

    © 2026 Book Library

</footer>

</body>
</html>
