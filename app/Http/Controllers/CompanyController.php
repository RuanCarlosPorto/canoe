<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        return $this->companyService->all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        return $this->companyService->store(request()->only(['name']));
    }
}