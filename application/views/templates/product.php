<?php foreach ($products as $product) { ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
             <div class="single-products">
                <div class="productinfo text-center">
                    <img  src="<?php echo $product['image'];?>" alt="" />
                    <h2><?php echo $product['price'];?>$</h2>
                        <p>
                            <a href="/product/index/<?php echo $product['id'];?>">
                                <?php echo $product['name'];?>
                            </a>
                        </p>
                    <a  href="#"
                        data-id="<?php echo $product['id']; ?>" 
                        class="btn btn-default add-to-cart">
                            <i class="fa fa-shopping-cart"></i>В корзину
                    </a>
                </div>
                <?php if ($product['is_new']) : ?>
                <img src ="/template/images/home/new.png" class="new" alt="" />
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php }?>    
    