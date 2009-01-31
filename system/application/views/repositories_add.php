<h2>Add Repository</h2>

<ul class="options">
	<li><?= anchor('repositories', 'Back', array('class'=>'icon_link back')) ?></li>
</ul>

<?= validation_errors(); ?>

<?= form_open('repositories/add') ?>
<label for="name">Name:</label>
<input type="text" name="name" size="20" />
<input type="submit" value="Submit" />
</form>