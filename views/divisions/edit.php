<?php include_once '../views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Edit Division</h1>
    <a href="division.php" class="btn btn-secondary">Back to Divisions</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form action="division.php?action=edit&id=<?php echo $this->division->id; ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->division->name; ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $this->division->description; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Division</button>
</form>

<?php include_once '../views/layout/footer.php'; ?>