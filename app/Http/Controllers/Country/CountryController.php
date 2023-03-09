<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\SearchRequest;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Resources\Country\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(SearchRequest $request):CountryResource
    {
        return new CountryResource(Country::search($request->all())->get());
    }

    public function store(StoreRequest $request):CountryResource
    {
        return new CountryResource(Country::create($request->validated()));
    }

    public function show($id):CountryResource
    {
        return new CountryResource(Country::findOrFail($id));
    }

    public function update(StoreRequest $request, $id):CountryResource
    {
        $country = Country::findOrFail($id);
        $country->update($request->validated());
        return new CountryResource($country);
    }

    public function destroy($id)
    {
        Country::findOrfail($id)->delete();
        return success();
    }
}
