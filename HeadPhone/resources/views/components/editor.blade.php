<div>
    <label for="lastName">{{ $title }}</label>
    <textarea name="{{ $name }}" id="{{ $id }}" class="editor" data-editor="ClassicEditor"
        data-collaboration="false" data-revision-history="false">
    {{ htmlspecialchars_decode($content) }}
    </textarea>
</div>

<script>
    ClassicEditor
        .create(document.querySelector(`desc`), {
            removePlugins: ['Markdown'],
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(handleSampleError);
</script>
