<?php

namespace App\Repositories;

use App\Models\FundAlias;
use Illuminate\Database\Eloquent\Collection;

class FundAliasRepository {
  protected FundAlias $fundAlias;

  public function __construct(FundAlias $fundAlias) {
    $this->fundAlias = $fundAlias;
  }

  public function all() {
    return $this->fundAlias->all();
  }

  public function store(array $data): FundAlias {
    return $this->fundAlias->create($data);
  }

  public function storeMany(array $data): Collection {
    return $this->fundAlias->saveMany($data);
  }

  public function updateOrCreate(array $key, array $data): FundAlias {
    return $this->fundAlias->updateOrCreate($key, $data);
  }
}