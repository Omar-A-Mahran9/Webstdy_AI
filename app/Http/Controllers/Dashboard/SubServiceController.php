<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSubServiceRequest;
use App\Http\Requests\Dashboard\UpdateSubServiceRequest;
use App\Models\Service;
use App\Models\SubServices;
use App\Models\Tool;
use Illuminate\Http\Request;

class SubServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_sub_services');

        if ($request->ajax()){
             return response(getModelData(model: new SubServices()));
            }
        else
    $services =   SubServices::select('id', 'name_en','name_ar')->get();
    $tools = Tool::select('id', 'name_en','name_ar')->get();

    return view('dashboard.sub-services.index', compact('services', 'tools'));

    }


    public function store(StoreSubServiceRequest $request)
    {
        $this->authorize('create_sub_services');

        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Services");
        }
        $data['is_publish'] = $request->has('is_publish') ? 1 : 0;

        // Create the AddonService
        SubServices::create($data);

    }




    public function update(UpdateSubServiceRequest $request, Service $service)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Services");
        }
        $data['is_publish'] = $request->has('is_publish') ? 1 : 0;

        $service->update($data);


    }




    public function destroy($id)
    {
        $addonService=  SubServices::find($id);
        $this->authorize('delete_sub_services');
        $addonService->delete();
        return response(["service deleted successfully"]);

    }


    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_sub_services');

          SubServices::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected services deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_sub_services');
          SubServices::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected services restored successfully"]);
    }
}
