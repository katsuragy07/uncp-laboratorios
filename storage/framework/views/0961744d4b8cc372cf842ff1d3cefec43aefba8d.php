<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" version="XHTML+RDFa 1.0" dir="ltr"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:dc="http://purl.org/dc/terms/"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
  xmlns:og="http://ogp.me/ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:sioc="http://rdfs.org/sioc/ns#"
  xmlns:sioct="http://rdfs.org/sioc/types#"
  xmlns:skos="http://www.w3.org/2004/02/skos/core#"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema#">
    <head profile="http://www.w3.org/1999/xhtml/vocab">
        <!-- Meta data -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta content="Sistema de Gestión de Laboratorios" name="description">
        <meta content="UNCP" name="author">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Title -->
        <title>UNILAB - UNCP </title>

        <!--Favicon -->
        <link rel="icon" href="<?php echo e(asset('images/logouncp.png')); ?>" type="image/x-icon"/>

        <!-- Bootstrap css -->
        <link href="<?php echo e(asset('zendash/assets/plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet" />

        <!-- Style css -->
        <link href="<?php echo e(asset('zendash/assets/css/style.css')); ?>" rel="stylesheet" />

        <!-- Dark css -->
        <link href="<?php echo e(asset('zendash/assets/css/dark.css')); ?>" rel="stylesheet" />

        <!-- Skins css -->
        <link href="<?php echo e(asset('zendash/assets/css/skins.css')); ?>" rel="stylesheet" />

        <!-- Animate css -->
        <link href="<?php echo e(asset('zendash/assets/css/animated.css')); ?>" rel="stylesheet" />

        <!---Icons css-->
        <link href="<?php echo e(asset('zendash/assets/css/icons.css')); ?>" rel="stylesheet" />

    </head>

    <body class="h-100vh page-style1">

        <div class="page">
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 d-block mx-auto">
                            <div class="row">
                                <div class="col-md-5 p-md-0">
                                    <div class="card br-0 mb-0">
                                        <div class="card-body page-single-content">
                                            <div class="w-100">
                                                <div class="custom-logo">
                                                    
                                                    <img src="<?php echo e(asset('images/logouncp.png')); ?>" class="header-brand-img dark-logo" alt="logo">
                                                    
                                                </div>
                                                <div class="">
                                                    <h2>Inicio de sesión</h2>
                                                </div>
                                                <form method="POST" action="<?php echo e(route('login')); ?>">
                                                    <?php echo csrf_field(); ?>
                                                
                                                <div class="input-group mb-4">
                                                    <input id="email" type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e(old('username')); ?>" required autocomplete="off" autofocus placeholder="Usuario: CÓD. SUNEDU">

                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="input-group mb-4">
                                                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Contraseña: 123">

                                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group mb-0">
                                                            <label class="custom-control custom-checkbox mb-0" for="remember">
                                                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                                <span class="custom-control-label text-muted">Recordar</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-right mt-1" style="display: none;">
                                                        <a href="<?php echo e(route('password.request')); ?>" class="text-muted">Olvidaste contraseña</a>
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <div class="text-center mt-7">
                                                    <div class="font-weight-normal fs-16 text-muted"> Visítanos al <a class="btn-link font-weight-normal" href="https://uncp.edu.pe/" target="_blank">portal web UNCP  </a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 p-0">
                                    <div class="card text-white custom-content page-content mt-0">
                                        <div class="card-body text-center justify-content-center">
                                            <div class="custom-body">
                                                <h2 class="mb-1">UNIDAD DE LABORATORIOS</h2>
                                                <p class="text-white-50">
                                                    Software de Gestión
                                                </p>
                                            </div>
                                            <div class="custom-logo1">
                                                <a href="index.html"><img src="<?php echo e(asset('images/logodtt.png')); ?>" class="header-brand-img dark-logo" alt="logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery js-->
        <script src="<?php echo e(asset('zendash/assets/js/jquery-3.5.1.min.js')); ?>"></script>

        <!-- Bootstrap4 js-->
        <script src="<?php echo e(asset('zendash/assets/plugins/bootstrap/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('zendash/assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

        <!--Othercharts js-->
        <script src="<?php echo e(asset('zendash/assets/plugins/othercharts/jquery.sparkline.min.js')); ?>"></script>

        <!-- Circle-progress js-->
        <script src="<?php echo e(asset('zendash/assets/js/circle-progress.min.js')); ?>"></script>

        <!-- Jquery-rating js-->
        <script src="<?php echo e(asset('zendash/assets/plugins/rating/jquery.rating-stars.js')); ?>"></script>

    </body>
</html>
<?php /**PATH C:\wamp64\www\sistemauncp\laboratorio\resources\views/auth/login.blade.php ENDPATH**/ ?>