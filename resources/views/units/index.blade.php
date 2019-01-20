@extends('layouts.dashboard')
@section('page_heading','Units')

@section('section')
<div class="col-sm-12">
<div class="row">

	<div class="col-sm-12">
		<p>
			<a href="/units/create" type="button" class="btn btn-primary">Add Unit</a>
			<br>
		</p>

		<div class="marg"></div>
		<table class="table table-bordered">
			<thead>
			<tr>
				<th width="20%">Building #</th>
				<th width="20%">ID</th>
				<th width="20%">Title</th>
				<th width="20%">Admin</th>
				<th width="20%">Date</th>
			</tr>
			</thead>
			<tbody>



			@foreach($units as $unit)
				<tr>
					<td>{{$unit->building_id}}</td>
					<td><a href="/units/{{$unit->id}}">{{$unit->id}}</a></td>
					<td>{{$unit->title}}</td>
					<td>{{$unit->user_id}}</td>
					<td>{{date("d M Y", strtotime($unit->updated_at))}}</td>

				</tr>

			@endforeach

			</tbody>
		</table>
	</div>
</div>
</div>
@stop