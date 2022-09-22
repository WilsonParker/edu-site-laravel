<?php


namespace App\Http\Controllers\Admin\Members;


use App\Http\Controllers\Admin\Common\BasicController;
use App\ViewModels\Admin\Members\MembersViewModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use LaravelSupports\Views\Components\Tables\TableSearchComponent;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class MemberController extends BasicController
{
    protected int $paginate = 10;
    protected array $prefix = ['members'];
    protected string $title = '회원 정보';
    protected string $description = '';

    #[Route("/member/{id}", methods: ["GET"])]
    public function index(Request $request)
    {
        $this->setTitleAndDescription('회원 목록', '회원 목록');
        $query = MemberModel::orderByDesc('idx');
        $members = $this->buildSearchQueryPagination($request, $query);
        $this->viewModel = new MembersViewModel($members, $this->searchData);
        return $this->buildView('member_index');
    }

    public function show(Request $request, MemberModel $member)
    {
        $this->setTitleAndDescription('회원 정보 페이지', '회원 정보 페이지');
        $this->viewModel = new MembersViewModel($member);
        return $this->buildView('member_show');
    }

    public function edit(Request $request, MemberModel $member)
    {
        $this->setTitleAndDescription('회원 수정 페이지', '회원 수정 페이지');

        $data = [];
        $data['member'] = $member;
        $data['form']['member'] = [];
        $builder = function (&$arr, $model, $data) {
            foreach ($data as $name => $value) {
                array_push($arr, [
                    'name' => $name,
                    'key' => $value,
                    'value' => $model->$value,
                ]);
            }
        };
        $builder($data['form']['member'], $member, [
            '이름' => 'realname',
            '닉네임' => 'nickname',
            '이메일' => 'email',
        ]);

        $this->viewModel = new MembersViewModel($data);
        return $this->buildView('member_edit');
    }

    public function update(Request $request, MemberModel $member)
    {
        $prefix = "api.member.update";
        $callback = function () use ($prefix, $request, $member) {

            return $this->backWithConfig($prefix);
        };

        $errorCallback = function (Throwable $throwable) {
            return $this->backWithErrors($throwable);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    protected function getSearchKeys(): array
    {
        return [TableSearchComponent::KEY_SEARCH, TableSearchComponent::KEY_SORT, TableSearchComponent::KEY_KEYWORD, TableSearchComponent::KEY_PAGINATE_LENGTH, MembersViewModel::SEARCH_KEY_FILTER];
    }

    protected function buildSearchQuery(Builder $query, string $search, string $keyword): Builder
    {
        switch ($search) {
            case 'realname' :
            case 'nickname' :
                $query->where($search, 'like', "%$keyword%");
                break;
            case 'id' :
            default :
                $query->where($search, "$keyword");
                break;
        }
        return $query;
    }

    protected function buildAdditionalSearchQuery(Request $request, Builder $query): Builder
    {
        if (isset($this->searchData[MembersViewModel::SEARCH_KEY_FILTER])) {
            switch ($this->searchData[MembersViewModel::SEARCH_KEY_FILTER]) {
                case 'basic' :
                    $query->whereDoesntHave('plusMember');
                    break;
                case 'membership' :
                    $query->whereHas('plusMember');
                    break;
                case 'standard' :
                    $query->whereHas('plusMember', function ($subQuery) {
                        $subQuery->where('ref_membership_code', 'standard');
                    });
                    break;
                case 'premium' :
                    $query->whereHas('plusMember', function ($subQuery) {
                        $subQuery->where('ref_membership_code', 'premium');
                    });
                    break;
            }
        }
        return $query;
    }

}
