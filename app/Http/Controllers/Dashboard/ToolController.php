<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
 use App\Http\Requests\Dashboard\StoreToolsRequest;
 use App\Http\Requests\Dashboard\UpdateToolsRequest;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('view_tools');
        if ($request->ajax()){
            return response(getModelData(model: new Tool()));
        }
        else
             return view('dashboard.tools.index');
    }

    public function store(StoreToolsRequest $request)
    {
        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "tools");
        Tool::create($data);

        return response(["Tool created successfully"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolsRequest $request, Tool $tool)
    {
        // Validate the incoming request
        $data = $request->validated();

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Upload the new image
            $data['image'] = uploadImageToDirectory($request->file('image'), "tools");

            // Optionally, delete the old image from storage if it exists
            if ($tool->image) {
                deleteImageFromDirectory($tool->image, "tools");
            }
        }

         $tool->update($data);

        // Return a success response
        return response(["tool updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $this->authorize('delete_tools');
        $tool->delete();
        return response(["Tool deleted successfully"]);
    }


    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_tools');
        Tool::whereIn('id', $request->selected_items_ids)->delete();
        return response(["Tool deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_tools');
        Tool::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["Tool restored successfully"]);
    }
}
