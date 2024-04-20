import { SourceEditing } from "@ckeditor/ckeditor5-source-editing";

ClassicEditor.create(document.querySelector(`#product_desc`), {
    removePlugins: ["Markdown"],
    plugins: [SourceEditing],
    toolbar: ["sourceEditing"],
})
    .then((editor) => {
        window.editor = editor;
    })
    .catch(handleSampleError);
