@extends('layouts.app')

@section('content')
<style>
.ba-container {
    position: relative;
    width: 100%;
    max-width: 400px;
    height: 250px;
    overflow: hidden;
    border-radius: 15px;
    margin: 30px auto;
    border: 1px solid #ccc;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.ba-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    user-select: none;
}
.ba-overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    overflow: hidden;
}
.ba-handle {
    position: absolute;
    top: 0;
    width: 4px;
    height: 100%;
    background: #409caeff;
    cursor: ew-resize;
    z-index: 10;
    transition: background 0.3s, transform 0.2s;
}
 
.delete-btn {
    display: block;
    margin: 10px auto 30px auto;
    background: #dc3545;
    color: #fff;
    border: none;
    padding: 6px 15px;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s;
}
.delete-btn:hover {
    background: #c82333;
}        .ba-container {
    position: relative;
    width: 350px; 
    height: 200px;
    overflow: hidden;
    border-radius:10%;
    margin: 50px auto;
    border: 1px solid #ccc;
}
.ba-container img {
     top: 0;
    left: 0;
    width: 400px;
    height: 250px;
    object-fit: cover;
}
.ba-overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    overflow: hidden;
}
.ba-handle {
    position: absolute;
    top: 0;
    width: 3px;
    height: 100%;
    background: #fff;
    cursor: ew-resize;
    z-index: 10;
}
.slider-button {
    background-color: rgba(52, 51, 51, 0.6);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    content:"<>";
    transform: translate(-50%, -50%);
}
.slider-button::before {
  content: "< >";
  color: #aea2a2ff;
  font-size: 21px;
   
}
</style>
</head>
   
         
@foreach($items as $item)
<div class="ba-container" data-id="{{ $item->id }}">
<img src="{{ asset('fotos/'.$item->before_image) }}" alt="Before">
    <div class="ba-overlay" style="width: 50%;">
        <img src="{{ asset('fotos/'.$item->after_image) }}" alt="After">

    </div>
    <div class="ba-handle" style="left: 50%; text-align:center; "> <div class="slider-button"> </div></div>
</div>
<form action="{{ route('before_after.destroy', $item->id) }}" method="POST" class="text-center">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
</form>
@endforeach

<script>
// Slider functionality
// Slider functionality
document.querySelectorAll('.ba-container').forEach(container => {
    const overlay = container.querySelector('.ba-overlay');
    const handle = container.querySelector('.ba-handle');
    let isDragging = false;

    handle.addEventListener('mousedown', () => {
        isDragging = true;
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', stopDrag);
    });

    function drag(e){
        if(!isDragging) return;
        const rect = container.getBoundingClientRect();
        let offsetX = e.clientX - rect.left;
        if(offsetX < 0) offsetX = 0;
        if(offsetX > rect.width) offsetX = rect.width;
        overlay.style.width = offsetX + 'px';
        handle.style.left = offsetX - (handle.offsetWidth/2) + 'px';
    }

    function stopDrag(){
        isDragging = false;
        document.removeEventListener('mousemove', drag);
        document.removeEventListener('mouseup', stopDrag);
    }
});
</script>
@endsection
