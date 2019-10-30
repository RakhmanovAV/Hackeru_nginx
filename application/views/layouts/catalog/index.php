<?php include app::app()->path['views'] . 'templates/header.php'; ?>

<section>
<?php echo $lo_category ?? ''; ?>
                    
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    
                    <?php echo $lo_product ?? ''; ?>                  

                </div><!--features_items-->


            </div>
        </div>
    </div>
</section>

<?php include app::app()->path['views'] . 'templates/footer.php'; ?>