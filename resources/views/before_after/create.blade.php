@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f4f6fa;
            font-family: 'Cairo', sans-serif;
        }
        .container {
            max-width: 600px;
        }
        h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #409caeff;
            font-weight: 700;
        }
        .card-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control {
            border-radius: 10px;
            transition: 0.3s;
        }
        .form-control:focus {
            box-shadow: 0 0 8px rgba(13, 110, 253, 0.3);
            border-color: #409caeff;
        }
        .btn-success {
            width: 100%;
            padding: 12px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-success:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
 <div class="container mt-5">
    <div class="card-form">
        <h3>إضافة حالة قبل / بعد</h3>
        <form action="{{ route('before_after.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">عنوان الحالة (اختياري)</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">صورة قبل</label>
                <input type="file" name="before_image" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">صورة بعد</label>
                <input type="file" name="after_image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">حفظ</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

