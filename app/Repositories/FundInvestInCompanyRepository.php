<?php

namespace App\Repositories;

use App\Models\FundInvestInCompany;

class FundInvestInCompanyRepository {
  protected FundInvestInCompany $fundInvestInCompany;

  public function __construct(FundInvestInCompany $fundInvestInCompany) {
    $this->fundInvestInCompany = $fundInvestInCompany;
  }

  public function all() {
    return $this->fundInvestInCompany->all();
  }

  public function store(array $data): FundInvestInCompany {
    return $this->fundInvestInCompany->create($data);
  }
}