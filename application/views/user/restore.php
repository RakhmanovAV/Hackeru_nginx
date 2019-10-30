<?php include app::app()->path['views'] . 'templates/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
            
                    <div class="signup-form"><!--sign up form-->
                        <h2>Смена пароля</h2>
                        <?php if (isset($error)) : ?>
                        <h2 style="background :#ff000063;"><?php echo $error ?? ''; ?></h2>
                        <?php endif; ?>
                        <form action="/user/restore/" method="post">
                            <input type="hidden" name="sub_token"  value="<?php echo $token ?? ''; ?>"/> 
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $password ?? ''; ?>"/>
                            <input type="password" name="repassword" placeholder="Потверждение пароля" value="<?php echo $repassword ?? ''; ?>"/>
                            <input type="submit" name="send" class="btn btn-default" value="Сменить пароль" />
                        </form>
                    </div><!--/sign up form-->
                
                
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include app::app()->path['views'] . 'templates/footer.php'; ?>