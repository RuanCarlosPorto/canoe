<?php

namespace App\Contracts\Fund;

interface iFund {
  public string $name { get; set; }
  public string $fund_manager_id { get; set; }
  public int $start_year { get; set; }
}