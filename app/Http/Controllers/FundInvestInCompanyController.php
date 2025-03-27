<?php

namespace App\Http\Controllers;

use App\Services\FundInvestInCompanyService;
use Illuminate\Http\Request;

class FundInvestInCompanyController extends Controller
{
    protected FundInvestInCompanyService $fundInvestInCompanyService;

    public function __construct(FundInvestInCompanyService $fundInvestInCompanyService) {
        $this->fundInvestInCompanyService = $fundInvestInCompanyService;
    }

    public function index() {
        return $this->fundInvestInCompanyService->all();
    }

    public function store(Request $request) {
        $request->validate([
            'fund_id' => 'required|integer|exists:funds,id',
            'company_id' => 'required|integer|exists:companies,id',
            'amount' => 'required|numeric',
        ]);

        return $this->fundInvestInCompanyService->store(request()->only(['fund_id', 'company_id', 'amount']));
    }
}