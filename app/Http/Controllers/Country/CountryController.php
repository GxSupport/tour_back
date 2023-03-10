<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\SearchRequest;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Resources\Country\CountryResource;
use App\Models\Country;

/**
 * @group Country
 */
class CountryController extends Controller
{
    /**
     *  Country ni id orqali olish
     *  @urlParam search string optional.Izlash(search) uchun
     */
    public function index(SearchRequest $request):CountryResource
    {
        return new CountryResource(Country::search($request->all())->get());
    }

    /**
     *  Country yaratish
     *  @authenticated
     */
    public function store(StoreRequest $request):CountryResource
    {
        return new CountryResource(Country::create($request->validated()));
    }

    /**
     *  Country ni id orqali olish
     *  @urlParam id integer required.Country id
     */
    public function show($id):CountryResource
    {
        return new CountryResource(Country::findOrFail($id));
    }

    /**
     *  Country ni yangilash(update)
     *  @urlParam id integer required.Country ni id si
     *  @authenticated
     */
    public function update(StoreRequest $request, $id):CountryResource
    {
        $country = Country::findOrFail($id);
        $country->update($request->validated());
        return new CountryResource($country);
    }

    /**
     *  Country ni o'chirish
     *  @urlParam id integer required.Countryni id si
     *  @authenticated
     */
    public function destroy($id)
    {
        Country::findOrfail($id)->delete();
        return success();
    }
}
