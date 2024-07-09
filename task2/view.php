<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table View</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /* public/css/style.css */
.table th a {
    color: inherit;
    text-decoration: none;
}

.btn.disabled {
    pointer-events: none;
    opacity: 0.6;
}

    </style>
</head>
<body>
<div class="container">
    <h1 class="my-4">Table View</h1>
    <form class="form-inline mb-3">
        <input type="text" name="filter" class="form-control mr-2" placeholder="Enter name to filter" value="<?= htmlspecialchars($filter) ?>">
        <button type="submit" class="btn btn-primary">Sort</button>
        <a href="?" class="btn btn-secondary ml-2">Reset Sort</a>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><a href="?sortBy=S.No&order=<?= $sortOrder == 'asc' ? 'desc' : 'asc' ?>&filter=<?= htmlspecialchars($filter) ?>&page=<?= $page ?>&pageSize=<?= $pageSize ?>">S.No</a></th>
                <th><a href="?sortBy=Name&order=<?= $sortOrder == 'asc' ? 'desc' : 'asc' ?>&filter=<?= htmlspecialchars($filter) ?>&page=<?= $page ?>&pageSize=<?= $pageSize ?>">Name</a></th>
                <th><a href="?sortBy=Age&order=<?= $sortOrder == 'asc' ? 'desc' : 'asc' ?>&filter=<?= htmlspecialchars($filter) ?>&page=<?= $page ?>&pageSize=<?= $pageSize ?>">Age</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pagedData as $row): ?>
                <tr>
                    <td><?= $row['S.No'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['Age'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <a href="?sortBy=<?= $sortKey ?>&order=<?= $sortOrder ?>&filter=<?= htmlspecialchars($filter) ?>&page=<?= $page > 1 ? $page - 1 : 1 ?>&pageSize=<?= $pageSize ?>" class="btn btn-primary <?= $page == 1 ? 'disabled' : '' ?>">Previous</a>
        <a href="?sortBy=<?= $sortKey ?>&order=<?= $sortOrder ?>&filter=<?= htmlspecialchars($filter) ?>&page=<?= $page + 1 ?>&pageSize=<?= $pageSize ?>" class="btn btn-primary">Next</a>
    </div>
</div>
</body>
</html>
