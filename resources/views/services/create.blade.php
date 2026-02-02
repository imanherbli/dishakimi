@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #f4f6fa;
            font-family: 'Cairo', sans-serif;
        }
        h2 {
            color: #409caeff;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .icon-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .icon-item {
            flex: 0 0 80px;
            border: 2px solid #ddd;
            border-radius: 12px;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            transition: 0.3s;
            background-color: #fff;
        }
        .icon-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-color: #409caeff;
        }
        .icon-item.selected {
            border-color: #409caeff;
            background-color: #e7f1ff;
        }
        .icon-item img {
            max-width: 50px;
            max-height: 50px;
            display: block;
            margin: auto;
            margin-bottom: 5px;
        }
        .icon-item small {
            display: block;
            font-size: 0.75rem;
            color: #555;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border-radius: 50px;
        }
        .form-control {
            border-radius: 10px;
        }
        .mb-3 label {
            font-weight: 600;
            color: #333;
        }
    </style>
</head>
 <div class="container py-5">
    <h2>إضافة خدمة جديدة</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>اسم الخدمة (عربي)</label>
            <input type="text" name="name_ar" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>اسم الخدمة (إنكليزي)</label>
            <input type="text" name="name_en" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>اسم الخدمة (تركي)</label>
            <input type="text" name="name_tr" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>اختر أيقونة</label>
            <input type="hidden" name="icon" id="icon_input" required>
            <div class="icon-grid">
                @foreach ($icons as $icon)
                    <div class="icon-item" data-name="{{ $icon }}">
                        <img src="{{ asset('icons/'.$icon) }}" alt="icon">
                        <small>{{ pathinfo($icon, PATHINFO_FILENAME) }}</small>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success  ">حفظ الخدمة</button>
    </form>
</div>

<script>
    const iconItems = document.querySelectorAll('.icon-item');
    const iconInput = document.getElementById('icon_input');

    iconItems.forEach(item => {
        item.addEventListener('click', () => {
            iconItems.forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');
            iconInput.value = item.getAttribute('data-name');
        });
    });
</script>
@endsection
