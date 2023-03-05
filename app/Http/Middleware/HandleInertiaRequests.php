<?php

namespace App\Http\Middleware;

use App\Models\Registration;
use App\Models\Request as Req;
use App\Models\Department;
use App\Models\Course;
use App\Models\Office;
use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\RequestResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $dept_id = (\Auth::check()) ? \Auth::user()->profile->department_id : 0;

        $reqs = Req::with('status','user.profile.course')
        ->whereHas('user',function ($query) use ($dept_id) {
            $query->whereHas('profile',function ($query) use ($dept_id) {
                $query->where('department_id',$dept_id);
            });
        })->where('status_id',2)->get();

        $registrants = Registration::with('course','department')
         ->whereHas('department',function ($query) use ($dept_id) {
                $query->where('id',$dept_id);
        })->get();

        $claiming = Req::with('status','user.profile.course')
        ->whereHas('user',function ($query) use ($dept_id) {
            $query->whereHas('profile',function ($query) use ($dept_id) {
                $query->where('department_id',$dept_id);
            });
        })->where('status_id',3)->where('is_borrowed',1)->get();

        $returning = Req::with('status','user.profile.course')
        ->whereHas('user',function ($query) use ($dept_id) {
            $query->whereHas('profile',function ($query) use ($dept_id) {
                $query->where('department_id',$dept_id);
            });
        })->where('status_id',4)->where('is_borrowed',1)->get();

        $viewing = Req::whereHas('user',function ($query) use ($dept_id) {
            $query->whereHas('profile',function ($query) use ($dept_id) {
                $query->where('department_id',$dept_id);
            });
        })->where('status_id',4)->where('is_borrowed',0)->count();

        $borrowing = Req::whereHas('user',function ($query) use ($dept_id) {
            $query->whereHas('profile',function ($query) use ($dept_id) {
                $query->where('department_id',$dept_id);
            });
        })->where('status_id',4)->where('is_borrowed',1)->count();

        $ongoing = [
            $borrowing,
            $viewing
        ];

        return array_merge(parent::share($request), [
            'auth' => (\Auth::check()) ? new UserResource(\Auth::user()) : '',
            'flash' => [
                'message' => session('message'),
                'datares' => session('data'),
                'type' => session('type')
            ],
            'departments' => Department::all(),
            'courses' => Course::all(),
            'offices' => Office::all(),
            'requests' => RequestResource::collection($reqs),
            'registrants' => DefaultResource::collection($registrants),
            'claiming' => RequestResource::collection($claiming),
            'returning' => RequestResource::collection($returning),
            'ongoing' => $ongoing
        ]);
    }
}
