<x-layout>
    <div class="container" style="padding-top: 40px; max-width: 800px; margin: 0 auto;">
        <h1 style="text-align: center; font-size: 48px; margin-bottom: 40px;">Create Post</h1>

        <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
            <div class="card-body" style="padding: 60px;">
                <h2 class="card-title" style="text-align: center; margin-bottom: 40px;">Create a New Post</h2>
                <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Title</label>
                        <input type="text" id="title" name="title" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="body" style="display: block; font-weight: bold; margin-bottom: 5px;">Description</label>
                        <textarea id="body" name="body" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="image" style="display: block; font-weight: bold; margin-bottom: 5px;">Title Image</label>
                        <input type="file" id="image" name="image" style="width: 100%;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 16px;">Upload</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
