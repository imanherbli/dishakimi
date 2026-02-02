@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #eef5ff, #f9fcff);
        font-family: 'Cairo', sans-serif;
    }

    .page-title {
        text-align: center;
        font-weight: 700;
        color: #409caeff;
        margin-bottom: 2rem;
        position: relative;
    }

    .page-title::after {
        content: "";
        position: absolute;
        width: 80px;
        height: 4px;
        background-color: #409caeff;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .add-btn {
        display: block;
        width: fit-content;
        margin: 0 auto 40px auto;
        padding: 10px 25px;
        font-weight: 600;
        border-radius: 50px;
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
        color: white;
        border: none;
        transition: 0.3s ease;
        text-decoration: none;
    }

    .add-btn:hover {
        transform: translateY(-3px);
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
        color: #fff;
    }

    .doctor-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .doctor-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .doctor-card img {
        height: 360px;
        width: 100%;
        object-fit: cover;
        border-bottom: 4px solid #409caeff;
    }

    .doctor-card .card-body {
        text-align: center;
        padding: 20px;
    }

    .doctor-card .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1a1a1a;
    }

    .doctor-card .specialization {
        color: #409caeff;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .doctor-card .card-text {
        color: #555;
        font-size: 0.95rem;
    }

    .delete-btn {
        border-radius: 25px;
        padding: 8px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .delete-btn:hover {
        background-color: #e53935;
        transform: translateY(-2px);
    }

    .card-footer {
        background: transparent;
        border-top: none;
    }
</style>

<div class="container py-5">
    <h1 class="page-title">قائمة الدكاترة</h1>

    <a href="{{ route('doctor.create') }}" class="add-btn">➕ أضف دكتور جديد</a>

    <div class="row">
        @foreach($items as $doctor)
        <div class="col-md-4 mb-4">
            <div class="card doctor-card">
                @if($doctor->image)
                    <img src="{{ asset($doctor->image) }}" alt="{{ $doctor->name }}">
                @else
                    <img src="https://via.placeholder.com/400x260?text=Doctor+Image" alt="Doctor Image">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $doctor->name }}</h5>
                    <p class="specialization">{{ $doctor->specialization }}</p>
                    <p class="card-text">{{ Str::limit($doctor->description, 100) }}</p>
                </div>

                <div class="card-footer text-center">
                    <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">🗑 حذف</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
