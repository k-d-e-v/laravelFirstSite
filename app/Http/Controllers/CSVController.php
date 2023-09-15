<?php

namespace App\Http\Controllers;

use App\Models\CSV;
use Illuminate\Http\Request;

class CSVController extends Controller
{
    // read CSV and return an array
    private function readCSV($file)
    {
        return array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
    }
    // all CSV
    public function index()
    {
        $csvs = CSV::all()->toArray();
        return array_reverse($csvs);
    }

    // add CSV
    public function add(Request $request)
    {
        $file = CSVController::readCSV($request->file('fileupload')->get());

        //Remove the header
        array_shift($file);

        foreach ($file as $item) {
            $csv = new CSV([$item[0], $item[1], $item[2], $item[3], $item[4]]);
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
