<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCountryRequest;
use App\Http\Requests\Dashboard\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $count_countries = Country::count(); // Get the count of blogs

        $this->authorize('view_countries');

        if ($request->ajax())
            return response(getModelData(model: new Country()));
        else
            return view('dashboard.countries.index',compact('count_countries' ));
    }

    public function store(StoreCountryRequest $request)
    {
        $data = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "countries");

        Country::create($data);

        return response(["Country created successfully"]);
    }

    public function update(UpdateCountryRequest $request, Country $Country)
    {
        $data = $request->validated();

        if($request->file('image'))
        $data['image'] = uploadImageToDirectory($request->file('image'), "countries");

        $Country->update($data);

        return response(["Country updated successfully"]);
    }

    public function destroy(Country $Country)
    {
        $this->authorize('delete_countries');

        $Country->delete();

        return response(["Country deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_countries');

        Country::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected countries deleted successfully"]);
    }
    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_countries');

        Country::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected countries restored successfully"]);
    }
}
