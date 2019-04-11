<?php

//  App Controller
////////////////////////////////////////////////////////////////////////////////

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AppController extends Controller
{

    // Calculate Total Income
    private function calculate_total_income($data)
    {
        // Set Initial Total to 0
        $total = 0;

        // If data is available...
        if ($data)
        {
            // For each data amount...
            foreach ($data as $item)
            {
                // Add the amount to the total
                $total += $item['amount'];
            }

            // Formate the Total with a Dollar Sign ($) Prefix
            if($total >= 0)
            {
                $total = "$ ".number_format($total, 2);
            }
            else
            {
                $total = $total * -1;
                $total = "- $ ".number_format($total, 2);
            }
        }

        // Return the Total
        return $total;
    }


    // The Main View Pageload Controller
    public function main(Request $request)
    {

        // Get Session Data
        $data = $request->session()->get('data');

        // Calculate a Total by Summing the Data
        $total = $this->calculate_total_income($data);

        // Render the Main Form View, passing Data and Total to it
        return view('form')->with([
            'data' => $data,
            'total' => $total
        ]);
    }


    // Add a Ledger Entry
    public function add(Request $request)
    {

        // Validate the Form Inputs w/ Laravel Request->validate
        $request->validate([
            'category' => "required",
            'amount' => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",
            'type' => "required",
            'entity' => "required"
        ]);


        // Retrieve Input Values from the Request
        $date = date("Y-m-d H:i:s", time());
        $category = $request->input('category');
        $amount = number_format($request->input('amount'), 2);
        $type = $request->input('type');
        $entity = $request->input('entity');


        // Make "Amount" Positive or Negative based on Expense/Income designation
        if ($type == "to")
        {
            $amount = number_format(($amount * -1), 2);
        }


        // Create an Array of Final Values
        $data = [
            'date' => $date,
            'category' => $category,
            'amount' => $amount,
            'type' => $type,
            'entity' => $entity
        ];


        // If no session array for Data exists...
        if (!$request->session()->has('data'))
        {
            // Create a Session variable for Data
            $request->session()->put('data');

            // And Push the current Data Array to the Data Session variable
            $request->session()->push('data', $data);
        }
        // Or, simply push the Data array to the pre-existing Session.
        else
        {
            $request->session()->push('data', $data);
        }


        // Get any Array of Session Data
        $data = $request->session()->get('data');

        // Calculate a Total
        $total = $this->calculate_total_income($data);


        // Render the Main Form View, passing Data and Total to it
        return view('form')->with([
            'submit' => $request->input('submit'),
            'data' => $request->session()->get('data'),
            'total' => $total
        ]);

    }


    // Remove the Last Ledger Entry
    public function delete_last(Request $request)
    {
        // Count the number of elements in Current Session Array, and delete last
        if ($data = $request->session()->get('data'))
        {
            $count = count($data) - 1;
            $request->session()->forget('data.'.$count);
        }

        // Redirect
        return redirect('/');
    }


    // Clear/ Delete All Ledger Entries
    public function delete_all(Request $request)
    {
        // Delete Data from Session
        $request->session()->forget('data');

        // Redirect
        return redirect('/');
    }

}
