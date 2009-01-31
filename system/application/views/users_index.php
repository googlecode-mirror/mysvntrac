<h2>Users</h2>

<ul class="options">
	<li><?= anchor('users/add', 'Add User', array('class'=>'icon_link add_user')) ?></li>
</ul>

<table>
<thead>
	<th>Username</th>
    <th>Groups</th>
</thead>
<? foreach ($users as $user): ?>
    <tr class="<?=alternator('odd', 'even')?>">
    	<td><?= $user['username'] ?></td>
        <td><?= implode(", ", $user['groups']) ?></td>
    </tr>
<? endforeach ?>
</table>