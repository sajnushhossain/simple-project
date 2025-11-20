@if ($ad)
    <div class="ad-container my-4">
        <a href="{{ $ad->target_url }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('storage/' . $ad->image_path) }}" alt="{{ $ad->title }}" class="{{ $imageClasses }}">
        </a>
    </div>
@endif
