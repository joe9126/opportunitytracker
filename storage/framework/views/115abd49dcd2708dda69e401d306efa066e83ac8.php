
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $__env->yieldContent('title'); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
    
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="icon" type="image/ico" href="<?php echo e(url('images',['primecrm.ico'])); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('css',['bootstrap.min.css'])); ?>" type="text/css" >
   <link rel="stylesheet" type="text/css" href="<?php echo e(url('css',['bootstrap-datepicker.min.css'])); ?>">
    <link rel="stylesheet" href="<?php echo e(url('css',['styles.css'])); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('css',['datatables.jqueryui.min.css'])); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('css',['jquery-ui.css'])); ?>" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa Slab One">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--<link rel="stylesheet" type="text/css" href="<?php echo e(url('css',['fontawesome.css'])); ?>">-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css',['tooltipster.bundle.min.css'])); ?>">


    <script src="<?php echo e(url('js',['jquery.min.js'])); ?>" ></script>
    <script src="<?php echo e(url('js',['bootstrap.min.js'])); ?>" ></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="<?php echo e(url('js',['tooltipster.bundle.min.js'])); ?>" ></script>
    <script type="text/javascript" src="<?php echo e(url('js',['scripts.js'])); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js',['login.js'])); ?>"></script>
     <script type="text/javascript" src="<?php echo e(url('js',['jquery-ui.js'])); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js',['jquery.validate.min.js'])); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js',['ajaxfileupload.js'])); ?>"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.2/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.2/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>   
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
     
    <script type="text/javascript" src="<?php echo e(url('js',['dataTables.rowsGroup.js'])); ?>"></script>
     
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.js"></script>
    <script type="text/javascript" src="<?php echo e(url('js',['moment.js'])); ?>"></script>
    
    <script type="text/javascript" src="<?php echo e(url('js',['numeral.js'])); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js',['inputautocomplete.js'])); ?>"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script type="text/javascript" src="<?php echo e(url('js',['bootstrap-datepicker.min.js'])); ?>"></script>
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body>
    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
</body>
<footer>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center">
            <span >Built By <a href="https://www.linkedin.com/in/joash-owaga-2b627886/" target="_blank">Joash Asewe </a>&#169; <script>document.write(new Date().getFullYear())</script> </span>
        </div>
        <div class="col-md-4"></div>
    </div>
</footer>
</html>
<?php /**PATH /home/symphon3/symphonycrm/resources/views/layout/master.blade.php ENDPATH**/ ?>