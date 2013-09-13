<?php if($admin) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Administration - <?php echo (isset($title)) ? $title : "" ?> </title>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/style.css') ?>" />
 <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>
 <div id="wrapper">
<?php } else { ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title><?php echo (isset($title)) ? $title : "" ?> </title>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/style.css') ?>" />
 <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
 <script src="<?php echo base_url('static/js/easeljs-0.6.1.min.js'); ?>"></script>
</head>
<body>
 <div id="wrapper">
<?php } ?>