<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request, InventoryService $inventoryService)
    {
        $keyword = $request->get('keyword');
        $inventory = $inventoryService->checkAvailability($keyword);

        return view('admin.inventory.index', compact('inventory', 'keyword'));
    }

    public function sync(Request $request, InventoryService $inventoryService)
    {
        $inventory = $inventoryService->summary();

        return redirect()->route('admin.inventory.index')
            ->with($inventory['configured'] ? 'success' : 'warning', $inventory['message']);
    }
}
