<div class="frame frame-post-popular">
    <div class="main">
        <div class="sd-main">
            <div class="count">{{ '0'.$i }}</div>
        </div>
        <div class="sd-right">
            <div class="mid">
                <div>
                    <a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-sans-serif">
                        {{ $story->title }}
                    </a>
                </div>
                <div class="date">
                    <span class="ttl-views">{{ date('F d, Y', strtotime($story->created)) }}</span>
                </div>
                <div class="info">
                    <a href="{{ url('/u/'.$story->id) }}">
                        <span class="name">By {{ $story->name }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>