<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= isset($title) ? $title . ' - ' : '' ?> &laquo; MySvn</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?=base_url();?>" />
<!--<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />-->
</head>
<body>

<h1>MySvn</h1>

<ul>
	<li><?= anchor('repositories', 'Repositories') ?></li>
	<li><?= anchor('users', 'Users') ?></li>
</ul>

<? if(isset($view)) $this->load->view($view); ?>

</body>
</html>