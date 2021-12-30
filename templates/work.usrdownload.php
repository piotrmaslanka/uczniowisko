<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pobieranie</title>
</head>
<body>
				<?php global $argv; ?>
				
				
<h1>Pobieranie</h1>
<?php foreach ($tpl['attachs'] as $att) { ?>
		<a href="<?php echo APPPATH; ?>usr.download/<?php echo $att['id']; ?>/<?php echo $tpl['db_purchase_id']; ?>"><?php echo $att['description']; ?></a><br>
<?php } ?>

</body>
</html>