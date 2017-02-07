<div class="panel panel-primary">
	<div class="panel-heading">Ultimos minutos Registrados</div>
	<div class="panel-body">
		<?php foreach($MinutosRegistrados as $value): ?>
		<div class="panel panel-primary">
		<div class="panel-heading"><?php echo e($value->PlanMinutos->nombre_plan_minutos); ?></div>
			<div class="panel-body">		
				<?php echo e($value->fecha_registro); ?>

			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>