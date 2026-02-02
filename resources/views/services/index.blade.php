@extends('layouts.app')

@section('content')
<style>
    .service-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: #fff;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .service-card img {
        height: 180px;
        object-fit: contain;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .service-card .card-body {
        text-align: center;
    }

    .service-card .card-title {
        font-weight: 700;
        color: #409caeff;
        margin-bottom: 10px;
    }

    .service-card .card-text {
        color: #555;
        font-size: 0.95rem;
    }

    .service-card .card-footer {
        background: transparent;
        border-top: none;
        text-align: center;
    }

    .btn-danger {
        border-radius: 25px;
        padding: 5px 20px;
        transition: 0.3s;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4 text-center" style="color:#0d6efd;">الخدمات</h1>
    <div class="row g-4">
        @foreach($services as $service)
        <div class="col-md-4">
            <div class="card service-card h-100">
                <img src="{{ asset($service->icon_path) }}" class="card-img-top" alt="{{ $service->name_ar }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $service->name_ar }}</h5>
                    <p class="card-text">
                        <strong>TR:</strong> {{ $service->name_tr }} <br>
                        <strong>EN:</strong> {{ $service->name_en }}
                    </p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">🗑 حذف</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
