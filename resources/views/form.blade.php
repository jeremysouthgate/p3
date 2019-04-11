<!-- Extends the Layout -->
@extends('layout')


<!-- Form Section -->

@section('content')

<!-- The Main App Interface Form -->
<form method='POST' action='/' id='main_interface'>

    <!-- Laravel Cross-Site Scripting Security Feature -->
    {{ csrf_field() }}


    <!-- Prompt -->
    <h4 id='prompt'>Create a Ledger Entry. <small><i>All fields are required.</i></small></h5>


    <!-- Ledger Entry Category -->
    <div>
        <div class='label'>
            <label>Category</label>
        </div>
        <div class='input'>
            <select name='category'>
                @if (old('category'))
                    <option selected value="{{ old('category') }}">{{ old('category') }}</option>
                @else
                    <option selected disabled>None</option>
                @endif
                <option value='Income'>Income</option>
                <option value='Gift'>Gift</option>
                <option disabled>&nbsp;</option>
                <option value='One-time Expense'>One-time Expense</option>
                <option value='Regular Expense'>Regular Expense</option>
                <option disabled>&nbsp;</option>
                <option value='Food'>Food</option>
                <option value='Gas'>Gas</option>
                <option value='Online Shopping'>Online Shopping</option>
            </select>
        </div>
    </div>
    @if ($errors->get('category'))
        <div class="error">{{ $errors->first('category') }}</div>
    @endif


    <!-- Ledger Entry Amount -->
    <div>
        <div class='label'>
            <label>Amount</label>
        </div>
        <div class='input'>
            <input type='number' min='0.01' step='0.01' max='1000000000000' name='amount' placeholder="e.g. 100"  value="{{ old('amount') }}"/>
        </div>
    </div>
    @if ($errors->get('amount'))
        <div class="error">{{ $errors->first('amount') }}</div>
    @endif


    <!-- Ledger Entry Type (Income or Expense described as paid "to" or received "from") -->
    <div>
        <div class='label'>
            <label>Type</label>
        </div>
        <div class='input'>
            <div class='radio'>
                <input type='radio' name='type' value='from' @if (old('type') == 'from') checked @endif/><label>From</label>
                <input type='radio' name='type' value='to' @if (old('type') == 'to') checked @endif/><label>To</label>
            </div>
        </div>
    </div>
    @if ($errors->get('type'))
        <div class="error">{{ $errors->first('type') }}</div>
    @endif


    <!-- Ledger Entry Entity - the one paying out or receiving payment -->
    <div>
        <div class='label'>
            <label>Entity</label>
        </div>
        <div class='input'>
            <input type='text' name='entity' placeholder="e.g. Employment, Inc."  value="{{ old('entity') }}"/>
        </div>
    </div>
    @if ($errors->get('entity'))
        <div class="error">{{ $errors->first('entity') }}</div>
    @endif


    <!-- Submit the Form to Commit a Ledger Entry -->
    <div>
        <div class='label'></div>
        <div class='input'>
            <input type='submit' name='submit' value='Add to Ledger'/>
        </div>
    </div>

</form>


<!-- Delete the Last Entry -->
<form method='POST' action='/delete_last'>

    <!-- Laravel Cross-Site Scripting Security Feature -->
    {{ csrf_field() }}

    <!-- Button -->
    <input type='submit' name='delete_last' value='Delete Last Entry' id='delete_last'/>

</form>


<!-- Delete All/Clear the Whole Form -->
<form method='POST' action='/delete_all'>

    <!-- Laravel Cross-Site Scripting Security Feature -->
    {{ csrf_field() }}

    <!-- Button -->
    <input type='submit' name='delete_all' value='Delete All Entries' id='delete_all'/>

</form>

@endsection


<!-- Results Section -->

@section('results')

<!-- If there is data written to the Session... -->
@if (isset($data))

    <div id='results'>

        <!-- Print Results Header -->
        <div id='results_header'>
            <h2>Contents</h2>
        </div>

        <!-- Print Column Headers for Results -->
        <div class='data_row'>
            <li><b>Datetime</b></li>
            <li><b>Category</b></li>
            <li><b>Amount</b></li>
            <li><b>Type</b></li>
            <li><b>Entity</b></li>
        </div>

        <!-- Print Data to Columns, Row by Row -->
        @foreach ($data as $data)
            <div class='data_row'>
                <li>{{ $data['date'] }}</li>
                <li>{{ $data['category'] }}</li>
                <li>{{ $data['amount'] }}</li>
                <li>{{ $data['type'] }}</li>
                <li>{{ $data['entity'] }}</li>
            </div>
        @endforeach

        <!-- Finally, if available: Print a Total -->

        <div id='total'>
            @if (isset($total))
                <h2>{{ $total }}</h2>
            @endif
        </div>

    </div>

@endif

@endsection
