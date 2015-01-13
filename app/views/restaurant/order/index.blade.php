@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Order List</h1>
{{Notification::showAll()}}
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Order Number</th>
				<th>The Foods of Order</th>
				<th>The Address of User</th>
				<th>The Telephone of User</th>
				<th>Status</th>
				<th>Created Time</th>
			</tr>
		</thead>
	</table>
</div>

@stop