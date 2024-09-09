<?php

namespace App\Http\Controllers\Lot;

use App\Http\Controllers\Controller;
use App\Services\Lot\LotService;
use Illuminate\Http\Request;

class LotController extends Controller
{
    protected $lotService;

    public function __construct(LotService $auctionService)
    {
        $this->lotService = $auctionService;
    }

    public function getLots()
    {
        return $this->lotService->getLots();
    }

    public function getLot(Request $request)
    {
        return $this->lotService->getLot($request);
    }

    public function createLot(Request $request)
    {
        return $this->lotService->createLot($request);
    }
}
