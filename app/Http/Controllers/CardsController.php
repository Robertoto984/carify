<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Enums\FuelTypes;
use App\Http\Requests\Cards\StoreDeliverCardRequest;
use App\Models\Driver;
use App\Models\Truck;
use App\Models\TruckDeliverCard;
use App\Services\Card\StoreDeliverCardService;

class CardsController extends Controller
{
    protected $storeDeliverCardService;

    public function __construct(StoreDeliverCardService $storeDeliverCardService)
    {
        $this->storeDeliverCardService = $storeDeliverCardService;
    }

    public function index()
    {
        $cards = TruckDeliverCard::with(['truck', 'driver'])->get();
        return view('cards.index', \compact('cards'));
    }
    public function create($id)
    {
        $drivers = Driver::select('id', 'first_name','last_name')->get();
        $colors = Color::values();
        $fuelTypes = FuelTypes::values();
        $truck = Truck::findOrFail($id);

        return view('trucks.deliver_order', \compact('colors','fuelTypes','drivers','truck'));
    }

    public function store(StoreDeliverCardRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $this->storeDeliverCardService->store($validatedData);
            
            return redirect()->route('trucks.index')
                ->with('message', 'تم إضافة بطاقة التسليم بنجاح.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
