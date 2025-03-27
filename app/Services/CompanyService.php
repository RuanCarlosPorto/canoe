<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService {
  protected CompanyRepository $companyRepository;

  public function __construct(CompanyRepository $companyRepository) {
    $this->companyRepository = $companyRepository;
  }

  public function all() {
    return $this->companyRepository->all();
  }

  public function store(array $data) {
    return $this->companyRepository->store($data);
  }
}