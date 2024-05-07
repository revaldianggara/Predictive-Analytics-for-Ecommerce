<?php

namespace Modules\UserConfig\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Rules\Password;
use App\Utils\FlashMessageHelper;
use App\Utils\ValidationHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Modules\UserConfig\Http\Requests\User\StoreRequest;
use Modules\UserConfig\Http\Requests\User\UpdateRequest;
use Modules\UserConfig\Repositories\UserRepository;
use Spatie\Permission\Models\Role;
use stdClass;

class UserController extends BaseController
{
    protected $user_repository;
    public function __construct(UserRepository $user_repository)
    {
        $this->route = 'admin.user_config.user.';
        $this->view = 'userconfig::user.';
        $this->permission = 'user_config.user';
        $this->user_repository = $user_repository;
        $this->user_repository->setProperty($this->getPropertyToRepository());
    }

    public function index()
    {
        $data['model'] = User::class;
        return $this->view('index', $data);
    }

    public function datatable(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|array',
            'email' => 'nullable|array',
            'created_at' => 'nullable|array',
            'created_at.*' => 'nullable|date_format:d-m-Y',
            'deleted_at' => 'nullable|array'
        ]);
        $query = $this->user_repository->getData($validated);
        return datatables()->of($query)
            ->addColumn('status', function ($obj) {
                if ($obj->trashed()) {
                    return 'Dihapus';
                } else {
                    return 'Aktif';
                }
            })
            ->addColumn('action', function ($obj) {
                $button = '<a class="px-1 text-success" href="' . route($this->route . 'show', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Lihat Detail"><i class="far fa-eye"></i></a>';
                // if user can update
                if (auth()->user()->can('update ' . $this->permission)) {
                    $button .= '<a class="px-1 text-info" href="' . route($this->route . 'edit', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }
                // if user can delete
                if (auth()->user()->can('update ' . $this->permission)) {
                    $button .= '<a class="px-1 text-danger btn-delete-item-datatable" data-datatable-id="main-table" href="' . route($this->route . 'delete', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>';
                }

                return $button;
            })
            ->editColumn('created_at', function ($obj) {
                return $obj->carbon_date('created_at')->format('d-m-Y');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function createGet()
    {
        $data['roles'] = Role::get();
        $data['user_type'] = User::user_type;
        return $this->view('create', $data);
    }

    public function createPost(StoreRequest $request)
    {
        $validated = $request->validated();

        $data = $this->user_repository->storeByRequest($validated);

        FlashMessageHelper::bootstrapSuccessAlert('User ' . $request->name . ' berhasil ditambahkan!', 'Berhasil!');
        return redirect(route($this->route . 'show', ['id' => $data->id]));
    }

    public function show($id)
    {
        $data['obj'] = $this->user_repository->find($id);
        $data['roles'] = Role::get();
        $data['user_role'] = $this->user_repository->getUserRolesIds($id);
        $data['user_type'] = User::user_type;
        return $this->view('show', $data);
    }

    public function edit($id)
    {
        $data['obj'] = $this->user_repository->find($id);
        $data['roles'] = Role::get();
        $data['user_role'] = $this->user_repository->getUserRolesIds($id);
        $data['user_type'] = User::user_type;
        return $this->view('edit', $data);
    }

    public function update($id, UpdateRequest $request)
    {
        $validated = $request->validated();
        $this->user_repository->updateByRequest($id, $validated);

        FlashMessageHelper::bootstrapSuccessAlert('User ' . $request->name . ' berhasil diubah!', 'Berhasil!');
        return redirect(route($this->route . 'show', ['id' => $id]));
    }

    public function delete($id)
    {
        $this->user_repository->deleteById($id);

        return response()->json(['status' => true,'message' => 'Berhasil Hapus Data!']);
    }

    public function restore($id)
    {
        $this->user_repository->restoreById($id);

        FlashMessageHelper::bootstrapSuccessAlert('User berhasil dikembalikan!');

        return redirect(route($this->route . 'show', ['id' => $id]));
    }

    public function loginAsUser($id)
    {
        $user = $this->user_repository->find($id);
        // logout
        auth()->logout();
        // login sebagai user yg dipilih
        auth()->loginUsingId($user->id);
        FlashMessageHelper::bootstrapSuccessAlert('Login sebagai user berhasil!');
        // if ($user->user_type == 1)
        $route = (route('admin.dashboard.index'));
        return redirect($route);
    }
}
