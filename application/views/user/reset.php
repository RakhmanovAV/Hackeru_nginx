<?php include app::app()->path['views'] . 'templates/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
            
                    <div class="signup-form"><!--sign up form-->
                        <h2>Восстановление пароля</h2>
                        <?php if (isset($error)) : ?>
                        <h2 style="background :#ff000063;"><?php echo $error ?? ''; ?></h2>
                        <?php endif; ?>
                        <?php if (isset($error)) : ?>
                        <h2 style="background :#ff000063;"><?php echo $error ?? ''; ?></h2>
                        <?php endif; ?>
                        <form action="/user/reset/" method="post">
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo $email ?? ''; ?>"/>
                            <input type="submit" name="send" class="btn btn-default" value="Отправить" />
                        </form>
                    </div><!--/sign up form-->
                
                
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include app::app()->path['views'] . 'templates/footer.php'; ?>