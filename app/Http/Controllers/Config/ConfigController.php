<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Config\StoreRequest;
use App\Http\Resources\Config\ConfigResource;
use App\Models\Config;
use Illuminate\Http\JsonResponse;

/**
 * @group Config (Sayt haqidagi ma'lumotlar)
 */
class ConfigController extends Controller
{
    /**
     *  Config Save
     *  @authenticated
     */
    public function store(StoreRequest $request):ConfigResource
    {
        $config = Config::create($request->validated());
        return new ConfigResource($config);
    }

    /**
     *  Config update
     *  @urlParam id integer required. Configni id si
     *  @authenticated
     */
    public function update($id, StoreRequest $request):ConfigResource
    {
        $config = Config::findOrFail($id);
        $config->update($request->validated());
        return new ConfigResource($config);
    }

    /**
     *  Config delete
     *  @urlParam id integer required. Configni id si
     *  @authenticated
     */
    public function destroy($id):JsonResponse
    {
        $config = Config::findOrFail($id);
        $config->delete();
        return success();
    }

    /**
     *  Config list
     */
    public function index():ConfigResource
    {
        $config = Config::all();
        return new ConfigResource($config);
    }
}
