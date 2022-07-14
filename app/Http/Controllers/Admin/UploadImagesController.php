<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UploadImagesController extends Controller
{
    public function __invoke(Request $request)
    {
        $modelClass = Relation::getMorphedModel($request->modelType);

        $validation = Validator::make($request->all(), [
            'image' => [
                'bail',
                'required',
                'image',
                'max:1024',
            ],
            'modelType' => [
                'bail',
                'required',
                'string',
                Rule::in(array_keys(Relation::morphMap()))
            ],
            'modelId' => [
                'bail',
                'required',
                'integer',
                Rule::exists($modelClass, 'id'),
            ],
        ]);

        if ($validation->fails()) {
            return response($validation->errors()->first(), 400);
        }

        // upload the image
        /** @var \Spatie\MediaLibrary\InteractsWithMedia */
        $model = $modelClass::find($request->modelId);

        $model->addMediaFromRequest('image')
            ->withResponsiveImages()
            ->toMediaCollection();

        return response("Success");
    }
}
