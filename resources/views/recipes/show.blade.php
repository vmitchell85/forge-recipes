@extends('layouts.app')

@section('content')
<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t flex">
                <div class="flex-1">{{$recipe->title}}</div>
                <div class="text-sm"><span class="text-xxs text-grey-dark uppercase tracking-wide">created by: </span>{{$recipe->owner->name}}</div>
            </div>
            <div class="bg-white p-3 rounded-b">
                <recipes-show :recipe="{{$recipe}}"></recipes-show>
            </div>
        </div>
    </div>
</div>
@endsection
