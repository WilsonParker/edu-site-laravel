<?php


namespace App\Http\Controllers\Admin\Members;


use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseDefaultConfigTemplate;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseTemplate;
use LaravelSupports\Views\Components\Tables\TableSearchComponent;
use Throwable;

class MemberModalController extends BasicController
{
    protected int $paginate = 10;
    protected array $prefix = ['members'];
    protected string $title = '회원 정보';
    protected string $description = '';

    protected array $suffix = ['modal'];

    /**
     * MemberModalController constructor.
     */
    public function __construct()
    {
        $this->viewModel = new ModalSearchMemberViewModel();
    }

    /**
     * Modal 창책 검색 창 view 입니다
     *
     * @param Request $request
     * @return Factory|View
     * @author  dew9163
     * @added   2020/03/19
     * @updated 2020/05/16
     */
    public function index(Request $request)
    {
        $this->viewModel->bindRequest($request);
        return $this->buildView('modal_search_member');
    }

    /**
     * Modal 책 검색 창 view 에서 검색을 하고 reload 합니다
     *
     * @param Request $request
     * @return Factory|View
     * @author  dew9163
     * @added   2020/03/19
     * @updated 2020/05/06
     * @updated 2020/09/20
     */
    public function search(Request $request)
    {
        $list = $this->buildQuery($request, MemberModel::orderBy('id', 'desc'))->get();
        $this->viewModel = new ModalSearchMemberViewModel($list, $this->searchData);
        $this->viewModel->bindRequest($request);

        return $this->buildView('modal_search_member');
    }

    public function select(MemberRequest $request)
    {
        $prefix = "api.member.modal.search.select";
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            $memberModel = MemberModel::findOrFail($validated['id']);

            $memberModel->profile_img = $memberModel->getProfileImage();
            $memberModel->date = $memberModel->created_at->format('Y-m-d');

            return new ResponseDefaultConfigTemplate(Response::HTTP_OK, $prefix, $memberModel);
        };

        $exceptionCallback = function (Throwable $e) use ($prefix) {
            return new ResponseDefaultConfigTemplate(Response::HTTP_BAD_REQUEST, $prefix);
        };

        return $this->runTransaction($callback, $exceptionCallback);
    }

    protected function getSearchKeys(): array
    {
        return [TableSearchComponent::KEY_SEARCH, TableSearchComponent::KEY_KEYWORD];
    }


    protected function buildSearchQuery(Builder $query, string $search, string $keyword): Builder
    {
        switch ($search) {
            case 'realname' :
            case 'nickname' :
            case 'email' :
            case 'phone' :
                $query->where($search, 'like', "%$keyword%");
                break;
            case 'id' :
            default :
                $query->where($search, "$keyword");
                break;
        }
        return $query;
    }
}
