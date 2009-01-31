<h2>Repositories</h2>

<ul class="options">
	<li><?= anchor('repositories/add', 'Add Repository', array('class'=>'icon_link add_repository')) ?></li>
</ul>

<table>
<thead>
	<th>Repository</th>
    <th>Svn</th>
    <th>Trac</th>
    <th>Options</th>
</thead>
<? foreach ($repositories as $repository): ?>
    <tr class="<?=alternator('odd', 'even')?>">
    	<td><?= anchor('repositories/edit/'.$repository, $repository) ?></td>
        <td><?= anchor($this->config->item('server').'svn/'.$repository) ?></td>
        <td><?= anchor($this->config->item('server').'trac/'.$repository) ?></td>
        <td><?= anchor('repositories/remove/'.$repository, 'Remove', array('class'=>'icon_link remove_repository')) ?></td>
    </tr>
<? endforeach ?>
</table>