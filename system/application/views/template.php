<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= isset($title) ? $title . ' - ' : '' ?> &laquo; MySvn</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?=base_url();?>" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/screen.css"/>
<!--<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />-->
<base href=""<?=base_url()?>"/>
</head>
<body>

<h1>MySvn</h1>

<div id="nav">
    <ul id="nav">
        <li><?= anchor('repositories', 'Repositories') ?></li>
        <li><?= anchor('users', 'Users') ?></li>
        <li><?= anchor('groups', 'Groups') ?></li>
    </ul>
</div>

<div id="page">

<? if(isset($view)) $this->load->view($view); ?>

</div>

</body>
</html>