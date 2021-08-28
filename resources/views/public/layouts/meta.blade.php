@if(!empty($pageMeta['description']))
    <meta name="description" content="{{ $pageMeta['description'] }}">
@endif

@if(!empty($pageMeta['robots']))
    <meta name="robots" content="{{ $pageMeta['robots'] }}" />
@endif
<meta property="og:type" content="website">

@if(!empty($pageMeta['og_title']))
    <meta property="og:title" content="{{ $pageMeta['og_title'] }}">
@elseif(!empty($pageMeta['title']))
    <meta property="og:title" content="{{ $pageMeta['title'] }}">
@else
    <meta property="og:title" content="{{ config('app.name') }}">
@endif

@if(!empty($pageMeta['og_description']))
    <meta property="og:description" content="{{ $pageMeta['og_description'] }}">
@elseif(!empty($pageMeta['description']))
    <meta property="og:description" content="{{ $pageMeta['description'] }}">
@endif

<meta property="og:url" content="{{$current = url()->current()}}">

@if(!empty($pageMeta['imageUrl']))
    <meta property="og:image" content="{{ $pageMeta['imageUrl'] }}">
    @if(!empty($pageMeta['imagePath']) && file_exists($pageMeta['imagePath']))
        @php $size = @getimagesize($pageMeta['imagePath']) @endphp
        @if(!empty($size[0]))
            <meta property="og:image:width" content="{{ $size[0] }}">
        @endif
        @if(!empty($size[1]))
            <meta property="og:image:height" content="{{ $size[1] }}">
        @endif
    @endif
@else
    @php $image = config('muetze-site.open-graph.fallback-image', 'img/fallback.jpg') @endphp
    <meta property="og:image" content="{{ url($image) }}">
    @if(file_exists($image))
        @php $size = @getimagesize($image) @endphp
        @if(!empty($size[0]))
            <meta property="og:image:width" content="{{ $size[0] }}">
        @endif
        @if(!empty($size[1]))
            <meta property="og:image:height" content="{{ $size[1] }}">
        @endif
    @endif
@endif
