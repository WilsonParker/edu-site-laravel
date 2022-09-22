<?php

namespace App\Http\Controllers\Web\Qna;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Qna\QnaRequest;
use App\Models\Boards\BoardAnswersModel;
use App\Models\Boards\BoardsModel;
use App\Services\Auth\AuthService;
use App\ViewModels\Web\Qna\QnaViewModel;
use Illuminate\Http\Request;
use Throwable;

class QnaController extends BaseController
{
    protected array $prefix = ['qna'];
    protected int $paginate = 20;

    /**
     * Qna 1:1 상담
     * @author  dev9163
     * @added   2021/10/01
     * @updated 2021/10/01
     */
    public function index(Request $request)
    {
        $member = AuthService::getAuthMember();  // 로그인 정보 가지고 오기
        $query = $member->qnaBoards()->orderby('idx', 'desc')->getQuery();
        $data = $this->buildSearchQueryPagination($request, $query);
        $this->viewModel = new QnaViewModel($data, $this->searchData);
        return $this->buildView('index');
    }

    /**
     * 1:1 상담 글쓰기 페이지
     * @author  dev9163
     * @added   2021/10/01
     * @updated 2021/10/01
     */
    public function create(Request $request)
    {
        $this->viewModel = new QnaViewModel();
        return $this->buildView('create');
    }

    /**
     * 1:1 상담 글쓰기 저장
     * @author  dev9163
     * @added   2021/10/05
     * @updated 2021/10/05
     */
    public function store(QnaRequest $request)
    {
        $validated = $request->validated();
        $prefix = 'api.qna.store';
        $callback = function () use ($validated, $prefix) {
            $model = BoardsModel::create([
                'title' => $validated['title'],
                'contents' => $validated['contents'],
                'member_idx' => AuthService::getAuthMember()->idx,
                'step' => 'ready',
                'board_category_code' => 'question',
            ]);

            if (isset($validated['file'])) {
                $model->saveResourceWithFile($validated['file']);
            }
            return $this->redirectRouteWithConfig($prefix, 'qna.index');
        };
        $errorCallback = function (Throwable $throwable) use ($prefix) {
            return $this->backWithConfig($prefix, false, false);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    /**
     * 1:1 상담 글 보기
     * @author  dev9163
     * @added   2021/10/05
     * @updated 2021/10/05
     */
    public function show(Request $request, BoardsModel $qna)
    {
        $this->viewModel = new QnaViewModel($qna);
        $this->viewModel->answer = BoardAnswersModel::whereHas('board', function ($query) use ($qna) {
            $query->where('board_idx', $qna->idx);
        })->first();

        return $this->buildView('show');
    }

    /**
     * 1:1 상담 글 수정 페이지
     * @author  dev9163
     * @added   2021/10/05
     * @updated 2021/10/05
     */
    public function edit(Request $request, BoardsModel $qna)
    {
        $this->viewModel = new QnaViewModel($qna);
        return $this->buildView('edit');
    }

    /**
     * 1:1 상담 글 수정하기
     * @author  dev9163
     * @added   2021/10/05
     * @updated 2021/10/05
     */
    public function update(QnaRequest $request, BoardsModel $qna)
    {
        $validated = $request->validated();
        $prefix = 'api.qna.update';
                $callback = function () use ($validated, $prefix,  $qna, $request) {
            $model = BoardsModel::where('idx', $qna->idx)
                ->update([
                    'title' => $validated['title'],
                    'contents' => $validated['contents'],
                ]);
            // 파일 삭제하기
            if (isset($request->fileDelete)){
                $qna->resource->delete();
                $qna->resource()->delete();
            }
            // 파일 있을 경우에 넣기
            if (isset($validated['file'])) {
                $qna->saveResourceWithFile($validated['file']);
            }

            return $this->redirectRouteWithConfig($prefix, 'qna.show', ['qna' => $qna->idx]);
        };
        $errorCallback = function (Throwable $throwable) use ($prefix) {
            return $this->backWithConfig($prefix, false, false);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    /**
     * 1:1 상담 글 삭제하기
     * @author  dev9163
     * @added   2021/10/05
     * @updated 2021/10/05
     */
    public function destroy(BoardsModel $qna)
    {
        $prefix = 'api.qna.destroy';
        $callback = function () use ($prefix, $qna) {
            $qna->delete();
            return $this->redirectRouteWithConfig($prefix, 'qna.index');
        };
        $errorCallback = function (Throwable $throwable) use ($prefix) {
            return $this->backWithConfig($prefix, false, false);
        };
        return $this->runTransaction($callback, $errorCallback);
    }
}
