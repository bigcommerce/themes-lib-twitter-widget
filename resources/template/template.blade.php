<div class="container">
<section class="tweets">
  <input type="hidden" data-handle="@{{handle}}" >
  <input type="hidden" data-max-tweets="@{{maxTweets}}">
  <h3 class="section-title tweet-section-title">Twitter Feed</h3>
  <div class="tweet-scroller tweet-amount-@{{maxTweets}}">
    @{{#if maxTweets '===' '1'}}
      <article class="tweet">
        <a
          href="#"
          class="tweet--header"
          target="__blank"
        >
          <span class="tweet--header-avatar"></span>
          <span class="tweet--header-author">
            <span class="tweet--header-name">Your Twitter Account</span>
            <span class="tweet--header-screenname">@youraccount</span>
          </span>
        </a>
        <span class="tweet--content"></span>
        <span class="tweet--footer">
          @include('twitter-logo')
          <span class="tweet--footer--posted"></span>
        </span>
      </article>
    @{{else}}
      @{{#for 1 maxTweets}}
        <article class="tweet">
          <a
            href="#"
            class="tweet--header"
            target="__blank"
          >
            <span class="tweet--header-avatar"></span>
            <span class="tweet--header-author">
              <span class="tweet--header-name">Your Twitter Account</span>
              <span class="tweet--header-screenname">@youraccount</span>
            </span>
          </a>
          <span class="tweet--content"></span>
          <span class="tweet--footer">
            @include('twitter-logo')
            <span class="tweet--footer--posted"></span>
          </span>
        </article>
      @{{/for}}
    @{{/if}}
  </div>
</section>
</div>
<script src="https://unpkg.com/jquery@3.2.1/dist/jquery.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/bc-theme-utils/twitter-widget/scripts/widget.js"></script>
