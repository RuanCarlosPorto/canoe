<?php

namespace App\Http\Controllers;

use App\Services\FundService;
use Illuminate\Http\Request;

class FundController extends Controller
{
    protected FundService $fundService;

    public function __construct(FundService $fundService)
    {
        $this->fundService = $fundService;
    }

    public function delete($id)
    {
        return $this->fundService->delete($id);
    }

    public function duplicates()
    {
        return $this->fundService->duplicates();
    }

    public function index(Request $request)
    {
        return $this->fundService->all($request->search);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'fund_manager_id' => 'required|integer|exists:companies,id',
            'start_year' => 'required|integer',
            'aliases' => 'array',
            'aliases.*' => 'string',
        ]);

        return $this
            ->fundService
            ->store(request()->only(['name', 'fund_manager_id', 'start_year', 'aliases']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'fund_manager_id' => 'required|integer|exists:companies,id',
            'start_year' => 'required|integer',
            'aliases' => 'array',
            'aliases.*' => 'string',
        ]);

        return $this
            ->fundService
            ->update($id, request()->only(['name', 'fund_manager_id', 'start_year', 'aliases']));
    }
}
