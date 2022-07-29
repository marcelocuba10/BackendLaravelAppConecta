<ul class="list-unstyled w-100">
    @forelse ($results as $post)
        <li style="padding: 5px;border-bottom: 1px solid #c3c3c3;"><a href="#" class="post-link" data-id="{{ $post->id }}">{{ $post->title }}</a></li>
    @empty
        <li><a href="#" data-id="0">Sorry, there's no posts with your search "{{ $search }}"</a></li>
    @endforelse
</ul>