<?php include app::app()->path['views'] . 'templates/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
            
                    <div class="signup-form"><!--sign up form-->
                        <h2>Вход на сайте</h2>
                        <?php if (isset($error)) : ?>
                        <h2 style="background :#ff000063;"><?php echo $error ?? ''; ?></h2>
                        <?php endif; ?>
                        
                        <h2 style="background :#ff000063;">Вы вошли как<?php echo app::app()->user->email; ?></h2>
                       
                        <form action="/user/authorization/" method="test">
                            <input type="hidden" name="sub_token"  value="<?php echo $token ?? ''; ?>"/> 
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo $email ?? ''; ?>"/>
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $password ?? ''; ?>"/>
                            <input type="submit" name="send" class="btn btn-default" value="Вход" />
                            <a id="speshial" href="/user/reset">Восстановить пароль</a>
                        </form>
                    </div><!--/sign up form-->
                    
                
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include app::app()->path['views'] . 'templates/footer.php'; ?>