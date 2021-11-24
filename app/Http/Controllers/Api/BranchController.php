<?php
namespace App\Http\Controllers\Api;

use App\Laravue\Models\Branch;
use App\Laravue\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        return Branch::all();
    }

    public function store(Request $request)
    {
        $branch = new Branch();
        $branch->fill($request->all());
        $branch->company_id = 1;
        $branch->saveOrFail();
        return $branch;
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->fill($request->all());
        $branch->saveOrFail();
        return $branch;
    }
}
