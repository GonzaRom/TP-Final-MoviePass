
<div class="content-body">
    <?php if(isset($_SESSION['loggedUser'])){
        require_once("nav.php");   
    }
        ?>
    <section class="login">
        <div class="content-login">
            <img class="logo-img" src="<?php echo IMG_PATH; ?>/multiflex.png" alt="">

            <p class="Tittle">Sign In</p>
            <form class="form-login" action="<?php echo FRONT_ROOT;?>User/signIn" method="POST">
                <input class="input-login" type="text" name="firtsName" placeholder="First Name">
                <input class="input-login" type="text" name="lastName" placeholder="Last Name">
                <input class="input-login" type="text" name="userName" placeholder="User Name">
                <input class="input-login" type="email" name="email" placeholder="Email">
                <input class="input-login" type="password" name="password" placeholder="Password">
                <?php if(!empty($_SESSION['userType']) && $_SESSION['userType'] == 2):?>
                <select name="userType" id="userType">
                    <?php foreach($userTypeList as $userType):  ?>
                        <option value="<?php echo $userType->getId(); ?>" id="userType"><?php echo $userType->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
                    <?php endif; ?>
                <button class="submit-login" type="submit">Sign in</button>
            </form>
            <div class="enlace">
                <a href="<?php echo FRONT_ROOT; ?>User/showLoginView"><b>Login</b></a>
            </div>
        </div>
    </section>
</div>