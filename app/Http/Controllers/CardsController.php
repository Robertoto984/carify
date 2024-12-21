<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Enums\Color;
use App\Models\Truck;
use App\Models\Driver;
use App\Enums\FuelTypes;
use App\Models\TruckDeliverCard;
use Illuminate\Support\Facades\Log;
use App\Services\Card\StoreDeliverCardService;
use App\Http\Requests\Cards\StoreDeliverCardRequest;

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
        try {
            $this->storeDeliverCardService->store($request->validated());
            return response()->json([
                'message'=>'تم إضافة بطاقة التسليم بنجاح.',
                'redirect'=>route('trucks.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'حدث خطأ أثناء إضافة البطاقة:',
                'redirect'=>route('trucks.index')
            ]);
            
        }
    }
}
