@extends('layouts.app')

@section('content')

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9effd 100%);
            font-family: "Tajawal", sans-serif;
            min-height: 100vh;
        }

        .form-container {
            max-width: 950px;
            margin: 60px auto;
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .form-header {
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
            color: #fff;
            text-align: center;
            padding: 1.5rem;
        }

        .form-header h2 {
            font-weight: 700;
            margin-bottom: 0;
        }

        label {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            border-radius: 0.7rem;
            padding: 0.65rem;
            box-shadow: none !important;
            border: 1px solid #d3d7df;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #409caeff;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.15);
        }

        textarea {
            resize: none;
        }

        .btn-primary {
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
            border: none;
            border-radius: 0.8rem;
            font-weight: 600;
            padding: 0.7rem;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.03);
            opacity: 0.9;
        }

        .image-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e0e0e0;
            display: none;
            margin: 15px auto;
        }

        .form-section {
            padding: 2rem;
        }

        .alert-success {
            border-radius: 0.8rem;
        }
    </style>
</head>
 
<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h2><i class="bi bi-person-plus-fill me-2"></i> إضافة طبيب جديد</h2>
        </div>

        <div class="form-section">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- أسماء الطبيب -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>الاسم بالعربية</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>الاسم بالتركية</label>
                        <input type="text" name="name_tr" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>الاسم بالإنجليزية</label>
                        <input type="text" name="name_en" class="form-control" required>
                    </div>
                </div>

                <!-- التخصص -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>التخصص بالعربية</label>
                        <input type="text" name="specialization_ar" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>التخصص بالتركية</label>
                        <input type="text" name="specialization_tr" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>التخصص بالإنجليزية</label>
                        <input type="text" name="specialization_en" class="form-control" required>
                    </div>
                </div>

                <!-- الوصف -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>الوصف بالعربية</label>
                        <textarea name="description_ar" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label>الوصف بالتركية</label>
                        <textarea name="description_tr" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label>الوصف بالإنجليزية</label>
                        <textarea name="description_en" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <!-- الصورة -->
                <div class="text-center mb-3">
                    <label class="form-label fw-bold">صورة الطبيب</label>
                    <input type="file" name="image" class="form-control w-50 mx-auto" accept="image/*" onchange="previewImage(event)">
                    <img id="imagePreview" class="image-preview mt-3" alt="Preview">
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4">
                    <i class="bi bi-save2"></i> حفظ الطبيب
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // عرض معاينة للصورة عند اختيارها
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        const file = input.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
