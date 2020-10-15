<div class="content-body">
    <section class="login">
        <div class="content-login">
            <img class="logo-img" src="<?php echo IMG_PATH; ?>/multiflex.png" alt="">

            <p class="Tittle">Login</p>
            <form class="form-login" action="<?php echo FRONT_ROOT;?>User/login">
                <input class="input-login" type="text" name="userName" id="" placeholder="User Name">
                <input class="input-login" type="password" name="password" id="" placeholder="Password">
                <button class="submit-login" type="submit">Login</button>
            </form>
            <div class="enlace">
                <a href="<?php echo FRONT_ROOT; ?>User/showSingInView"><b>Sign Up</b></a>
            </div>

            <?php if($message != "" ):?>
                <p style="color: #fff;"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
    </section>
</div>