<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKEditor 5 Integration</title>
    <!-- Include CKEditor 5 Classic build from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <!-- Include UK English translation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/44.1.0/translations/en-gb.min.js" integrity="sha512-FM2h9iuAKZYlbg4xNhbYmFhbpA88J5H9TBSQwQxMt998u2HOqlko9vMggawURHmfysBWNbedV+kwEI0DwLuXxA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <form>
        <label for="editor">Content:</label>
        <textarea name="editor" id="editor" rows="10" cols="80">
            This is my text content.
        </textarea>
        <button type="submit">Submit</button>
    </form>

    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'), {
                language: 'en-gb' // Set the language to UK English
            })
    </script>
</body>
</html>
