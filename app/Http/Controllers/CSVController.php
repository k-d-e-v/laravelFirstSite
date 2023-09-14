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
        $file = $request->fileupload;
        $header = fgetcsv($file);
        $users = [];
        while ($row = fgetcsv($file)) {
            $users[] = array_combine($header, $row);
        }

        foreach ($users as $u) { //Caution: I am just guessing if this will work
            $csv = new CSV([
                'companyname' => $u[0],
                'firstname' => $u[1],
                'lastname' => $u[2],
                'email' => $u[3],
                'phonenumber' => $u[4]
            ]);
            $csv->save();
        }

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
