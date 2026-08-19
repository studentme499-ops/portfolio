<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    protected string $model;
    protected string $viewPrefix;
    protected string $routePrefix;

    abstract protected function rules(): array;

    protected function attributes(): array
    {
        return [];
    }

    public function index()
    {
        $items = $this->model::query()
            ->when($this->searchable() && request('q'), function ($q) {
                $q->where($this->searchable(), 'like', '%'.request('q').'%');
            })
            ->when($this->ordering(), fn ($q) => $q->orderBy($this->ordering())->orderByDesc('id'))
            ->unless($this->ordering(), fn ($q) => $q->orderByDesc('id'))
            ->paginate(15)
            ->withQueryString();

        return view("$this->viewPrefix.index", ['items' => $items]);
    }

    public function create()
    {
        return view("$this->viewPrefix.form", [
            'item' => null,
            'resource' => $this->resourceName(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());

        $item = $this->model::create($this->prepareData($request, $validated));

        $this->log('Created', $this->resourceName(), $item);

        return redirect()->route("$this->routePrefix.index")->with('status', ucfirst($this->resourceName()).' created successfully.');
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);

        return view("$this->viewPrefix.form", [
            'item' => $item,
            'resource' => $this->resourceName(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);

        $validated = $request->validate($this->rules(), [], $this->attributes());

        $item->update($this->prepareData($request, $validated));

        $this->log('Updated', $this->resourceName(), $item);

        return redirect()->route("$this->routePrefix.index")->with('status', ucfirst($this->resourceName()).' updated successfully.');
    }

    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);

        $this->log('Deleted', $this->resourceName(), $item);
        $item->delete();

        return redirect()->route("$this->routePrefix.index")->with('status', ucfirst($this->resourceName()).' deleted.');
    }

    protected function prepareData(Request $request, array $validated): array
    {
        return $validated;
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

    protected function ordering(): ?string
    {
        return 'sort_order';
    }

    protected function resourceName(): string
    {
        return strtolower(class_basename($this->model));
    }

    protected function log(string $action, string $resource, $item): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'entity_type' => $resource,
            'entity_id' => $item->id,
            'description' => "$action $resource: ".($item->name ?? $item->title ?? $item->label ?? $item->company ?? '#'.$item->id),
            'ip_address' => request()->ip(),
            'user_agent' => substr((string) request()->userAgent(), 0, 200),
        ]);
    }
}
