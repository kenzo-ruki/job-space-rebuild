<?php

namespace App\Utilities;

class Sanitizer
{
    public static function HTML($content)
    {
        $allowed_tags = '<h1><h2><h3><h4><h5><h6><p><ul><ol><li><strong><em><br><a><img><blockquote><hr><span>';
        $content = strip_tags($content, $allowed_tags);
    
        // Create a new DOMDocument and load the HTML
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
    
        // Define the tags and attributes that need to be sanitized
        $sanitize_tags = [
            '*' => ['style'],  // All tags: style attribute
            'a' => ['href'],   // <a> tag: href attribute
            'img' => ['src'],  // <img> tag: src attribute
        ];
    
        // Loop through all tags and sanitize the specified attributes
        foreach ($sanitize_tags as $tag => $attributes) {
            $elements = $tag === '*' ? $doc->getElementsByTagName('*') : $doc->getElementsByTagName($tag);
            foreach ($elements as $element) {
                foreach ($attributes as $attribute) {
                    if ($element->hasAttribute($attribute)) {
                        $value = $element->getAttribute($attribute);
                        $sanitized_value = filter_var($value, FILTER_SANITIZE_URL);
                        $element->setAttribute($attribute, $sanitized_value);
                    }
                }
            }
        }
    
        // Save the sanitized HTML and return it
        $sanitized_content = $doc->saveHTML();
        return $sanitized_content;
    }
}