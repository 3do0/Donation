
@section('title')
    اسعار العملات
@endsection
<div class="container my-5 border rounded p-4 shadow-lg">

    <div class="d-flex justify-content-between align-items-center">
        <h4>اسعار العملات</h4>
        <button class="btn btn-warning"  wire:click='refreshCurrencies'>
        <i class="bi bi-arrow-repeat"></i>
        </button>
    </div>
    <div class="table-responsive p-0">
    <table class="table table-hover text-center align-middle mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>العملة</th>
                <th>رمز العملة</th>
                <th>معدلها امام الريال اليمني</th>
                <th>اخر تحديث</th>
            </tr>
        </thead>
        <tbody>
            @foreach($currencies as $currency)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-white">{{ $currency->currency_name }}</td>
                <td class="text-white">{{ $currency->currency_code }}</td>
                <td class="text-success">{{ number_format($currency->rate, 2)}}</td>
                <td class="text-warning">{{ $currency->updated_at ? $currency->updated_at->format('Y-m-d H:i') : '---' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
