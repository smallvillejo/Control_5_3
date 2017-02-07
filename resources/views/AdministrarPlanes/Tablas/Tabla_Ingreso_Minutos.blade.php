<div class="panel panel-primary">
	<div class="panel-heading">Ultimos minutos Registrados</div>
	<div class="panel-body">
		@foreach($MinutosRegistrados as $value)
		<div class="panel panel-primary">
		<div class="panel-heading">{{$value->PlanMinutos->nombre_plan_minutos}}</div>
			<div class="panel-body">		
				{{$value->fecha_registro}}
			</div>
		</div>
		@endforeach
	</div>
</div>