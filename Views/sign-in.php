<div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</div>
<div class="vhSignIn">
    <?php if (isset($_SESSION['loggedUser'])) {
        require_once("nav.php");
    }
    ?>
    <div class="content-body">

        <section class="login">
            <div class="content-login">
                <img class="logo-img" src="<?php echo IMG_PATH; ?>/multiflex.png" alt="">
                <p class="Tittle">Registrarse</p>
                <form class="form-login" action="<?php echo FRONT_ROOT; ?>User/signIn" method="POST">
                    <input class="input-login" type="text" name="firtsName" placeholder="Nombre">
                    <input class="input-login" type="text" name="lastName" placeholder="Apellido">
                    <input class="input-login" type="text" name="userName" placeholder="Nombre de usuario">
                    <input class="input-login" type="email" name="email" placeholder="Email">
                    <input class="input-login" type="password" name="password" placeholder="Password">
                    <?php if (!empty($_SESSION['userType']) && $_SESSION['userType'] == "Admin") : ?>
                        <select name="userType" id="userType">
                            <?php foreach ($userTypeList as $userType) :  ?>
                                <option value="<?php echo $userType->getId(); ?>" id="userType"><?php echo $userType->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                    <button class="submit-login" type="submit">Ingresar</button>
                </form>
                <?php if (!isset($_SESSION['loggedUser'])) : ?>
                    <div class="enlace">
                        <a href="<?php echo FRONT_ROOT; ?>User/showLoginView"><b>Login</b></a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>