<?php

namespace App\Contracts\FundAlias;

interface iFundAlias {
  public string $alias { get; set; }
  public int $fund_id { get; set; }
}