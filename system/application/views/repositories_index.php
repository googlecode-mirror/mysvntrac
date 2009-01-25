<h2>Repositories</h2>

<ul>
	<li><?= anchor('repositories/add', 'Add') ?></li>
</ul>

<table>
<thead>
	<th>Repository</th>
    <th>Svn</th>
    <th>Trac</th>
    <th>Options</th>
</thead>
<? foreach ($repositories as $repository): ?>
    <tr>
    	<td><?= anchor('repositories/edit/'.$repository, $repository) ?></td>
        <td><?= anchor($this->config->item('server').'svn/'.$repository) ?></td>
        <td><?= anchor($this->config->item('server').'trac/'.$repository) ?></td>
    </tr>
<? endforeach ?>
</table>