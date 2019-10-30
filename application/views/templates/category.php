<div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products">
                                <?php foreach ($categories as $category) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/catalog/index/<?php echo $category['id'];?>"><?php echo $category['name'];?></a>
                                        </h4>
                                    </div>
                                </div>
                                <?php }?>
                                </div>
                        </div>
                    </div>

