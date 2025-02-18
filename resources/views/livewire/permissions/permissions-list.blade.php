<div class="container my-5 border rounded bg-white p-4 shadow-lg">
    <div class="d-flex justify-content-between align-items-center">
        <h4>إدارة الصلاحيات</h4>
        <a class="btn btn-info" href="" wire:navigate>
            <i class="bi bi-plus"></i> إضافة
        </a>
    </div>
    <div class="table-responsive p-0">
    <table class="table table-hover text-center align-middle mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>تعديل</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    <button class="btn btn-info text-white" >
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger text-white"  wire:click="confirmDelete({{$permission->id}})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
