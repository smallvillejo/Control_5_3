	
	<?php $__env->startSection('title'); ?>
	Administrar Recargas
	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('content'); ?>	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-phone-square" aria-hidden="true"></i>
				<a href="#">Administrar Recargas</a>
				<i class="fa fa-angle-right"></i>
			</li>				
		</ul>			
	</div>
	<div class="container">
		<h2>Panels with Contextual Classes</h2>
		<div class="panel-group">
			<div class="panel panel-danger">
				<div class="panel-heading">Panel with panel-danger class</div>
				<div class="panel-body">Panel Content</div>
			</div>
		</div>
	</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>