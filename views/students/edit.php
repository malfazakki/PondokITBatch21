<?php include_once '../views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Edit Student</h1>
    <a href="student.php" class="btn btn-secondary">Back to Students</a>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form action="student.php?action=edit&id=<?php echo $this->student->id; ?>" method="post" class="mb-4">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->student->name; ?>" required>
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male"                                                                 <?php echo($this->student->gender == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female"                                                                     <?php echo($this->student->gender == 'Female') ? 'selected' : ''; ?>>Female</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3"><?php echo $this->student->address; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $this->student->phone; ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->student->email; ?>">
    </div>
    <div class="mb-3">
        <label for="batch_id" class="form-label">Batch</label>
        <select class="form-control" id="batch_id" name="batch_id" required>
            <option value="">Select Batch</option>
            <?php while ($row = $batch_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['id']; ?>"<?php echo($this->student->batch_id == $row['id']) ? 'selected' : ''; ?>>
                    <?php echo $row['name'] . ' (' . $row['year'] . ')'; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="division_id" class="form-label">Division</label>
        <select class="form-control" id="division_id" name="division_id" required>
            <option value="">Select Division</option>
            <?php while ($row = $division_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['id']; ?>"<?php echo($this->student->division_id == $row['id']) ? 'selected' : ''; ?>>
                    <?php echo $row['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Student</button>
</form>

<?php include_once '../views/layout/footer.php'; ?>