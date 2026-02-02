 @extends('layouts.app')

@section('content')
    <style>
        body {
            background: #f8fafc;
            font-family: "Tajawal", sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card-header {
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
            color: #fff;
            font-size: 1.3rem;
            font-weight: bold;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        label {
            font-weight: 600;
        }
        .btn-primary {
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            opacity: 0.9;
            transform: scale(1.03);
        }
    </style>
</head>
 
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header text-center py-3">
            <i class="bi bi-camera-video-fill me-2"></i> إضافة فيديو جديد
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('videolar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">عنوان الفيديو</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="مثلاً: مقدمة في Laravel" required>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">رابط الفيديو</label>
                    <input type="url" class="form-control" id="url" name="url" placeholder="https://youtube.com/..." required>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">الصورة المصغرة</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 py-2">
                        <i class="bi bi-save"></i> حفظ الفيديو
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
