<script>
    function jobspace_clean_tags(html) {
        const allowed_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'ul', 'ol', 'li', 'strong', 'em', 'br', 'a', 'img', 'blockquote', 'hr', 'span'];
        var doc = new DOMParser().parseFromString(html, 'text/html');
        var elements = doc.body.getElementsByTagName('*');

        for (var i = elements.length - 1; i >= 0; i--) {
            var element = elements[i];
            if (!allowed_tags.includes(element.tagName.toLowerCase())) {
                element.parentNode.removeChild(element);
            } else {
                element.removeAttribute('style');  // Remove style attribute
            }
        }

        return doc.body.innerHTML;
    }

    tinymce.init({
        selector: '{{ $selector }}',
        toolbar: "wordcount numlist bullist",
        plugins: 'wordcount lists',
        content_style: 'body { font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif !important; color: rgb(30, 41, 59) !important; }',
        paste_preprocess: function(plugin, args) {
            var content = jobspace_clean_tags(args.content);
            args.content = content;
        },
        setup: function (editor) {
            editor.on('init', function () {
                var content = editor.getContent();
                content = jobspace_clean_tags(content);
                editor.setContent(content);
            });

            editor.on('init change', function () {
                editor.save();
            });

            editor.on('change', function (e) {
                @this.set('{{ $wireModel }}', editor.getContent());
            });

            editor.on('keyup', function (e) {
                @this.set('{{ $wireModel }}', editor.getContent());

                @if($wordCount !== false)
                    var content = editor.getContent({format: 'text'});
                    var words = content.split(/\b\B|\W+/);
                    var numWords = words.length;
                    if (numWords > {{ $wordCount }}) {
                        alert("Maximum " + {{ $wordCount }} + " words allowed.");
                        words = words.slice(0, {{ $wordCount }});
                        editor.setContent(words.join(" "));
                        e.preventDefault();
                        return false;
                    }
                @endif
            });
        }
    });
</script>