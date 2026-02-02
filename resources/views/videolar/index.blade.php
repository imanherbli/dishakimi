 @extends('layouts.app')

@section('content')
    <style>
        body {
            background: #f5f7fb;
            font-family: "Tajawal", sans-serif;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-weight: 700;
            color: #409caeff;
        }

        .btn-gradient {
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
            color: #fff;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-gradient:hover {
            opacity: 0.9;
            transform: scale(1.03);
        }

        .video-card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: #fff;
        }

        .video-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
        }

        .video-card img {
            height: 200px;
            width: 100%;
            object-fit: cover;
            transition: 0.3s ease;
        }

        .video-card:hover img {
            filter: brightness(0.85);
        }

        .video-card .card-body {
            text-align: center;
            padding: 1.25rem;
        }

        .video-card .card-title {
            font-weight: 600;
            color: #333;
        }

        .video-card .btn-watch {
            background: #409caeff;
            color: #fff;
            border-radius: 50px;
            padding: 6px 18px;
            transition: 0.3s;
        }

        .video-card .btn-watch:hover {
            background: #409caeff;
            transform: scale(1.05);
        }

        /* Modal video style */
        .modal-content {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
        }

        .modal-header {
    background: linear-gradient(135deg, #55d9ddff, #39b4b8ff);
            color: white;
            border-bottom: none;
        }

        iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 0 0 1rem 1rem;
        }
    </style>
</head>
 
<div class="container">
    <!-- Header -->
    <div class="page-header">
        <h1><i class="bi bi-collection-play me-2"></i> قائمة الفيديوهات</h1>
        <a href="{{ route('videolar.create') }}" class="btn btn-gradient">
            <i class="bi bi-plus-circle"></i> إضافة فيديو جديد
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Grid of videos -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($videos as $video)
            <div class="col">
                <div class="card video-card h-100">
                    <img src="{{ asset($video->thumbnail) }}" alt="Thumbnail">

                    <div class="card-body">
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <button class="btn btn-watch btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#videoModal" 
                            data-video="{{ $video->url }}">
                            <i class="bi bi-play-circle"></i> شاهد الفيديو
                        </button>
                    </div>

                    <div class="card-footer text-center pb-3 border-0">
                        <form action="{{ route('videolar.destroy', $video->id) }}" method="POST" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الفيديو؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-75">
                                <i class="bi bi-trash"></i> حذف الفيديو
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-5">
                <i class="bi bi-emoji-frown display-4 d-block mb-3"></i>
                <h5>لا يوجد فيديوهات حالياً</h5>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal for video -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-play-btn"></i> عرض الفيديو</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="videoFrame" src="" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const videoModal = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');

    videoModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const videoUrl = button.getAttribute('data-video');
        videoFrame.src = videoUrl;
    });

    videoModal.addEventListener('hidden.bs.modal', () => {
        videoFrame.src = ''; // إيقاف الفيديو عند إغلاق المودال
    });
</script>
@endsection

