<h2>Groups</h2>

<ul class="options">
	<li><?= anchor('groups', 'Back', array('class'=>'icon_link back')) ?></li>
</ul>

<?= validation_errors(); ?>

<?= form_open('groups/add') ?>
<label for="name">Name:</label>
<input type="text" name="name" value="<?= set_value('name') ?>" size="20" />
</br>
<input type="submit" value="Submit" />
</form>