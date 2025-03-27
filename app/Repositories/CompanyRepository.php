<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository {
  protected Company $company;

  public function __construct(Company $company) {
    $this->company = $company;
  }

  public function getIdsByName() {
    return $this->company->pluck('name', 'id');
  }

  public function all() {
    return $this->company->all();
  }

  public function store(array $data): Company {
    return $this->company->create($data);
  }
}