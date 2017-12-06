<div class="container">
<section class="tweets">
  <input type="hidden" data-handle="@{{handle}}" >
  <input type="hidden" data-max-tweets="@{{maxTweets}}">
  <h3 class="section-title tweet-section-title">Twitter Feed</h3>
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
              <span class="tweet--footer--posted"></span>
          </span>
      </article>
  @{{/for}}
</section>
</div>
<script src="https://unpkg.com/jquery@3.2.1/dist/jquery.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/bc-theme-utils/twitter-widget/scripts/widget.js"></script>
<style>
  .tweets {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding-top: 80px;
    padding-bottom: 80px;
  }
  article.tweet {
    flex-basis: 25%;
    padding: 30px 20px;
  }
  @media (max-width: 1240px) {
    article.tweet {
      flex-basis: 50%;
    }
  }
  @media (max-width: 760px) {
    article.tweet {
      flex-basis: 100%;
    }
  }
  .tweet-section-title {
    flex-basis: 100%;
  }
  .tweet--header {
    display: flex;
  }
  .tweet--header-name {
    color: rgb(74, 74, 74);
  }
  .tweet--header-screenname {
    font-size: 12px;
  }
  .tweet--header-author {
    display: flex;
    flex-direction: column;
    padding-left: 20px;
  }
  .tweet--footer--posted {
    font-family: "Playfair Display";
    font-size: 14px;
  }
</style>
