<?php include_once '../views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Students (Santri)</h1>
    <a href="student.php?action=create" class="btn btn-primary">Add New Student</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Batch</th>
            <th>Division</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($students)): ?>
            <tr>
                <td colspan="8" class="text-center">No students found</td>
            </tr>
        <?php else: ?>
<?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['gender']; ?></td>
                    <td><?php echo $student['phone']; ?></td>
                    <td><?php echo $student['email']; ?></td>
                    <td><?php echo $student['batch_name']; ?></td>
                    <td><?php echo $student['division_name']; ?></td>
                    <td>
                        <a href="student.php?action=edit&id=<?php echo $student['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="student.php?action=delete&id=<?php echo $student['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
<?php endif; ?>
    </tbody>
</table>

<?php include_once '../views/layout/footer.php'; ?>