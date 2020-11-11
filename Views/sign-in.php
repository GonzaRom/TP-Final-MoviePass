<!--div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</!--div--->
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
                    <input class="input-login" id="validationDefault01" type="text" name="firtsName" placeholder="Nombre" required>
                    <input class="input-login" id="validationDefault02" type="text" name="lastName" placeholder="Apellido" required>
                    <input class="input-login" type="text" name="userName" placeholder="Nombre de usuario" required>
                    <input class="input-login" type="email" name="email" placeholder="Email" required>
                    <input class="input-login" type="password" name="password" placeholder="Password" required>
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
                <?php if ($message != "") : ?>
                    <p style="color: #fff;"><?php echo $message; ?></p>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>