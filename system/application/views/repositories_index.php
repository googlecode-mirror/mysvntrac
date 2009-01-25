<h2>Repositories</h2>

<ul>
	<li><?= anchor('repositories/add', 'Add') ?></li>
</ul>

<table>
<? foreach ($repositories as $repository): ?>
    <tr>
    	<td><?= $repository ?></td>
    </tr>
<? endforeach ?>
</table>