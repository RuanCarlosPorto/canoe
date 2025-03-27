<?php

namespace App\Services;

use App\Events\DuplicateFundWarning;
use App\Repositories\CompanyRepository;
use App\Repositories\FundRepository;
use Illuminate\Database\Eloquent\Collection;

class FundService
{
    protected FundRepository $fundRepository;
    protected CompanyRepository $companyRepository;

    public function __construct(
        FundRepository $fundRepository,
        CompanyRepository $companyRepository
    ) {
        $this->fundRepository = $fundRepository;
        $this->companyRepository = $companyRepository;
    }

    public function duplicates() {
        return $this->fundRepository->findAllPossibleDuplicates();
    }

    public function all(string | null $filter)
    {
        if ($filter == null) {
            return $this->fundRepository->all();
        }

        return $this->fundRepository->filter($filter);
    }

    public function delete(int $id)
    {
        $this->fundRepository->delete($id);
    }

    public function store(array $data)
    {
        $duplicates = $this->fundRepository->findPossibleDuplicatesByNewFund(
            $data['fund_manager_id'],
            $data['name']
        );

        $fund = $this->fundRepository->store($data);

        if ($duplicates->count() > 0) {
            event(new DuplicateFundWarning($fund, $duplicates));
        }

        return $fund;
    }

    public function update(int $id, array $data)
    {
        return $this->fundRepository->update($id, $data);
    }
}
