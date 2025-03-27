<?php

namespace App\Services;

use App\Models\FundInvestInCompany;
use App\Repositories\FundInvestInCompanyRepository;

class FundInvestInCompanyService
{
    protected FundInvestInCompanyRepository $fundInvestInCompanyRepository;

    public function __construct(FundInvestInCompanyRepository $fundInvestInCompanyRepository) {
        $this->fundInvestInCompanyRepository = $fundInvestInCompanyRepository;
    }

    public function all() {
        return $this->fundInvestInCompanyRepository->all();
    }

    public function store(array $data): FundInvestInCompany {
        return $this->fundInvestInCompanyRepository->store($data);
    }
}