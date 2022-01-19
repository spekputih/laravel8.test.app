@csrf 
        <label for="title">Title:</label>
        <br>
        <input type="text" name="title" class="form-control" id="postsTitle" value="{{ old('title', optional($post ?? null)->title) }}">
        <br>
        <label for="title">Content</label>
        <br>
        <input type="text" name="content" class="form-control" id="postsContent" value="{{ old('content', optional($post ?? null)->content) }}">
        <br>