<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" />
  </head>
  <body>
    <section id="widget-editor" class="main-section">
        <editor
          :twitter-handle="'{{$user['twitter_handle']}}'"
          :context="'{{$user['context']}}'"
          :num-posts="'{{$user['number_posts']}}'"
        >
        </editor>
      </div>
      <div class="container pxu-branding-container">
        <div class="level">
          <div class="level-item">
            @include('pxu-branding')
          </div>
        </div>
      </div>
    </section>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>

