<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenditure;

class ExpenditureController extends Controller
{
    public function index()
    {
        return view('expenditure.index');
    }

    public function data()
    {
        $expenditure = Expenditure::orderBy('id_expenditure')->get();

        return datatables()
            ->of($expenditure)
            ->addIndexColumn()
            ->addColumn('date', function ($expenditure) {
                return tanggal_indonesia($expenditure->date, false);
            })
            ->addColumn('nominal', function ($expenditure) {
                return 'Rp. '. format_uang($expenditure->nominal);
            })
            ->addColumn('action', function ($expenditure) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('expenditure.update', $expenditure->id_expenditure) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('expenditure.destroy', $expenditure->id_expenditure) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $expenditure = expenditure::create($request->all());

        return response()->json('Data saved successfully', 200);
    }

    public function show($id)
    {
        $expenditure = Expenditure::find($id);

        return response()->json($expenditure);
    }

    public function update(Request $request, $id)
    {
        $expenditure = Expenditure::find($id)->update($request->all());

        return response()->json('Data saved successfully', 200);
    }

    public function destroy($id)
    {
        $expenditure = Expenditure::find($id)->delete();

        return response(null, 204);
    }
}
