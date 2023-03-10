<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\SearchRequest;
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
        $tour = Tour::active()->popular()->with('images','category')->get();
        return new TourResource($tour);
    }

    public function sale()
    {
        $tour = Tour::active()->sale()->with('images','category')->get();
        return new TourResource($tour);
    }

    public function index(SearchRequest $request)
    {
        $tour = Tour::active()->filter($request->all())->with('images','category')->get();
        return new TourResource($tour);
    }

    public function update($id,UpdateRequest $request)
    {
        $tour = Tour::findOrFail($id);
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
        $tour->update();
        if(isset($request->images_token) && is_null($request->images_token))
        {
            $this->attachImages($id,$request->images_token);
        }
        if(isset($request->category) && is_null($request->category))
        {
            $this->attachCategory($id,$request->category);
        }
        return $this->show($id);
    }

    public function show($id)
    {
        $tour = Tour::active()->with('images','category')->find($id);
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
        $this->attachImages($tour->id,$request->images_token);
        $this->attachCategory($tour->id,$request->category);
        return $this->show($tour->id);
    }

    public function attachCategory($tour_id, array $categories):void
    {
        $tour = Tour::find($tour_id);
        $tour->category()->sync($categories);
    }

    public function attachImages($tour_id,array $token):void
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
