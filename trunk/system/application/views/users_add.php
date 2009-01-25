<h2>Add User</h2>

<?= validation_errors(); ?>

<?= form_open('users/add') ?>
<label for="username">Username:</label>
<input type="text" name="username" value="<?= set_value('username') ?>" size="20" />
</br>
<label for="password">Password:</label>
<input type="password" name="password" size="20" />
</br>
<input type="submit" value="Submit" />
</form>