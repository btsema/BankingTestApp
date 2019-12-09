@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Table display -->
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th width="100px">Date</th>
                                    <th>Country</th>
                                    <th>Unique Customers</th>
                                    <th>No of Deposits</th>
                                    <th>Total Deposit Amount</th>
                                    <th>No of Withdrawals</th>
                                    <th>Total Withdrawal Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportings as $reporting)
                                    <tr>
                                        <td>{{$date}}</td>
                                        <td>{{$reporting->code}}</td>
                                        <td>{{$reporting->Unique_Customers}}</td>
                                        <td>{{$reporting->No_of_Deposits}}</td>
                                        <td>{{$reporting->deposit}}</td>
                                        <td>{{$reporting->No_of_withdraw}}</td>
                                        <td>-{{$reporting->withdraw}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
