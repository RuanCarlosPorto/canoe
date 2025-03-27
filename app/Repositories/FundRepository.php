<?php

namespace App\Repositories;

use App\Models\Fund;
use Illuminate\Support\Facades\DB;

class FundRepository
{
    protected Fund $fund;

    public function __construct(Fund $fund)
    {
        $this->fund = $fund;
    }

    public function all()
    {
        return $this->fund->get();
    }

    public function filter(string $filter)
    {
        return $this->fund
            ->join('companies', 'funds.fund_manager_id', '=', 'companies.id')
            ->where('funds.name', 'like', "%$filter%")
            ->orWhere('companies.name', 'like', "%$filter%")
            ->orWhere('start_year', 'like', "%$filter%")
            ->orWhere('start_year', 'like', "%$filter%")
            ->get('funds.*');
    }

    public function delete(int $id): void
    {
        $this->fund->findOrFail($id)->delete();
    }

    public function findAllPossibleDuplicates()
    {
        return $this->fund
            ->select('funds.*', 'f2.id as duplicate_id', 'f2.name as duplicate_name', 'f2.aliases as duplicate_aliases')
            ->join('funds as f2', function ($join) {
                $join->on('f2.name', '=', 'funds.name')
                    ->orWhere('f2.aliases', 'like', DB::raw('CONCAT("%", funds.name, "%")'));
            })
            ->whereColumn('f2.id', '!=', 'funds.id')
            ->whereNull('funds.deleted_at')
            ->whereNull('f2.deleted_at')
            ->get();
    }

    public function findPossibleDuplicatesByNewFund($managerId, $name)
    {
        return $this->fund
            ->where('fund_manager_id', $managerId)
            ->where(
                fn($query) => $query
                    ->where('name', $name)
                    ->orWhere('aliases', 'like', "%\"$name\"%")
            )
            ->get();
    }

    public function store(array $data): Fund
    {
        return $this->fund->create($data);
    }

    public function update(int $id, array $data): Fund
    {
        $fund = $this->fund->findOrFail($id);
        $fund->update($data);

        return $fund;
    }
}
