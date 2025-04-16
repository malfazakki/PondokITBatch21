<?php include_once '../views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Batches</h1>
    <a href="batch.php?action=create" class="btn btn-primary">Add New Batch</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Year</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($batches)): ?>
            <tr>
                <td colspan="6" class="text-center">No batches found</td>
            </tr>
        <?php else: ?>
<?php foreach ($batches as $batch): ?>
                <tr>
                    <td><?php echo $batch['id']; ?></td>
                    <td><?php echo $batch['name']; ?></td>
                    <td><?php echo $batch['year']; ?></td>
                    <td><?php echo $batch['description']; ?></td>
                    <td><?php echo $batch['created_at']; ?></td>
                    <td>
                        <a href="batch.php?action=edit&id=<?php echo $batch['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="batch.php?action=delete&id=<?php echo $batch['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this batch?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
<?php endif; ?>
    </tbody>
</table>

<?php include_once '../views/layout/footer.php'; ?>