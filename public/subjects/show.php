<?php require_once('../../private/initialize.php'); ?>

<?php

	$id = $_GET['id'] ?? '1'; // PHP > 7.0 // if not found, assign value 1

?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

	<a class="back-link" href="<?php echo url_for('/subjects/index.php'); ?>">&laquo; Back to list</a>

	<div class="subject show">
		Page ID: <?php echo h($id); ?>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>