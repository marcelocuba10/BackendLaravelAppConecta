@foreach ($posts as $post)
<div class="card-style-3 mb-30">
    <div class="card-content">
        <h4><a href="#0">{{ $post->title }} </a></h4>
        <h4><a href="#0">{{ $status }} </a></h4>
        <p>
            {{ $post->body }}
        </p>
        <a href="#0" class="read-more">Read More</a>
    </div>
</div>    
@endforeach
