const configList = {
  "profile": {"screenName": 'elonmusk'},
  'maxTweets': 4,
  'enableLinks': true,
  'showUser': true,
  'showTime': true,
  'dataOnly': false,
  'useEmoji': true,
  'showImages': true,
  'showRetweet': false,
  'customCallback': (tweets) => populateTpl(tweets),
  'showInteraction': false,
}

twitterFetcher.fetch(configList);

function extractAuthor(el) {
  const $el = $(el);
  const link = $el.find('a').attr('href');
  const name = $el.find('[data-scribe="element:name"]').text();
  const screenName = $el.find('[data-scribe="element:screen_name"]').text();
  const $avatar = $el.find('img');

  return { $avatar, link, name, screenName };
}

function extractMeta(el) {
  const $el = $(el);
  const link = $el.find('a').attr('href');
  const postedAt = $el.text();

  return { link, postedAt };
}

function populateTpl(tweets){
  // todo proper scoping
  const $templateContainer = $('.tweets');
  let html = '';

  for (let i = 0, lgth = tweets.length; i < lgth ; i++) {
    let $tweetObject = $(tweets[i]);
    const authorInfo = extractAuthor($tweetObject[0]);
    const meta = extractMeta($tweetObject[2]);
    const content = $tweetObject[1];
    const j = i+1;
    let $template = $('.tweet:nth-child('+ j +')', $templateContainer);

    $template
      .find('.tweet--header')
      .attr('href', authorInfo.link);

    $template
      .find('.tweet--header-avatar')
      .html(authorInfo.$avatar);

    $template
      .find('.tweet--header-name')
      .html(authorInfo.name);

    $template
      .find('.tweet--header-screenname')
      .html(authorInfo.screenName);

    $template
      .find('.tweet--content')
      .append($tweetObject[3] ? $tweetObject[3] : null)
      .append(content);

    $template
      .find('.tweet--footer')
      .attr('href', meta.link)
      .find('.tweet--footer--posted')
      .text(meta.postedAt);
  }
}
