    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="<?= base_url('Auth/register'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Jons Keneddy" value="<?= set_value('name') ?>">
                                    <?= form_error('name', "<small class='pl-2 text-danger'>", "</small>") ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-control-user" value="<?= set_value('email') ?>" id="email" placeholder="Email Address">
                                    <?= form_error('email', "<small class='pl-2 text-danger'>", "</small>") ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name='password' class="form-control form-control-user" id="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name='repassword' class="form-control form-control-user" id="repassword" placeholder="Repeat Password">
                                    </div>
                                    <div class="col-sm-12">
                                        <?= form_error('repassword', "<small class='pl-2 text-danger'>", "</small>") ?>
                                    </div>

                                </div>
                                <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('Auth')  ?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>