<ul class="nav nav-tabs" style="margin-bottom: 20px">
    <li role="presentation" class="{{ ($active == 'media')?'active':'' }}"><a href="{{ route('backend.media.index', ['type' => 'media']) }}"><span class="badge">{{ $count['media'] }}</span> Media</a></li>
    <li role="presentation" class="{{ ($active == 'album')?'active':'' }}"><a href="{{ route('backend.album.index', ['type' => 'album']) }}"><span class="badge">{{ $count['album'] }}</span> Album</a></li>
</ul>
