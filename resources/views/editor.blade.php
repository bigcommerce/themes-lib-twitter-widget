<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <div id="widget-editor">
      <editor
        :twitter-handle="'{{$user['twitter_handle']}}'"
        :context="'{{$user['context']}}'"
        :num-posts="'{{$user['number_posts']}}'"
        :color-style="'{{$user['style']}}'"
      >
      </editor>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>

