@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="float:left; width:100%;">
                    <span style="float:left;padding-top:10px;">Dashboard</span>
                    <a class="btn btn-default" href="/reporting" style="float:right;">See report</a>
                </div>

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Client info -->
                    <div class="col-md-12">
                        <h3>Client information</h3>
                        <p>Balance: <span>{{auth()->user()->balance}}</span></p>
                        <p>Bonus: <span>{{auth()->user()->bonus}}</span></p>
                        <p>Bonus params: <span>{{auth()->user()->bonus_param}}%</span></p>
                    </div>
                    <!-- Client actions -->
                    <div class="col-md-12">
                        <h3>Client actions</h3>
                        <div class="col-md-6" style="padding-left: 0;">
                            <form method="post" action="{{route('deposit')}}">
                                {{ csrf_field() }}
                                <div class="col-md-12" style="padding-left: 0; display:flex; flex-direction: column">
                                    <label>Deposit amount</label>
                                    <input type="text" name="deposit" />
                                    <input type="hidden" name="type" value="1" />
                                    @if ($errors->has('deposit'))
                                        <span style="color:red;">{{ $errors->first('deposit') }}</span>
                                    @endif
                                    <select name="countryIdDeposit">
                                        <option disabled selected value>Select country</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('countryIdDeposit'))
                                        <span style="color:red;">{{ $errors->first('countryIdDeposit') }}</span>
                                    @endif
                                    <input class="col-md-4" type="submit" class="btn" value="Send"/>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="{{route('withdraw')}}">
                                {{ csrf_field() }}
                                <div class="col-md-12" style="display:flex; flex-direction: column">
                                    <label>Withdraw amount</label>
                                    <input type="text" name="withdraw" />
                                    <input type="hidden" name="type" value="0" />
                                    @if ($errors->has('withdraw'))
                                        <span style="color:red;">{{ $errors->first('withdraw') }}</span>
                                    @endif
                                    <select name="countryIdWithdraw">
                                        <option disabled selected value>Select country</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('countryIdWithdraw'))
                                        <span style="color:red;">{{ $errors->first('countryIdWithdraw') }}</span>
                                    @endif
                                    <input class="col-md-4" type="submit" class="btn" value="Send"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
