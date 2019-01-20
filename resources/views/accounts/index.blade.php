@extends('layouts.dashboard')
@section('page_heading','Accounts')

@section('section')
<div class="col-sm-12">
<div class="row">
	<div class="col-sm-12">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Admin</th>
				<th>Date</th>
			</tr>
			</thead>
			<tbody>



			@foreach($accounts as $account)
				<tr>
					<td>{{$account->name}}</td>
					<td>{{$account->email}}</td>
					<td>{{$account->phone}}</td>
					<td>{{$account->user_id}}</td>
					<td>{{date("d M Y", strtotime($account->updated_at))}}</td>

				</tr>

			@endforeach

			</tbody>
		</table>
	</div>
</div>
</div>
@stop