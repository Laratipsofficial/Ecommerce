<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttentionRequest;
use App\Http\Resources\AttentionResource;
use App\Models\Tables\Attention;

class AttentionController extends Controller
{
    public function index()
    {
        return AttentionResource::collection(Attention::all());
    }

    public function store(AttentionRequest $request)
    {
        return new AttentionResource(Attention::create($request->validated()));
    }

    public function show(Attention $attention)
    {
        return new AttentionResource($attention);
    }

    public function update(AttentionRequest $request, Attention $attention)
    {
        $attention->update($request->validated());

        return new AttentionResource($attention);
    }

    public function destroy(Attention $attention)
    {
        $attention->delete();

        return response()->json();
    }
}
