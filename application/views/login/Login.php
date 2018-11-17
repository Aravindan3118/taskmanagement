<div class="main">

    <section class="signup">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container">
            <div class="signup-content">
                <form action="<?php echo site_url();?>login/login_req" method="POST" id="signup-form" class="signup-form">
                    <h2 class="form-title">Login</h2>
                    <?php if(! is_null($error_msg)) echo $error_msg;?>

                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>

                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Sign in"/>
                    </div>
                </form>
                <p class="loginhere">
                    Not Yet Register ? <a href="<?php echo base_url() ?>register" class="loginhere-link">Register here</a>
                </p>
            </div>
        </div>
    </section>

</div>
