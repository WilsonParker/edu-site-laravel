<?php

namespace App\Http\Controllers\Web\Boards;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Boards\BoardRequest;
use App\Models\Boards\BoardCategoriesModel;
use App\Models\Boards\BoardsModel;
use App\ViewModels\Web\Boards\BoardViewModel;
use App\ViewModels\Web\Boards\CarefulViewModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends BaseController
{
    protected array $prefix = ['boards'];
    protected int $paginate = 20;

    /**
     * 공지사항
     *
     * @author  dev9163
     * @added   2021/09/30 11:20 오전
     * @updated 2021/09/30
     */
    public function index(BoardRequest $request)
    {
        $validated = $request->validated();
        $code = $validated['code'] ?? '';
        $type = $validated['type'] ?? 'notice';

        // 공지사항
        $categories = BoardCategoriesModel::whereHas('type', function ($query) use ($type) {
            $query->where('code', $type);
        })->orderby('sort', 'asc')->get();

        $query = BoardsModel::whereInRelated('boardCategory', $categories)->orderby('is_notice', 'desc')->orderby('idx', 'desc');

        if ($code != '') {
            $query->where('board_category_code', $code);
        }
        $data = $this->buildSearchQueryPagination($request, $query);
        $this->viewModel = new BoardViewModel($data, $this->searchData);
        $this->viewModel->categories = $categories;
        $this->viewModel->selectedCategory = BoardCategoriesModel::find($code);

        return $this->buildView(($type == 'faq') ? 'faq' : 'index');
    }

    protected function buildSearchQuery(Builder $query, string $search, string $keyword): Builder
    {
        $query->where($search, 'like', "%$keyword%");
        return $query;
    }

    public function show(Request $request, BoardsModel $board)
    {
        $board->views++;
        $board->save();
        $this->viewModel = new BoardViewModel($board);
        return $this->buildView('show');
    }

    public function faq(BoardRequest $request)
    {
        return redirect(route('board.index', ['type' => 'faq', 'code' => 'faq_join']));
    }

    public function carefulPage1()
    {
        $this->viewModel = new CarefulViewModel(1);
        return $this->buildView('careful_page1');
    }

    public function carefulPage2()
    {
        $this->viewModel = new CarefulViewModel(2);
        return $this->buildView('careful_page2');
    }

    public function carefulPage3()
    {
        $this->viewModel = new CarefulViewModel(3);
        return $this->buildView('careful_page3');
    }

    public function carefulPage4()
    {
        $this->viewModel = new CarefulViewModel(4);
        return $this->buildView('careful_page4');
    }

    public function manual()
    {
        Storage::disk('upload')->download('/data/manual/study-laravel-project.pdf');
    }

    public function ncs_guide(Request $request, BoardsModel $board)
    {
        $this->viewModel = new BoardViewModel($board);
        return $this->buildView('ncs_guide');
    }
}
