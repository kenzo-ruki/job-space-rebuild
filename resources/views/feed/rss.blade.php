<?php
use App\Utilities\CdataHelper as Cdata;
?>
<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <atom:link href="{{ url($meta['link']) }}" rel="self" type="application/rss+xml" />
        <title>{!! Cdata::out($meta['title'] ) !!}</title>
        <link>{!! Cdata::out(url($meta['link']) ) !!}</link>
@if(!empty($meta['image']))
        <image>
            <url>{{ $meta['image'] }}</url>
            <title>{!! Cdata::out($meta['title'] ) !!}</title>
            <link>{!! Cdata::out(url($meta['link']) ) !!}</link>
        </image>
@endif
        <description>{!! Cdata::out($meta['description'] ) !!}</description>
        <language>{{ $meta['language'] }}</language>
        <pubDate>{{ $meta['pubDate'] }}</pubDate>

        @foreach($rssItems as $model)
        @if(!is_null($model))
        <{{ $meta['model'] }}>
            @foreach($model as $key => $data)
            <{{ $key }}>{!! Cdata::out($data) !!}</{{ $key }}>
            @endforeach
        </{{ $meta['model'] }}>
        @endif
    @endforeach
    </channel>
</rss>