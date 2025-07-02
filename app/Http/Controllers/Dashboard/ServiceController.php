<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
 use App\Http\Requests\Dashboard\StoreServiceRequest;
use App\Http\Requests\Dashboard\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_services');

        if ($request->ajax()){
             return response(getModelData(model: new Service()));
            }
        else
             return view('dashboard.services.index');
    }


    public function store(StoreServiceRequest $request)
    {
        $this->authorize('create_services');

        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Services");
        }
        $data['is_publish'] = $request->has('is_publish') ? 1 : 0;

        // Create the AddonService
        Service::create($data);

    }




    public function update(UpdateServiceRequest $request, Service $service)
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
        $addonService=Service::find($id);
        $this->authorize('delete_services');
        $addonService->delete();
        return response(["service deleted successfully"]);

    }


    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_services');

        Service::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected services deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_services');
        Service::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected services restored successfully"]);
    }
}
