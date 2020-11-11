<!--div class="body" id="onload">
    <div class="container">
        <div class="loader"><span></span></div>
    </div>
</!--div-->
<div class="vhSignIn">
    <div class="content-body">
        <section class="login">
            <div class="content-login">
                <a href="<?php echo FRONT_ROOT; ?>Home/Index"><img class="logo-img" src="<?php echo IMG_PATH; ?>/multiflex.png" alt=""></a>
                <p class="Tittle">Ingresar</p>
                <form class="form-login" action="<?php echo FRONT_ROOT; ?>User/login" method="POST">
                    <input class="input-login" type="text" name="userName" id="" placeholder="Nombre de usuario">
                    <input class="input-login" type="password" name="password" id="" placeholder="Password">
                    <button class="submit-login" type="submit">Ingresar</button>
                    <a href="<?php echo $loginUrl ?>"><img src="<?php echo IMG_PATH ?>buttonFB2.png" width=250px></a>
                </form>
                <div class="enlace">
                    <a href="<?php echo FRONT_ROOT; ?>User/showSingInView"><b>Registrarse</b></a>
                </div>

                <?php if ($message != "") : ?>
                    <p style="color: #fff;"><?php echo $message; ?></p>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>