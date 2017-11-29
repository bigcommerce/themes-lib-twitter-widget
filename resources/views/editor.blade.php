<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" />
  </head>
  <body>
    <div class="merchant-branding">
      <img
        src="https://s3-us-west-2.amazonaws.com/bc-theme-utils/twitter-widget/img/merchant_logo.png"
        alt="Merchant Logo"
      />
    </div>
    <div class="container">
      <h1 class="is-title">
        Your Merchant Twitter Feed
      </h1>
    </div>
    <div id="widget-editor">
      <editor
        :twitter-handle="'{{$user['twitter_handle']}}'"
        :context="'{{$user['context']}}'"
        :num-posts="'{{$user['number_posts']}}'"
        :color-style="'{{$user['style']}}'"
      >
      </editor>
    </div>
    <div class="container">
      <div class="level">
        <div class="level-item">
          @include('pxu-branding')
        </div>
      </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>

