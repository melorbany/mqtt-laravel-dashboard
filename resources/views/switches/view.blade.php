@extends('layouts.dashboard')
@section('page_heading',$unit->title)

@section('section')
<div class="col-sm-12">
<div class="row">

	<div class="col-sm-12">
		<p>
			<a href="/components/create" type="button" class="btn btn-primary">Add Component</a>
		</p>

		<div class="marg"></div>
		<table class="table table-bordered">
			<thead>
			<tr>
				<th width="20%">ID</th>
				<th width="20%">Title</th>
				<th width="20%">Admin</th>
				<th width="20%">Date</th>
			</tr>
			</thead>
			<tbody>



			@foreach($components as $component)
				<tr>
					<td><a href="/components/{{$component->id}}">{{$component->id}}</a></td>
					<td>{{$component->title}}</td>
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