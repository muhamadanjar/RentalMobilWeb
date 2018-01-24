<ul class="nav nav-tabs" style="margin-bottom: 20px">
    <li role="presentation" class="{{ ($active == 'post')?'active':'' }}"><a href="{{ route('backend.posts.index', ['type' => 'post']) }}"><span class="badge">{{ $count['post'] }}</span> Berita</a></li>
    <li role="presentation" class="{{ ($active == 'page')?'active':'' }}"><a href="{{ route('backend.posts.index', ['type' => 'page']) }}"><span class="badge">{{ $count['page'] }}</span> Halaman</a></li>
    <li role="presentation" class="{{ ($active == 'kegiatan')?'active':'' }}"><a href="{{ route('backend.posts.index', ['type' => 'kegiatan']) }}"><span class="badge">{{ $count['kegiatan'] }}</span> Kegiatan</a></li>
    <li role="presentation" class="{{ ($active == 'lowongan')?'active':'' }}"><a href="{{ route('backend.posts.index', ['type' => 'lowongan']) }}"><span class="badge">{{ $count['lowongan'] }}</span> Lowongan</a></li>
</ul>
