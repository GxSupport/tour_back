<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\StoreRequest;
use App\Http\Requests\Tour\UpdateRequest;
use App\Http\Resources\Tour\TourResource;
use App\Models\Images;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function popular()
    {
        $tour = Tour::popular()->get();
        return new TourResource($tour);
    }

    public function sale()
    {
        $tour = Tour::sale()->get();
        return new TourResource($tour);
    }

//    filterni oxiriga yetkazish kerak
    public function index(Request $request)
    {
        $tour = Tour::filter($request->all())->get();
        return new TourResource($tour);
    }

    public function update($id,UpdateRequest $request)
    {
        $tour = Tour::findOrFail($id);
        $tour->update($request->validated());
        return new TourResource($tour);
    }

    public function store(StoreRequest $request)
    {
        $tour = new Tour();
        $tour->name_ru=$request->name_ru;
        $tour->name_uz=$request->name_uz;
        $tour->name_en=$request->name_en;
        $tour->description_ru=$request->description_ru;
        $tour->description_uz=$request->description_uz;
        $tour->description_en=$request->description_en;
        $tour->price=$request->price;
        $tour->country_id=$request->country_id;
        $tour->sale=$request->sale;
        $tour->is_active=$request->is_active;
        $tour->is_popular=$request->is_popular;
        $tour->save();
        $this->attach($tour->id,$request->images_token);
        return $tour;
    }
    public function attach($tour_id,array $token):void
    {
        $tour = Tour::find($tour_id);
        $imagesId = $this->getImagesId($token);
        $tour->images()->sync($imagesId);
    }

    public function getImagesId(array $tokens):array
    {
        $id = [];
        foreach ($tokens as $token) {
            $images = Images::where('token',$token)->first();
            if(!is_null($images)){
                $images->is_active = 1;
                $images->update();
                $id[] = $images->id;
            }
        }
        return $id;
    }

}
