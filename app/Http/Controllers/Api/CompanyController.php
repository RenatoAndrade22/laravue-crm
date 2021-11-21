<?php

namespace App\Http\Controllers\Api;

use App\Laravue\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{

    public function index()
    {
        return Company::all();
    }


    public function store(Request $request)
    {
        $company = new Company();
        $company->fill($request->all());
        $company->saveOrFail();
        return $company;
    }

    public function show(Request $request)
    {

    }

    public function update(Request $request)
    {
    }

}
