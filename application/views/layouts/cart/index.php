<?php include app::app()->path['views'] . 'templates/header.php'; ?>
<section>
<?php echo $lo_category ?? ''; ?>
<?php echo $lo_cart ?? ''; ?>
<?php echo $lo_checkout ?? ''; ?>

</section>
<?php include app::app()->path['views'] . 'templates/footer.php'; ?>