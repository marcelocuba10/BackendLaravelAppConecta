@foreach ($posts as $post)
    <div class="card-style-3 mb-30">
        <div class="card-content">
            <h4><a href="#0">{{ $post->title }} </a></h4>
            <p>{{ $post->description }}</p>
        </div>
    </div>    
@endforeach
