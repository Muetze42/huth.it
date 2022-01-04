<?php

namespace App\Http\Controllers\Api;


use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected mixed $model = null;
    protected mixed $resource = null;
    protected string $modelNamespace = '\App\Models\\';
    protected string $resourceNamespace = '\App\Http\Resources\\';
    protected array $indexFilter = [];
    protected array $indexLikeFilter = [];
    protected array $indexAllowInclude = [];
    protected array $showAllowInclude = [];
    protected ?string $primaryKey = null;
    protected mixed $parameter = null;
    protected string $pageName = 'site';
    protected bool $withTrashed = false;

    public function __construct()
    {
        if (!$this->model) {
            $this->model = $this->modelNamespace.str_replace('Controller', '', class_basename(get_class($this)));
        }

        if (!$this->resource) {
            $this->resource = $this->resourceNamespace.str_replace('Controller', '', class_basename(get_class($this))).'Resource';
        }
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    protected function requestQuery(Builder $query, Request $request): Builder
    {
        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    /**
     * @param Request $request
     * @param mixed|null $parameter
     * @return mixed
     */
    public function index(Request $request, mixed $parameter = null): mixed
    {
        if (!$this->parameter) {
            $this->parameter = $parameter;
        }

        $limit = $this->getLimit($request);

        $query = app($this->model)->newQueryWithoutRelationships();
        $query = $this->requestQuery($query, $request);
        $query = $this->indexQuery($query, $request);
        $query = $this->indexFilter($query, $request);
        $query = $query->with($this->indexRelationships($request));
        if ($this->withTrashed) {
            /** @noinspection PhpUndefinedMethodInspection */
            $query->withTrashed();
        }

        return $this->resource::collection($query->paginate($limit, ['*'], $this->pageName))->additional($this->indexAdditional());
    }

    /**
     * @return array
     */
    protected function indexAdditional(): array
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function indexRelationships(Request $request): array
    {
        $requestRelations = explode(',', $request->input('include'));

        $array = [];

        foreach ($requestRelations as $relation) {
            if (in_array($relation, $this->indexAllowInclude)) {
                $array[] = $relation;
            }
        }

        return $array;
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    protected function indexQuery(Builder $query, Request $request): Builder
    {
        return $query;
    }

    /**
     * @param Request $request
     * @param Builder $query
     * @return Builder
     */
    protected function indexFilter(Builder $query, Request $request): Builder
    {
        $filters = $request->input('filter');
        foreach ($this->indexFilter as $key) {
            if (isset($filters[$key])) {
                $query = $query->where($key, $filters[$key]);
            }
        }
        foreach ($this->indexLikeFilter as $key) {
            if (isset($filters[$key])) {
                $query = $query->where($key, 'like', '%'.$filters[$key].'%');
            }
        }

        return $query;
    }

    /**
     * @param Request $request
     * @return int
     */
    protected function getLimit(Request $request): int
    {
        $input = $request->input('limit');
        $limit = config('site.api.limit.default', 100);
        $min = config('site.api.limit.min', 10);
        $max = config('site.api.limit.max', 100);


        if ($input) {
            if ($input > $max) {
                $limit = $max;
            } elseif ($input < $min) {
                $limit = $min;
            } else {
                $limit = $input;
            }
        }

        return $limit;
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    /**
     * @param Request $request
     * @param $primaryValue
     * @param mixed|null $parameter
     * @return mixed
     */
    public function show(Request $request, $primaryValue, mixed $parameter = null): mixed
    {
        $this->model = app($this->model);

        if (!$this->parameter) {
            $this->parameter = $parameter;
        }

        if (!$this->primaryKey) {
            $this->primaryKey = $this->getPrimaryKey();
        }

        $query = ($this->model)->newQueryWithoutRelationships();
        $query = $this->requestQuery($query, $request);
        $query = $this->showQuery($query, $request);
        $query = $query->with($this->showRelationships($request));
        if ($this->withTrashed) {
            /** @noinspection PhpUndefinedMethodInspection */
            $query->withTrashed();
        }

        $resource = new $this->resource($query->where($this->primaryKey, $primaryValue)->firstOrFail());

        if ($this->showDeny($resource)) {
            return jsonResponse('Access denied', 401);
        }

        return $resource;
    }

    /**
     * Deny method for show route
     *
     * @param $resource
     * @return bool
     */
    protected function showDeny($resource): bool
    {
        return false;
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    protected function showQuery(Builder $query, Request $request): Builder
    {
        return $query;
    }

    protected function showRelationships(Request $request): array
    {
        $requestRelations = explode(',', $request->input('include'));

        $array = [];

        foreach ($requestRelations as $relation) {
            if (in_array($relation, $this->showAllowInclude)) {
                $array[] = $relation;
            }
        }

        return $array;
    }

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->model->getKeyName();
    }
}
