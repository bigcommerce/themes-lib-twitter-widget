<script src="https://unpkg.com/jquery@3.2.1/dist/jquery.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/bc-theme-utils/twitter-widget/scripts/widget.js"></script>
<section class="tweets">
    @for ($i=0; $i<4; $i++)
        <article class="tweet">
            <a
                href="#"
                class="tweet--header"
                target="__blank"
            >
                <span class="tweet--header-avatar"></span>
                <span class="tweet--header-name">Your Twitter Account</span>
                <span class="tweet--header-screenname">@youraccount</span>
            </a>
            <span class="tweet--content"></span>
            <span class="tweet--footer">
                <span class="tweet--footer--posted"></span>
            </span>
        </article>
    @endfor
</section>
