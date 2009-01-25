<h2>Users</h2>

<ul>
	<li><?= anchor('users/add', 'Add') ?></li>
</ul>

<table>
<? foreach ($users as $user): ?>
    <tr>
    	<td><?= $user['username'] ?></td>
    </tr>
<? endforeach ?>
</table>