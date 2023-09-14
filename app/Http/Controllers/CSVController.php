<?php

namespace App\Http\Controllers;

use App\Models\CSV;
use Illuminate\Http\Request;

class CSVController extends Controller
{
    // all CSV
    public function index()
    {
        $csvs = CSV::all()->toArray();
        return array_reverse($csvs);
    }

    // add CSV
    public function add(Request $request)
    {
        $csv = new CSV([
            'companyname' => $request->companyname,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber
        ]);
        $csv->save();

        return response()->json('The CSV has been successfully added');
    }

    // edit CSV
    public function edit($id)
    {
        $csv = CSV::find($id);
        return response()->json($csv);
    }

    // update CSV
    public function update($id, Request $request)
    {
        $csv = CSV::find($id);
        $csv->update($request->all());

        return response()->json('The CSV has been successfully updated');
    }

    // delete CSV
    public function delete($id)
    {
        $csv = CSV::find($id);
        $csv->delete();

        return response()->json('The CSV has been successfully deleted');
    }
}
