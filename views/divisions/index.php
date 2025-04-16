<?php include_once '../views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Divisions</h1>
    <a href="division.php?action=create" class="btn btn-primary">Add New Division</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($divisions)): ?>
            <tr>
                <td colspan="5" class="text-center">No divisions found</td>
            </tr>
        <?php else: ?>
<?php foreach ($divisions as $division): ?>
                <tr>
                    <td><?php echo $division['id']; ?></td>
                    <td><?php echo $division['name']; ?></td>
                    <td><?php echo $division['description']; ?></td>
                    <td><?php echo $division['created_at']; ?></td>
                    <td>
                        <a href="division.php?action=edit&id=<?php echo $division['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="division.php?action=delete&id=<?php echo $division['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this division?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
<?php endif; ?>
    </tbody>
</table>

<?php include_once '../views/layout/footer.php'; ?>