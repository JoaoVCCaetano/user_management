<?php include __DIR__ . '/header.php'; ?>

<h2><?php echo isset($user) ? 'Edit User' : 'Add User'; ?></h2>
<form action="/user/store" method="post">
    <input type="hidden" name="id" value="<?php echo isset($user) ? $user['id'] : ''; ?>">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($user) ? $user['name'] : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user) ? $user['email'] : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="active" <?php echo isset($user) && $user['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
            <option value="inactive" <?php echo isset($user) && $user['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
        </select>
    </div>
    <div class="form-group">
        <label for="admission_date">Admission Date</label>
        <input type="date" class="form-control" id="admission_date" name="admission_date" value="<?php echo isset($user) ? $user['admission_date'] : ''; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo isset($user) ? 'Update' : 'Submit'; ?></button>
</form>

<?php include __DIR__ . '/footer.php'; ?>
