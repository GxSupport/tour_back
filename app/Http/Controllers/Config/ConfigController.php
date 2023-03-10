<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Config\StoreRequest;
use App\Http\Resources\Config\ConfigResource;
use App\Models\Config;
use Illuminate\Http\JsonResponse;

class ConfigController extends Controller
{
    public function store(StoreRequest $request):ConfigResource
    {
        $config = Config::create($request->validated());
        return new ConfigResource($config);
    }

    public function update($id, StoreRequest $request):ConfigResource
    {
        $config = Config::findOrFail($id);
        $config->update($request->validated());
        return new ConfigResource($config);
    }

    public function destroy($id):JsonResponse
    {
        $config = Config::findOrFail($id);
        $config->delete();
        return success();
    }

    public function index():ConfigResource
    {
        $config = Config::all();
        return new ConfigResource($config);
    }
}
