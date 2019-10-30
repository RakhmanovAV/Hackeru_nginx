<?php foreach ($products as $product) { ?>
<div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <img src="<?php echo $product['image'];?>" alt="" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <?php if ($product['is_new']): ?>
                                            <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                        <?php endif; ?>
                                        <h2><?php echo $product['name'];?></h2>
                                        <p>Код товара: <?php echo $product['code']; ?></p>
                                        <span>
                                            <span>US $<?php echo $product['price']; ?></span>
                                            <label>Количество:</label>
                                            <input type="text" value="1" />
                                            <button type="button" class="btn btn-fefault cart add-to-cart" 
                                            data-id="<?php echo $product['id']; ?>">
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </button>
                                        </span>
                                        <p><b>Наличие:</b> <?php echo $product['availability']; ?></p>
                                        <p><b>Состояние:</b> Новое</p>
                                        <p><b>Производитель:</b> <?php echo $product['brand']; ?>G</p>
                                    </div><!--/product-information-->
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-sm-12">
                                    <h5>Описание товара</h5>
                                    <?php echo $product['description']; ?>
                                </div>
                            </div>
                        </div><!--/product-details-->

                    </div>
                </div>
            </div>
<?php }?>             