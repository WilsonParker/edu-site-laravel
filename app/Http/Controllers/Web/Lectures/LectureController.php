<?php

namespace App\Http\Controllers\Web\Lectures;

use App\Http\Controllers\Web\BaseController;
use App\Http\Middleware\LectureEvaluable;
use App\Http\Middleware\RedirectNeedOTP;
use App\Http\Middleware\ValidateLectureProgramEndTime;
use App\Http\Requests\Web\Lectures\LectureRequest;
use App\Models\Lectures\LectureCategoriesModel;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Lectures\LecturesModel;
use App\ViewModels\Web\Lectures\LectureViewModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use function PHPUnit\Framework\matches;

class LectureController extends BaseController
{
    protected array $prefix = ['lectures'];
    protected string $defaultSort = 'best';
    protected int $paginate = 10;

    public function index(LectureRequest $request)
    {
        $validated = $request->validated();
        $type = $validated['type'] ?? null;
        $categories = $this->buildCategories($type);
        $selectedCategory = isset($validated['code']) ? LectureCategoriesModel::findOrFail($validated['code']) : $categories->first();
        $query = LecturesModel::with(['categories', 'programs.type', 'resource', 'classes'])->whereInRelated('categories', $selectedCategory);
         $data = $this->buildSearchQueryPagination($request, $query);
        $this->viewModel = new LectureViewModel($data, $this->searchData);
        $this->viewModel->categories = $categories;
        $this->viewModel->selectedCategory = $selectedCategory;
        $this->viewModel->type = $type;
        return $this->buildView('index');
    }

    public function search(LectureRequest $request)
    {
        $validated = $request->validated();
        $type = $validated['type'] ?? null;
        $categories = $this->buildCategories($type);
        $issetCode = isset($validated['code']);
        $selectedCategory = $issetCode ? LectureCategoriesModel::findOrFail($validated['code']) : $categories->first();
        $data = $this->buildQuery($request, LecturesModel::with(['categories', 'programs.type', 'resource', 'classes'])->whereInRelated('categories', $categories))->get();
        $sort = match ($this->searchData['sort']) {
            'best' => 'idx',
            'price_asc' => 'price',
            'course_time_asc' => 'total_learning_time',
        };
        $result = $data->groupBy('lecture_category_code')->sortBy($sort);
        $this->viewModel = new LectureViewModel($result, $this->searchData);
        $this->viewModel->categories = $categories;
        $this->viewModel->selectedCategory = $selectedCategory;
        $this->viewModel->total = $data->count();
        $this->viewModel->type = $type;
        return $this->buildView('search');
    }

    public function show(LectureRequest $request, LecturesModel $lecture)
    {
        $validated = $request->validated();
        $lecture->load(['categories.parent', 'programs.type', 'resource', 'classes', 'availableNbcPrograms.nbcInformation', 'subjectMatterExperts']);
        $category = $lecture->getCategory($validated['type']);
        $type = $category->parent;
        $this->viewModel = new LectureViewModel($lecture);
        $this->viewModel->hasFilter = false;
        $this->viewModel->categories = $this->buildCategories($type);
        $this->viewModel->selectedCategory = $category;
        $this->viewModel->type = $type;
        return $this->buildView('show');
    }

    public function detail(LectureRequest $request, LectureProgramModel $program)
    {
        $this->viewModel = new LectureViewModel($program);
        return $this->buildView('detail');
    }

    public function preview(Request $request, LecturesModel $lecture)
    {
        $this->viewModel = new LectureViewModel($lecture);
        return $this->buildView('show');
    }

    private function buildCategories($type)
    {
        if (isset($type) && $type != 'ncs') {
            $categoriesQuery = LectureCategoriesModel::where('parent', $type);
        } else {
            $categoriesQuery = LectureCategoriesModel::whereHas('parent');
        }
        return $categoriesQuery->orderBy('sort')->get();
    }

    protected function appendSearchKeys(): array
    {
        return ['type', 'code'];
    }

    protected function buildSortQuery(Builder $query, string $sort): Builder
    {
        return match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'course_time_asc' => $query->orderBy('total_learning_time'),
            default => $query
        };
    }

    protected function buildFilterQuery(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter) {
            match ($filter) {
                'no_task' => $query->whereDoesntHave('taskExams'),
                'has_study' => $query->whereNotNull('study_material_idx'),
                'certificate' => '',
            };
        }
        return $query;
    }

    protected function buildSearchQuery(Builder $query, string $search, string $keyword): Builder
    {
        switch ($search) {
            case 'title' :
                $query->where('title', 'like', "%$keyword%");
                break;
        }
        return $query;
    }

}
