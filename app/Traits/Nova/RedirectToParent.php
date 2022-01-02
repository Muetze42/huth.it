<?php

namespace App\Traits\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;

trait RedirectToParent
{
    /**
     * Return the location to redirect the user after creation.
     * @param NovaRequest $request
     * @param $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource): string
    {
        if ($request->input('viaResource')) {
            return '/resources/'.$request->input('viaResource').'/'.$request->input('viaResourceId');
        }
        return parent::redirectAfterCreate($request, $resource);
    }

    /**
     * Return the location to redirect the user after update.
     * @param NovaRequest $request
     * @param $resource
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource): string
    {
        if ($request->input('viaResource')) {
            return '/resources/' . $request->input('viaResource') . '/' . $request->input('viaResourceId');
        }
        return parent::redirectAfterUpdate($request, $resource);
    }
}
