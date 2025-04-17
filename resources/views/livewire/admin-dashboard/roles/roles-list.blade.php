
<div class="container my-5 border rounded p-4 shadow-lg">

    <div class="d-flex justify-content-between align-items-center">
        <h4>إدارة الصلاحيات</h4>
        <a class="btn btn-primary" href="{{route('role-form')}}" wire:navigate>
            <i class="bi bi-plus"></i> إضافة
        </a>
    </div>
    <div class="table-responsive p-0">
    <table class="table table-hover text-center align-middle mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الصلاحيات</th>
                <th>تعديل</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-dark text-white" href="{{route('role-permissions', $role->id)}}" wire:navigate>
                        <i class="bi bi-lock"></i>
                    </a>
                </td>
                <td>
                    <button class="btn btn-primary text-white" >
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger text-white"  wire:click="confirmDelete({{$role->id}})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
