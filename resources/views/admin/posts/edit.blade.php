<x-layout>
    <div class="container" style="padding-top: 40px;">
        <h1 style="text-align: center; font-size: 48px; margin-bottom: 40px;">Edit Post</h1>

        <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
            <div class="card-body" style="padding: 40px;">
                <h2 class="card-title" style="margin-bottom: 40px; text-align: center;">Edit Post</h2>
                <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div style="margin-bottom: 20px;">
                        <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Title</label>
                        <input type="text" id="title" name="title" value="{{ $post->title }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="body" style="display: block; font-weight: bold; margin-bottom: 5px;">Description</label>
                        <textarea id="body" name="body" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">{{ $post->body }}</textarea>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="image" style="display: block; font-weight: bold; margin-bottom: 5px;">Title Image</label>
                        <input type="file" id="image" name="image" style="width: 100%;">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="" style="width: 128px; height: 128px; margin-top: 10px;">
                        @endif
                    </div>
                    

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 16px;">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
