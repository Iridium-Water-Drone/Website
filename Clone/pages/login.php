<body>
      <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="inc/login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Login"  class="btn btn-lg btn-success btn-block" />
                               
                            </fieldset>
                            <?php 
                            if(isset($_GET['e'])) {
                                $error = $_GET['e'];
                                echo "<br><div class='alert alert-danger'>$error</div>";
                            }
                            ?>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
