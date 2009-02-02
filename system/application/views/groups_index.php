<h2>Users</h2>

<ul class="options">
	<li><?= anchor('groups/add', 'Add Group', array('class'=>'icon_link add_group')) ?></li>
</ul>

<table>
<thead>
	<th>Groups</th>
    <th>How many users?</th>
    <th>Options</th>
</thead>
<? foreach ($groups as $group => $users): ?>
    <tr class="<?=alternator('odd', 'even')?>">
    	<td><?= $group ?></td>
        <td><?= count($users) ?></td>
        <td><?= anchor('groups/remove/'.$group, 'Remove', array('class'=>'icon_link remove_group')) ?></td>
    </tr>
<? endforeach ?>
</table>